@extends('default')
@section('content')

<div class="container mt-4">
    <h2>Update Anime</h2>
    <form method="POST" enctype="multipart/form-data" action="{{url('anime/update/'.$anime->anime_id)}}" class="fullform">
        @csrf
        <input type="hidden" name="anime_id" value="<?= $anime->anime_id; ?>">
        <input type="hidden" name="existing_image" value="<?= $anime->cover_image; ?>">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= $anime->title; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= $anime->description; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Release Year</label>
            <input type="number" name="release_year" class="form-control" value="<?= $anime->release_year; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" value="<?= $anime->genre; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <input type="number" name="rating" class="form-control" step="0.1" max="10" value="<?= $anime->rating; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Cover Image</label><br>
            <img src="../<?= $anime->cover_image; ?>" alt="Current Cover" style="height: 100px;"><br><br>
            <input type="file" name="cover_image" class="form-control">
            <small class="text-muted">Leave blank to keep current image.</small>
        </div>
        <button type="submit" class="btn btn-success">Update Anime</button>
    </form>
</div>
</body>
</html>
    
@endsection('content')