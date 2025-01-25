@extends('layouts.dashboard')

@section('content')
<table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
    <thead>
        <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
            <th scope="col" class="px-4 py-2.5 text-start text-sm font-normal text-gray-500 focus:outline-none dark:text-neutral-500 w-[150px]">
                Controller
            </th>
            <th scope="col" class="px-4 py-2.5 text-start text-sm font-normal text-gray-500 focus:outline-none dark:text-neutral-500">
                Method
            </th>
            <th scope="col" class="px-4 py-2.5 text-start text-sm font-normal text-gray-500 focus:outline-none dark:text-neutral-500">
                Groups
            </th>
            <th scope="col" class="px-4 py-2.5 text-start text-sm font-normal text-gray-500 focus:outline-none dark:text-neutral-500">
                Save
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @forelse ($controllerMethods as $controller => $permissions)
        @forelse ($permissions as $permission)
        <form method="POST" action="{{ route('permissions.linkToGroups') }}">
            @csrf
            <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                <td class="px-4 py-1 whitespace-nowrap w-[150px]">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $controller }}</span>
                </td>
                <td class="px-4 py-1 whitespace-nowrap">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ str($permission)->afterLast('.') }}</span>
                </td>
                <td class="px-4 py-1 whitespace-nowrap">
                    <div class="space-y-2">
                        @foreach ($groups as $group)
                        <div class="flex items-center gap-x-2">
                            <input class="form-checkbox text-green-500" type="checkbox" id="group-{{ $group->id }}" name="groups[]" value="{{ $group->id }}"
                                @checked($group->permissions->pluck('name')->contains($permission))
                            >
                            <label for="group-{{ $group->id }}" class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $group->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </td>
                <td class="px-4 py-1 whitespace-nowrap">
                    <input type="hidden" name="permission" value="{{ $permission }}">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-stone-200 bg-white text-green-500 shadow-sm hover:bg-stone-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-green-500 dark:hover:bg-neutral-700">
                        Save
                    </button>
                </td>
            </tr>
        </form>
        @empty
        <tr>
            <td colspan="4">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                    No permissions found!
                </span>
            </td>
        </tr>
        @endforelse
        @empty
        <tr>
            <td colspan="4">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                    No controllers and methods found!
                </span>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection