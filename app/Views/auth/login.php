<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #fce4ec);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 400px;
            padding: 30px;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            position: relative;
            overflow: hidden;
        }

        /* Colorful Bottom Border */
        .login-card::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, #ff5f6d, #ffc371, #4facfe, #00f2fe);
        }

        /* Project Title */
        .project-title {
            font-weight: 800;
            font-size: 25px;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .login-title {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 0px;
        }

        .btn-custom {
            background: linear-gradient(to right, #4c7cf3, #6fa2ff);
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #3b67d0, #5e8be5);
        }

        .login-logo {
        text-align: center;
        margin-bottom: 0px;
        }

        .login-logo img {
        width: 150px;     /* Adjust size */
        height: auto;
        }
    </style>
</head>
<body>

<div class="login-card">
    
    <div class="login-logo">
        <img src="<?= base_url('public/dist/ramoji-logo.png') ?>" alt="Logo">
    </div>
    
    <div class="project-title">Secure Entry</div>
    <hr>
    <div class="login-title">Access Your Account</div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
    </form>
</div>

</body>
</html>
