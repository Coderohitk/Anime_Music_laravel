@extends('default')
@section('content')

<div class="container mt-4">
    <h2>Anime List</h2>
    <a href="{{url('anime/save')}}" class="btn btn-primary mb-3">Add New Anime</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Release Year</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Cover</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?= $row->title; ?></td>
                    <td><?= $row->description; ?></td>
                    <td><?= $row->release_year; ?></td>
                    <td><?= $row->genre; ?></td>
                    <td><?= $row->rating; ?></td>
                    <td><img src="../<?= $row->cover_image; ?> "width="50"></td>
                    <td>
                        <a href="{{url('anime/update/'.$row->anime_id)}}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{url('anime/delete/'.$row->anime_id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

@endsection