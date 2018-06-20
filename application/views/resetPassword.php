<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle."|CampusPuppy"; ?></title>

    <?php echo $headerFiles; ?>

  </head>

  <body>

    <?php echo $nav; ?>

    <div class="container" style="margin-top: 10px;">


      <?php if($message['content']!=''){?>

      <ol class="breadcrumb" style="background-color: white !important; margin-top: 20px; border: 1px solid <?=$message['color']?>;">
        <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
      </ol>
    	<?php }?>

      <div class="row">


        <div class="col-lg-12 mb-4">

            <ol class="breadcrumb" style="margin-top: 30px;">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
          </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>


          <div class="col-lg-6 mb-4 offset-md-3">
      <div class="card h-100" style="opacity: 0.9">
        <h5 class="card-header cardheader"><center>RESET PASSWORD</center></h5>

        <div class="card-body">

          <p style="font-size: 15px; margin-top: 15px;">
            CampusPuppy is here to Help You. Forgot your Password. Don't Worry. Just Reset your Password Now.
          </p>

          <form method="post" action="<?php echo base_url('functions/resetUserPassword'); ?>">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="name"><b>Reset Password Token</b></label>
                <input type="text" class="form-control" name="token" placeholder="Reset Password Token">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="password"><b>Password</b></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <div class="form-group col-md-6">
                <label for="cpassword"><b>Confirm Password</b></label>
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
              </div>
            </div>
            <a style="float: right; margin-bottom: 10px;" href="<?php echo base_url('functions/resendPasswordToken?email=').$this->input->get('email'); ?>">Re-Send Password Token</a>
            <div class="clearfix"></div>
            <input type="hidden" name="email" value="<?php echo $this->input->get('email'); ?>">
            <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
            <center><button type="submit" class="btn btn-lg btn-primary">Reset Password</button></center>

          </form>


        </div>


      </div>
    </div>



        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
