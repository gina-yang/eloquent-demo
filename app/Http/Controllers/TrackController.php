<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TrackController extends Controller
{
    public function index(){
        $tracks = DB::table('tracks')
            ->select('tracks.TrackId as TrackId', 'tracks.Name as TrackName', 'albums.Title as AlbumTitle', 'artists.Name as ArtistName')
            ->join('albums', 'tracks.AlbumId', '=', 'albums.AlbumId')
            ->join('artists', 'albums.ArtistId', '=', 'artists.ArtistId')
            ->orderBy('ArtistName')
            ->orderBy('AlbumTitle')
            ->orderBy('TrackName')
            ->get();
        return view('tracks.index', [
            'tracks' => $tracks
        ]);
    }
    
    public function add($id){
        $track = DB::table('tracks')->where('TrackId', '=', $id)->first();
        return view('tracks.add',[
            'playlists' => DB::table('playlists')->orderBy('Name')->get(),
            'track' => $track
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'playlist' => 'required|exists:playlists,PlaylistId'
        ]);

        DB::table('playlist_track')->insert([
            'TrackId' => $request->input('trackid'),
            'PlaylistId' => $request->input('playlist')
        ]);

        $trackName = DB::table('tracks')
            ->where('TrackId', '=', $request->input('trackid'))
            ->first();

        $playlistName = DB::table('playlists')
            ->where('PlaylistId', '=', $request->input('playlist'))
            ->first();

        return redirect()
            ->route('specplaylist', ['id' => $request->input('playlist')])
            ->with(
                'success',
                "Track {$trackName->Name} was successfully added to Playlist {$playlistName->Name}"
            );
    }
}
