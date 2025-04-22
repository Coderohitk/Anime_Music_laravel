@extends('default')
@section('content')

<div class="container mt-4">
    <h2>Add Anime</h2>
    <form method="POST" enctype="multipart/form-data" action="{{url('anime/save')}}" class="fullform">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Release Year</label>
            <input type="number" name="release_year" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <input type="number" name="rating" class="form-control" step="0.1" max="10">
        </div>
        <div class="mb-3">
            <label class="form-label">Cover Image</label>
            <input type="file" name="cover_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Anime</button>
    </form>
</div>
@endsection('content')