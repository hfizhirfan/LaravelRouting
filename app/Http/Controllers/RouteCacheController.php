<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RouteCacheController extends Controller
{
    public function index()
    {
        $routeCache = $this->getRouteCache();
        return view('route-cache', compact('routeCache'));
    }

    private function getRouteCache()
    {
        $routeCache = [];
        $routeList = \Route::getRoutes();
        foreach ($routeList as $route) {
            $middleware = implode(',', $route->middleware());
            $name = $route->getName();
            $path = $route->uri();
            $action = $route->getActionName();
            $routeCache[] = compact('middleware', 'name', 'path', 'action');
        }
        return $routeCache;
    }
}
