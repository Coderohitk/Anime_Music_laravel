
@extends('default')
@section('content')

    <h2>Edit Character</h2>
    
    <!-- Form to edit character details -->
    <form method="POST"  action="{{url('characters/update/'.$character->character_id)}}" enctype="multipart/form-data" class="fullform">
        @csrf
        <input type="hidden" name="character_id" value="<?= $character->character_id; ?>">

        <label for="name">Name:</label><br>
        <input type="text" name="name" value="<?php echo $character->name; ?>" required><br><br>

        <label for="anime_id">Anime ID:</label><br>
        <input type="number" name="anime_id" value="<?php echo $character->anime_id; ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" required><?php echo $character->description; ?></textarea><br><br>

        <label for="image">Image (Leave empty to keep current):</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <label for="voice_actor_english">English Voice Actor:</label><br>
        <input type="text" name="voice_actor_english" value="<?php echo $character->voice_actor_english; ?>" required><br><br>

        <label for="voice_actor_japanese">Japanese Voice Actor:</label><br>
        <input type="text" name="voice_actor_japanese" value="<?php echo $character->voice_actor_japanese; ?>" required><br><br>

        <!-- New Role Field -->
        <label for="role">Role:</label><br>
        <input type="text" name="role" value="<?php echo $character->role; ?>" required><br><br>

        <button type="submit">Update Character</button>
    </form>

    <br>
    <a href="{{url('characters')}}">Back to Character List</a>
</body>
</html>
@endsection('content')