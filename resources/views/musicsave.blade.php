
@extends('default')
@section('content')

<div class="container mt-4">
    <h2>Add Music</h2>
    <form method="POST" enctype="multipart/form-data" action="{{url('music/save/')}}" class="fullform">
        @csrf
        <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
        <div class="mb-3"><label>Artist</label><input type="text" name="artist" class="form-control" required></div>
        <div class="mb-3"><label>Album</label><input type="text" name="album" class="form-control"></div>
        <div class="mb-3"><label>Genre</label><input type="text" name="genre" class="form-control"></div>
        <div class="mb-3"><label>Release Year</label><input type="number" name="release_year" class="form-control"></div>
        <div class="mb-3"><label>Cover Image</label><input type="file" name="cover_image" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Add Music</button>
    </form>
</div>
@endsection('content')