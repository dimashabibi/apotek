<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <form method="POST" action="<?= site_url('proses_register'); ?>">
        <label for="nama">nama</label>
        <input type="text" name="nama_user">
        <label for="nama">username</label>
        <input type="text" name="username">
        <label for="nama">password</label>
        <input type="password" name="password">
        <button type="submit" name="submit">Confirm</button>
    </form>
</body>

</html>