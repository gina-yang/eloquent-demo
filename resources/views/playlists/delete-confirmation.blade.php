@extends('layouts.main')
@section('title', 'Delete Playlist')
@section('header', 'Delete Playlist')

@section('content')
    <form action="/playlists/{{$playlist->PlaylistId}}/delete" method="POST">
        @csrf
        <p>Are you sure you want to delete {{$playlist->Name}}?</p>
        <a href="/playlists" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    
@endsection