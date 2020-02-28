<?php

use App\Artist;
use App\Track;
use App\Genre;
use App\Album;

Route::get('/eloquent', function() {
    // QUERYING
    // dd(Artist::all()); // creates new instance of Artist class for all
    // dd(Track::all());
    // dd(Artist::orderBy('Name')->get());
    // return Track::where('UnitPrice', '>', 0.99)
    //     ->orderBy('Name')
    //     ->get();

    // CREATING
    // return Genre::all();
    // $genre = new Genre();
    // $genre->Name = 'Hip Hop';
    // $genre->save(); // this does the insert statement
    // return Genre::all();

    // DELETING
    // $genre = Genre::where('Name', '=', 'Hip Hop')->first(); // OR $genre = Genre::find(26);
    // $genre->delete();
    // return Genre::all();

    // UPDATING
    // $genre = Genre::where('Name', '=', 'Alternative & Punk')->first();
    // $genre->Name = 'Alternative';
    // $genre->save(); // this does the update statement (save does either insert or update depending on situation)
    // return Genre::all();

    // RELATIONSHIPS (ONE TO MANY)
    // $artist = Artist::find(50); // Metallica
    // return $artist->albums;
    // return Album::find(152)->artist; // 152 = Master of Puppets

    // return Track::find(1837); // Seek & Destroy
    // return Track::find(1837)->genre; // Metal
    return Genre::find(3)->tracks; // 3 = Metal
    // $metal = Genre::where('Name', '=', 'Metal')->first();
    // return $metal->tracks;


});

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
