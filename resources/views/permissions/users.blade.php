@extends('layouts.dashboard')

@section('content')

<table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
    <thead>
        <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
            <th scope="col">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    ID
                </button>
            </th>
            <th scope="col" class="min-w-[150px]">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Name
                </button>
            </th>
            <th scope="col" class="min-w-[250px]">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Email
                </button>
            </th>
            <th scope="col" class="min-w-[250px]">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Current Permissions
                </button>
            </th>
            <th scope="col" class="min-w-[250px]">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Assign Permission
                </button>
            </th>
            <th scope="col" class="min-w-[250px]">
                <button type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Reset Permissions
                </button>
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @forelse ($users as $user)
        <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $user->id }}
                    </span>
                </div>
            </td>

            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $user->name }}
                    </span>
                </div>
            </td>
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $user->email }}
                    </span>
                </div>
            </td>
            <td class="size-px px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200 break-words">
                        {{ str_replace('.', ' ', $user->permissions->pluck('name')->implode(', ')) }}
                    </span>
                </div>
            </td>

            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="hs-dropdown hs-dropdown-example relative inline-flex">
                    <button id="hs-dropdown-example" type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-black text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Assign a Permission
                        <svg class="hs-dropdown-open:rotate-180 size-4 text-gray-600 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 w-56 hidden z-10 mt-2 min-w-60 bg-black shadow-md rounded-lg p-2 dark:bg-black dark:border dark:border-neutral-700 dark:divide-neutral-700 max-h-60 overflow-y-auto overflow-x-hidden" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-example">
                        @forelse ($controllerMethods as $controller => $permissions)
                        @foreach ($permissions as $permission)
                        <form method="POST" action="{{ route('user-permissions.linkToUser', $user) }}">
                            @csrf
                            <input type="hidden" name="permission_name" value="{{ $permission }}">
                            <button type="submit" class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                {{ str_replace('.', ' ', $permission) }}
                            </button>
                        </form>
                        @endforeach
                        @empty
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                            No Permissions available
                        </a>

                        @endforelse
                    </div>
                </div>

            </td>
            <td class="whitespace-nowrap px-4 py-1">
                <form method="POST" action="{{ route('user-permissions.reset', $user) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-stone-200 bg-white text-red-500 shadow-sm hover:bg-stone-50 focus:outline-none focus:bg-stone-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        Reset Permissions
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No users found!</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if ($users->hasPages())
{{ $users->links() }}
@endif

@endsection