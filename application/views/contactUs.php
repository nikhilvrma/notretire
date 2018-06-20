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
      <?php if(isset($_SESSION['user_data']['loggedIn']) && $_SESSION['user_data']['loggedIn']){ ?>
        <?php echo $sidebar; ?>
      <?php } ?>
      <?php if(isset($_SESSION['user_data']['loggedIn']) && $_SESSION['user_data']['loggedIn']){ ?>
        <div class="col-lg-9 mb-4">
      <?php } ?>
      <?php if(!(isset($_SESSION['user_data']['loggedIn']) && !($_SESSION['user_data']['loggedIn']))) { ?>
        <div class="col-lg-12 mb-4">
      <?php } ?>

            <ol class="breadcrumb" style="margin-top: 30px;">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
          </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>

          <div class="row">

            <div class="col-md-6 control-group form-group">
                <p><b>E-Mail: </b>hello@campuspuppy.com</p>
                <p><b>Mobile: </b>+91-7503705892</p>
                <p><b>Registerd Office: </b>Campus Puppy Private Limited, TBI, Shriram Institute of Industrial Research, 19, University Road, New Delhi</p>
                <p><b>Office Address: </b>Campus Puppy Private Limited, TBI, Shriram Institute of Industrial Research, 19, University Road, New Delhi</p>
            </div>

            <div class="col-md-6 control-group form-group">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3500.329890203608!2d77.21116705498672!3d28.67977683109248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd6a1d2921af%3A0x570c5acc7d0f7853!2sPaharganj%2C+New+Delhi%2C+Delhi!5e0!3m2!1sen!2sin!4v1497776662365" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

          </div>

          <hr>

          <form method="post" action="<?php echo base_url('functions/contactUs'); ?>">

            <div class="row">



              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Full Name:</b></label>
                  <input type="text" class="form-control" name="name" required placeholder="Full Name">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>E-Mail Address:</b></label>
                  <input type="email" class="form-control" name="email" required placeholder="E-Mail Address">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-6 control-group form-group">
                <div class="controls">
                  <label><b>Mobile Number:</b></label>
                  <input type="text" maxlength="10" class="form-control" required name="mobile" placeholder="Mobile Number">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Message:</b></label>
                  <textarea class="form-control" name="message" required id="message"></textarea>
                  <p class="help-block"></p>
                </div>
              </div>


            </div>
            <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
            <button type="submit" class="btn btn-primary" style="float: right;">Drop Us a Message</button>
          </form>


        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('message');
      });
      </script>

  </body>

</html>
