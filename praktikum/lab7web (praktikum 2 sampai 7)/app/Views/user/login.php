<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
<div id="login-wrapper">
    <h1>Sign In</h1>

    <?php if (session()->getFlashdata('flash_msg')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('flash_msg'); ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" value="<?= set_value('email') ?>">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
</body>
</html>
