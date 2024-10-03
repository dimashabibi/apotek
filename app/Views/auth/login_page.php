<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <form method="POST" action="<?= site_url('proses_login'); ?>">
        <input type="text" name="username">
        <input type="password" name="password">
        <a href="<?= base_url('register'); ?>">Register Account?</a>
        <button type="submit" name="submit">login</button>
    </form>
</body>

</html>