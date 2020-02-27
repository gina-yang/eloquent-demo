<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/invoices', 'InvoiceController@index');
Route::get('/invoices/{id}', 'InvoiceController@show');

Route::get('/albums', 'AlbumController@index')->name('albums');
Route::get('/albums/create', 'AlbumController@create');
Route::post('/albums', 'AlbumController@store');

Route::get('/playlists', 'PlaylistController@index')->name('playlists');
Route::get('/playlists/{id}', 'PlaylistController@show')->where('id', '[0-9]+')->name('specplaylist');

Route::get('/playlists/create', 'PlaylistController@create');
Route::post('/playlists', 'PlaylistController@store');

Route::get('/playlists/{id}/edit', 'PlaylistController@edit');
Route::post('/playlists/edit', 'PlaylistController@editstore');

Route::get('/playlists/{id}/delete', 'PlaylistController@deleteConfirmation');
Route::post('/playlists/{id}/delete', 'PlaylistController@destroy');

Route::get('/tracks', 'TrackController@index');
Route::get('/tracks/{id}/add-to-playlist', 'TrackController@add');
Route::post('/tracks', 'TrackController@store');
