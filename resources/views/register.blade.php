
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Ontario Public Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h3>Register</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <?php get_message(); ?>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <form method="POST" action="{{url('register')}}">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
            </form>

            <div class="mt-3 text-center">
                Already have an account? <a href="login">Login here</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
