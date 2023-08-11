<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\BarangController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class,'login']);
Route::get('/index', [DashboardController::class,'index']);

 
Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboardAwal', 'dashboard');
        Route::get('/dashboard-penerimaanBarang', 'penerimaan_barang');
        Route::get('/dashboard-pengeluaranBarang', 'pengeluaran_barang');
        Route::get('/dashboard-barang', 'barang');
        Route::get('/dashboard-input-barang', 'pageInputBarang');
        Route::get('/dashboard-laporan', 'pageLaporan');
        Route::get('/dashboard-cetak-pdf','cetaktotalPDF');
        Route::post('/dashboard-laporan-penerimaan-search', 'penerimaanSearch');
        Route::get('/dashboard-cetak-pdf-laporan-penerimaan/{startDate}/{endDate}', 'cetakPDFpenerimaan');
        Route::post('/dashboard-laporan-pengeluaran-search', 'pengeluaranSearch');
        Route::get('/dashboard-cetak-pdf-laporan-pengeluaran/{startDate}/{endDate}', 'cetakPDFpengeluaran');
        Route::post('/dashboard-logout', 'logout')->name('logout');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::post("/dashboard-kategori", 'postKodeBarang');
        Route::post("/dashboard-input-barang", 'postBarang');
        Route::post("/dashboard-penerimaan-barang", 'postPenerimaanBarang');
        Route::post("/dashboard-pengeluaran-barang", 'postPengeluaranBarang');
        Route::get("/dashboard-barang-edit/{id}", 'editBarang');
        Route::delete("/dashboard-barang-delete/{id}", 'deleteBarang');
        Route::put("/dashboard-barang-edit/{id}", 'aksiEditBarang');
    });
});


Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register');
        Route::post('/login', 'aksiLogin');
        Route::post('/register', 'aksiRegister')->name('aksiLogin');
    });
});



Route::get('/forgot-password', function () {
    return view('auth.reset_password');
})->middleware('guest')->name('password.request');


 
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.update_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
    $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
