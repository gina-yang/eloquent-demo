@extends('layouts.main')
@section('title', 'Playlists')
@section('header', 'Playlists')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="text-right mb-3">
        <a href="/playlists/create" class="btn btn-primary">Add Playlist</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
            <tr>
                <td>
                    <a href="/playlists/{{$playlist->PlaylistId}}">{{$playlist->Name}}</a>
                </td>
                <td>
                    <a href="/playlists/{{$playlist->PlaylistId}}/edit">Edit</a>
                </td>
                <td>
                    <a href="/playlists/{{$playlist->PlaylistId}}/delete">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
