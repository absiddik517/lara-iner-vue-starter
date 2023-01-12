<?php
use App\Http\Controllers\Gate\PermissionController;

Route::prefix('permission')->name('permission.')->group(function(){
  Route::get('/', [PermissionController::class, 'index'])->name('index');
  Route::post('/store', [PermissionController::class, 'store'])->name('store');
  Route::delete('/{id}/delete', [PermissionController::class, 'destroy'])->name('delete');
  Route::post('/{id}/delete', [PermissionController::class, 'update'])->name('update');
});



?>