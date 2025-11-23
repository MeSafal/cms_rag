<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use App\Helpers\CMS_FMS;
// use App\Models\Setting;
// use Illuminate\Support\Facades\Auth;
// $cms = new CMS_FMS();

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/set-edit-session', function(Request $request) {
    session(['fromTemplate' => true]);
    return response()->json(['success' => true]);
});

Route::middleware('auth')->group(function () {
    Route::get('/error', function () {
        return view('backend.404');
    })->name('error');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    require __DIR__ . '/modules/Article.php';
    require __DIR__ . '/modules/Setting.php';
    require __DIR__ . '/modules/Blog.php';
    require __DIR__ . '/modules/Slider.php';
    require __DIR__ . '/modules/Country.php';
    require __DIR__ . '/modules/Coaching.php';
    require __DIR__ . '/modules/Testimonial.php';
});

require __DIR__ . '/auth.php';

require __DIR__ . '/modules/Frontend.php';

Route::fallback(function () {
    return response()->view(frontendPath() . '.404', [], 404);
})->name('fallback.frontend');
