<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    $latestPosts = Post::query()
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->orderBy('published_at', 'desc')
        ->take(6)
        ->get();

    return view('welcome', compact('latestPosts'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/about-us', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');

Route::get('/our-resources', [PostController::class, 'index'])->name('resources');
Route::get('/our-resources/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/events', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/events/{slug}', [App\Http\Controllers\EventController::class, 'show']);

require __DIR__.'/auth.php';