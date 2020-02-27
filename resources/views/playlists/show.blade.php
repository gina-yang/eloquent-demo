@extends('layouts.main')

@section('title')
    Playlists: {{$playlist->Name}}
@endsection

@section('header')
    {{$playlist->Name}}
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <p>Number of tracks: {{$trackCount}}</p>
    <table class="table table-striped">
        @if($trackCount === 0)
            <tr>
                <td colspan="5">No tracks found.</td>
            </tr>
        @endif
        <thead>
        <tr>
            <th>Track</th>
            <th>Album</th>
            <th>Artist</th>
            <th>Media Type</th>
            <th>Genre</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tracks as $track)
            <tr>
            <td>{{$track->TrackName}}</td>
            <td>{{$track->AlbumTitle}}</td>
            <td>{{$track->ArtistName}}</td>
            <td>{{$track->MediaTypeName}}</td>
            <td>{{$track->GenreName}}</td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
@endsection