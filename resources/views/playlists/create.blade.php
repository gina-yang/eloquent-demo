@extends('layouts.main')

@section('title', 'New Playlist')
@section('header', 'New Playlist')

@section('content')
    <form action="/playlists" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="title" id="title" class="form-control" value={{old('title')}}>
            @error('title')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection
