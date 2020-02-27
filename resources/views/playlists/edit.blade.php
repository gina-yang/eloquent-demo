@extends('layouts.main')

@section('title', 'Edit Playlist Name')
@section('header', 'Edit Playlist Name')

@section('content')
    <form action="/playlists/edit" method="POST">
        @csrf
        <input type="hidden" name="playlistid" id="playlistid" value={{$playlist->PlaylistId}}>
        <div class="form-group">
            <label for="newname">Enter a new name:</label>
            <input type="text" name="newname" id="newname" class="form-control" value={{$playlist->Name}}>
            @error('newname')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection
