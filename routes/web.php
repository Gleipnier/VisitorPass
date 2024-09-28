<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitorPassController;
use App\Http\Controllers\Admin\VerificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'home'])->name('home');
// Route::get('/navbar',[NavbarController::class,'index'])->name('navbar');

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/edit',[HomeController::class,'edit'])->name('home.edit');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth','admin']);
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth','admin']);
Route::get('visitors', [AdminController::class, 'visitors'])->middleware(['auth','admin']);
Route::get('visitorverify', [AdminController::class, 'visitorverify'])->middleware(['auth','admin']);
Route::get('scanner', [AdminController::class, 'scanner'])->name('admin.scanner')->middleware(['auth','admin']);
Route::get('statistics', [AdminController::class, 'statistics'])->name('admin.statistics')->middleware(['auth','admin']);




// QR Generation

Route::post('/generate-visitors-pass', [VisitorPassController::class, 'generate'])->middleware('auth');
Route::get('/download-visitor-pass', [VisitorPassController::class, 'downloadPDF'])->middleware('auth');
Route::post('/admin/verify-pass', [VerificationController::class, 'verifyPass'])->middleware('auth','admin');
Route::get('/admin/visit-stats', [VerificationController::class, 'getVisitStats'])->middleware('auth:admin');