@extends('layouts.main')
@section('title', 'Tracks')
@section('header', 'Tracks')

@section('content')
    <table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Album title</th>
            <th>Artist name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($tracks as $track)
        <tr>
            <td>
                {{$track->TrackName}}
            </td>
            <td>
                {{$track->AlbumTitle}}
            </td>
            <td>
                {{$track->ArtistName}}
            </td>
            <td>
                <a href="/tracks/{{$track->TrackId}}/add-to-playlist">Add to Playlist</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
@endsection