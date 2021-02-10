Route::prefix('[template]')->group(function () {
    Route::match(['GET', 'POST'], '/', [App\Http\Controllers\[model]Controller::class, 'index'])->name('[template]-list');
    Route::match(['GET', 'POST'], '/form/{id?}', [App\Http\Controllers\[model]Controller::class, 'create'])->name('[template]-form');
    Route::delete('/delete/{id?}', [App\Http\Controllers\[model]Controller::class, 'delete'])->name('[template]-delete');
});
