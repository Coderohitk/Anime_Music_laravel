
@extends('default')
@section('content')

    <h2>Add New Character</h2>
    
    <!-- Form for adding a new character -->
    <form method="POST" enctype="multipart/form-data" action="{{url('characters/save')}}" class="fullform">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="role">Role:</label>
        <input type="text" name="role" required>

        <label for="anime_id">Anime ID:</label>
        <input type="number" name="anime_id" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <label for="voice_actor_english">English Voice Actor:</label>
        <input type="text" name="voice_actor_english" required>

        <label for="voice_actor_japanese">Japanese Voice Actor:</label>
        <input type="text" name="voice_actor_japanese" required>

        <button type="submit">Add Character</button>
    </form>

    <br>
    <a href="{{url('characters')}}">Back to Character List</a>
</body>
</html>
@endsection('content')