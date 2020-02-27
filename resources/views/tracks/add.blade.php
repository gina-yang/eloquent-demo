@extends('layouts.main')
@section('title', 'Add to Playlist')
@section('header')
    Track: {{$track->Name}}
@endsection

@section('content')
    <form action="/tracks" method="POST">
        @csrf
        <input type="hidden" name="trackid" id="trackid" value={{$track->TrackId}}>
        <div class="form-group">
            <label for="playlist">Playlists</label>
            <select name="playlist" id="playlist" class="form-control">
                <option value="">-- Select Playlist --</option>
                @foreach($playlists as $playlist)
                    <option value="{{$playlist->PlaylistId}}" {{$playlist->PlaylistId === old('playlist') ? "selected" : ""}}>
                        {{$playlist->Name}}
                    </option>
                @endforeach
            </select>
            @error('playlist')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection