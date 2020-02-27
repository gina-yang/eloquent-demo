<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlaylistController extends Controller
{
    public function index(){
        $playlists = DB::table('playlists')->get();

        return view('playlists.index', [
            'playlists' => $playlists
        ]);
    }
    public function show($id){
        $playlistCount = DB::table('playlists')->where('PlaylistId', '=', $id)->count();
        if($playlistCount === 0)
            return view('playlists.error');
        
        $playlist = DB::table('playlists')->where('PlaylistId', '=', $id)->first();
        
        $tracks = DB::table('tracks')
            ->select(
                'tracks.Name as TrackName', 
                'albums.Title as AlbumTitle', 
                'artists.Name as ArtistName', 
                'media_types.Name as MediaTypeName',
                'genres.Name as GenreName',)
            ->where('playlist_track.PlaylistId', '=', $id)
            ->join('albums', 'tracks.AlbumId', '=', 'albums.AlbumId')
            ->join('artists', 'albums.ArtistId', '=', 'artists.ArtistId')
            ->join('media_types', 'tracks.MediaTypeId', '=', 'media_types.MediaTypeId')
            ->join('genres', 'tracks.GenreId', '=', 'genres.GenreId')
            ->join('playlist_track', 'tracks.TrackId', '=', 'playlist_track.TrackId')
            ->get();
        
        $trackCount = DB::table('tracks')
            ->join('playlist_track', 'tracks.TrackId', '=', 'playlist_track.TrackId')
            ->where('playlist_track.PlaylistId', '=', $id)
            ->count();
            
        return view('playlists.show', [
            'playlist' => $playlist,
            'tracks' => $tracks,
            'trackCount' => $trackCount
        ]);
    }
    public function create(){
        return view('playlists.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:30'
        ]);

        DB::table('playlists')->insert([
            'Name' => $request->input('title')
        ]);

        return redirect()
            ->route('playlists')
            ->with(
                'success',
                "Playlist {$request->input('title')} was successfully created"
            );
    }

    public function edit($id){
        return view('playlists.edit', [
            'playlist' => DB::table('playlists')->where('PlaylistId', '=', $id)->first()
        ]);
    }

    public function editstore(Request $request){
        $validatedData = $request->validate([
            'newname' => 'required|max:30'
        ]);

        $oldname = DB::table('playlists')
            ->where('PlaylistId', '=', $request->input('playlistid'))
            ->first()
            ->Name;

        DB::table('playlists')
            ->where('PlaylistId', '=', $request->input('playlistid'))
            ->update(['Name' => $request->input('newname')]);

        return redirect()
            ->route('playlists')
            ->with(
                'success',
                "Playlist {$oldname} was successfully renamed to {$request->input('newname')}"
            );
    }

    public function deleteConfirmation($id){
        $playlist = DB::table('playlists')->where('PlaylistId', '=', $id)->first();
        
        return view('playlists.delete-confirmation', [
            'playlist' => $playlist
        ]);
    }

    public function destroy($id){
        $playlist = DB::table('playlists')->where('PlaylistId', '=', $id)->first();
        $this->deletePlaylist($id);

        return redirect()
            ->route('playlists')
            ->with(
                'success',
                "Playlist {$playlist->Name} successfully deleted"
            );
    }

    private function deletePlaylist($id){
        DB::table('playlist_track')->where('PlaylistId', '=', $id)->delete();
        DB::table('playlists')->where('PlaylistId', '=', $id)->delete();
    }
}
