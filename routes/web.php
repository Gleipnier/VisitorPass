<?php
use App\Http\Controllers\Admin\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitorPassController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/edit',[HomeController::class,'edit'])->name('edit');
// Route::get('/navbar',[NavbarController::class,'index'])->name('navbar');

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);

// QR Generation

Route::post('/generate-visitors-pass', [VisitorPassController::class, 'generate'])->middleware('auth');
Route::post('/admin/verify-pass', [VerificationController::class, 'verifyPass'])->middleware('auth:admin');