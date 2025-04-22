@extends('default')
@section('content')

<h1>Anime Characters</h1>

<a href="{{url('characters/save')}}" class="add-btn">+ Add Character</a>

<table>
    <thead>
        <tr>
            <th>Character ID</th>
            <th>Anime ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Role</th>
            <th>Image</th>
            <th>English Voice Actor</th>
            <th>Japanese Voice Actor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($data) > 0) {
            // Output each character's data
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $row->character_id . "</td>";
                echo "<td>" . $row->anime_id . "</td>";
                echo "<td>" . $row->name . "</td>";
                echo "<td>" . $row->description . "</td>";
                echo "<td>" . $row->role . "</td>";
                echo "<td><img src='../" . $row['image_url'] . "' alt='" . $row['name'] . "'></td>";
                echo "<td>" . $row->voice_actor_english . "</td>";
                echo "<td>" . $row->voice_actor_japanese . "</td>";
                echo "<td class='action-btns'>
                        <a href='".url('characters/update/'.$row->anime_id)."'>Edit</a>
                        <a href='".url('characters/delete/'.$row->anime_id)."' class='delete-btn'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No characters found</td></tr>";
        }
        ?>
    </tbody>
</table>

@endsection('content')
