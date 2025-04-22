@extends('default')
@section('content')

<form method="POST" enctype="multipart/form-data"  action="{{url('music/update/'.$music->music_id)}}" class="fullform">
    @csrf
    <input type="hidden" name="music_id" value="<?= $music['music_id'] ?>">
    <input type="hidden" name="existing_image" value="<?= $music['cover_image'] ?>">
    <label>Title</label><input type="text" name="title" value="<?= $music['title'] ?>" required><br>
    <label>Artist</label><input type="text" name="artist" value="<?= $music['artist'] ?>" required><br>
    <label>Album</label><input type="text" name="album" value="<?= $music['album'] ?>"><br>
    <label>Genre</label><input type="text" name="genre" value="<?= $music['genre'] ?>"><br>
    <label>Release Year</label><input type="number" name="release_year" value="<?= $music['release_year'] ?>"><br>
    <label>Cover Image</label><br>
    <img src="<?= $music['cover_image'] ?>" alt="Current Cover" style="height: 100px;"><br>
    <input type="file" name="cover_image"><br><small>Leave empty to keep current image</small><br><br>
    <button type="submit">Update</button>
</form>
@endsection('content')