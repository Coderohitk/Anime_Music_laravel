
@extends('default')
@section('content')

<div class="container mt-4">
    <h2>Music List</h2>
    <a href="{{url('music/save')}}" class="btn btn-primary mb-3">Add Music</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Cover</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row){ ?>
            <tr>
                <td><?= $row->title ?></td>
                <td><?= $row->artist ?></td>
                <td><?= $row->album ?></td>
                <td><?= $row->genre ?></td>
                <td><?= $row->release_year ?></td>
                <td><img src="../<?= $row->cover_image; ?> "width="50"></td>
                <td>
                    <a href="{{url('music/update/'.$row->music_id)}}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{url('music/delete/'.$row->music_id)}}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php  }?>
        </tbody>
    </table>
</div>
@endsection('content')