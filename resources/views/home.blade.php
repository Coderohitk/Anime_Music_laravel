
@extends('default')
@section('content')

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($anime_result as $anime){ ?>
        <div class="col">
            <div class="card shadow-sm">
                <img src="<?php echo $anime->cover_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($anime->title); ?>">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">
                            <a href="music_list.php?anime_id=<?php echo $anime->anime_id; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($anime->title); ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem;"><?php echo htmlspecialchars($anime->genre); ?> | <?php echo $anime->release_year; ?></p>
                    </div>
                    <form method="POST" action="{{url('home')}}">
                        @csrf
                        <input type="hidden" name="anime_id" value="<?php echo $anime->anime_id; ?>">
                        <button type="submit" class="favorite-btn <?php echo $anime->is_favourite ? '' : 'inactive'; ?>">
                            <i class="fa fa-heart"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
@endsection('content')