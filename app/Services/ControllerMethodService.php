<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class ControllerMethodService
{
    public static function get(): array
    {
        $controllers = [];

        foreach (Route::getRoutes() as $route) {
            if (! isset($route->action['uses'])) {
                continue;
            }

            $controller = $route->action['uses'];

            if ($controller instanceof \Closure || ! str($controller)->contains('@')) {
                continue;
            }

            [$controller, $method] = str($controller)
                ->explode('@')
                ->toArray();

            $name = str($controller)
                ->basename()
                ->remove('Controller');

            $controllers[$name->toString()][] = $name->append('.'.$method)->toString();
        }

        return $controllers;
    }
}
