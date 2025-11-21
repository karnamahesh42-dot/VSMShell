<!-- <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if(session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form action="/login" method="post">
    <?= csrf_field() ?>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 380px;
            padding: 30px;
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-title {
            font-weight: 700;
            font-size: 26px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .btn-custom {
            background: #4c7cf3;
            color: #fff;
            font-weight: 600;
        }
        .btn-custom:hover {
            background: #3b67d0;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="login-title">Sign In</div>

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
