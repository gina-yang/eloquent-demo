<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AlbumController extends Controller
{
    public function index(){
        $albums = DB::table('albums')
        ->select('albums.Title', 'artists.Name as ArtistName')
        ->join('artists', 'albums.ArtistId', '=', 'artists.ArtistId')
        ->orderBy('ArtistName')
        ->orderBy('Title')
        ->get();

        return view('albums.index', [
            'albums' => $albums
        ]);
    }

    public function create(){
        return view('albums.create', [
            'artists' => DB::table('artists')->orderBy('Name')->get()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,ArtistId'
        ]);

        DB::table('albums')->insert([
            'Title' => $request->input('title'),
            'ArtistId' => $request->input('artist')
        ]);

        $artist = DB::table('artists')
            ->where('ArtistId', '=', $request->input('artist'))
            ->first();

        return redirect()
            ->route('albums')
            ->with(
                'success', 
                "Successfully created {$artist->Name} - {$request->input('title')}");
    }


}
