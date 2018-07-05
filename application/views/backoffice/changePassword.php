<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Backoffice|Not Retire</title>

    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/backoffice.css'); ?>" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top nav-bg">
      <div class="container">
        <a class="navbar-brand" href="index.html">Backoffice|Not Retire</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">



            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Account
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="<?= base_url('backoffice/changePassword')?>">Change Password</a>
                <a class="dropdown-item" href="<?= base_url('backoffice/signout')?>">Sign Out</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->




      <!-- Content Row -->
      <div class="row" style="margin-top: 20px;">
        <!-- Sidebar Column -->
        <div class="col-lg-3 mb-4">
          <div class="list-group">
            <a href="index.html" class="list-group-item sidebar-item sidebar-active">Users</a>
            <a href="about.html" class="list-group-item sidebar-item">Offers</a>
          </div>
        </div>
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">

          <?php if($message['content']!=''){?>
            <ol class="breadcrumb" style="background-color: white !important; margin-top: 20px; border: 1px solid <?=$message['color']?>;">
              <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
            </ol>
          	<?php }?>

          <h4 class="mt-4 mb-3"><b>Change Password</b></h4>


          <form action = "<?= base_url('backoffice/setNewPassword')?>" method = "POST">

            <div class="form-group row">
              <label for="currentPassword" class="col-sm-3 col-form-label">Current Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="currentPassword" name = "currentPassword" placeholder="Current Password">
              </div>
            </div>

            <div class="form-group row">
              <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="newPassword" name = "newPassword" placeholder="New Password">
              </div>
            </div>

            <div class="form-group row">
              <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="confirmPassword" name = "confirmPassword" placeholder="Confirm Password">
              </div>
            </div>


            <div class="form-group row">
              <div class="col-sm-12">
                  <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                <button type="submit" class="btn btn-primary" style="float: right;">Change Password</button>
              </div>
            </div>
          </form>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark nav-bg">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Campus Puppy Private Limited 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <script>
      $(document).ready(function() {
        $('#users').DataTable();
      } );
    </script>

  </body>

</html>
