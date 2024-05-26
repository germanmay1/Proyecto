use 
App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ChirpController::class,
'index'])->name('home');
Route::post('/chirps',
[ChirpController::class, 'store'])-7
>name('chirps.store');
Route::delete('/chirps/{chirp}',
[ChirpController::class, 'destroy'])-
>name('chirps.destroy');

