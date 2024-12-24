<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Apotek Sumbersekar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1">Apotek <b>Sumbersekar</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <!-- ------------------------ form login start --------------------------------------- -->

        <form action="<?= site_url('proses_login') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control " placeholder="name" name="username" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-envelope"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-lock"></i>
              </div>
            </div>
          </div>
          <p class="mb-1 text-right">
            <a href="<?= site_url('lupa_password'); ?>"><small>Lupa password ?</small></a>
          </p>
          <div class="social-auth-links text-center">
            <button name="submit" class="btn btn-block btn-primary">
              Login
            </button>
            <a type="button" class="btn btn-block btn-outline-secondary" href="<?= site_url('register'); ?>">Register</a>
          </div>
        </form>
        <!-- form login end -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/js/adminlte.min.js ') ?>"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
  <?php if (!empty(session()->getFlashdata('success'))) : ?>
    <script>
      toastr.success('<?= session()->getFlashdata('success'); ?>')
    </script>
  <?php endif; ?>
  <?php if (!empty(session()->getFlashdata('error'))) : ?>
    <script>
      toastr.error('<?= session()->getFlashdata('error'); ?>')
    </script>
  <?php endif; ?>
</body>

</html>