<?php

use App\Artist;
use App\Track;
use App\Genre;
use App\Album;
use App\Customer;
use App\Invoice;
use App\InvoiceItem;
use App\Playlist;

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
    // return Genre::find(3)->tracks; // 3 = Metal

    // EAGER LOADING
    // $tracks = Track::with(['genre', 'album'])
    //     ->where('UnitPrice', '>', 0.99)
    //     ->orderBy('Name')
    //     ->get();

    // return view('eloquent', [
    //     'tracks' => $tracks
    // ]);
    
    // RELATIONSHIPS: MANY TO MANY
    // return Playlist::all();
    // return Playlist::find(17); // Heavy Metal Classic
    // return Playlist::find(17)->tracks;
    // return Track::find(1837)->playlists; // Seek and Destroy

    // UPDATING A BELONGS TO RELATIONSHIP
    // $track = Track::find(1837); // Seek and Destroy
    // $track->genre()->associate(Genre::find(1));
    // $track->save();
    // return $track;

    // REMOVING FROM A MANY TO MANY RELATIONSHIP
    // Playlist::find(17)->tracks()->detach(Track::find(3290));
    // return Playlist::find(17)->tracks;

    // ADDING TO A MANY TO MANY RELATIONSHIP
    Playlist::find(17)->tracks()->attach(Track::find(3290));
    return Playlist::find(17)->tracks;
    
});

Route::get('/', function () {
    return view('index');
})->name('home');

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

Route::get('/signup', 'RegistrationController@showRegistrationForm');
Route::post('/signup', 'RegistrationController@register');
// Route::get('/profile', 'ProfileController@index')->name('profile')->middleware(['auth']);
Route::get('/logout', 'LogoutController');
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', 'ProfileController@index')->name('profile');
});


