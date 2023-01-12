<?php
use App\Http\Controllers\Admins\Auth\RoleController;

Route::prefix('')->name('.')->group(function(){
  Route::get('/', [RoleController::class, 'index'])->name('index');
  Route::post('/store', [RoleController::class, 'store'])->name('store');
  Route::delete('/{id}/delete', [RoleController::class, 'destroy'])->name('delete');
  Route::post('/{id}/delete', [RoleController::class, 'update'])->name('update');
});



?>