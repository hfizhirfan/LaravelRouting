<?php

use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/routing', function() {
    return view('routing');
});

Route::get('/basic_routing', function() {
    return 'Hello World';
});
Route::view('/view_route', 'view_route');
Route::view('/view_route', 'view_route', ['name' => 'Purnama']);

Route::get('/controller_route', [RouteController::class, 'index']);

Route::redirect('/', '/routing');

Route::get('/user/{id}', function($id) {
    return "User Id: ".$id;
});
Route::get('/posts/{post}/comments/{comment}', function($postId, $commentId) {
    return "Post Id: ".$postId.", Comment Id: ".$commentId;
});

Route::get('username/{name?}', function($name = null) {
    return 'Username: '.$name;
});

Route::get('/title/{title}', function($title) {
    return "Title: ".$title;
})->where('title', '^[A-Za-z\-]+$');

Route::get('/profile/{profileId}', [RouteController::class,
'profile'])->name('profileRouteName');

// Route::get('/route_priority/{rpId}', function($rpId) {
//     return "This is Route One";
// });
Route::get('/route_priority/user', function() {
    return "This is Route 1";
});
Route::get('/route_priority/user', function() {
    return "This is Route 2";
});

Route::fallback(function() {
    return 'This is Fallback Route';
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function() {
        return "This is admin dashboard";
    })->name('dashboard');
    Route::get('/users', function() {
        return "This is user data on admin page";
    })->name('users');
    Route::get('/items', function() {
        return "This is item data on admin page";
    })->name('items');
});


Route::get('/route-list', function () {
    $routeCollection = Route::getRoutes();

    echo "<table>";
    echo "<thead><tr><th>Method</th><th>URI</th><th>Name</th></tr></thead>";
    echo "<tbody>";
    foreach ($routeCollection as $route) {
        echo "<tr><td>" . implode('|', $route->methods()) . "</td><td>" . $route->uri() . "</td><td>" . $route->getName() . "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
})->name('route-list');

Route::get('/route-cache', 'App\Http\Controllers\RouteCacheController@index')->name('route-cache');

Route::get('/clear-route', function () {
    Artisan::call('route:clear');
    return redirect('/')->with('routeCleared', 'Route cache cleared!');
})->name('clear-route');

Route::get('/bootstrapclone', function () {
    return view('bootstrapclone');
})->name('bootstrapclone');





