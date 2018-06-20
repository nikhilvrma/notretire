<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle."|Backoffice-CampusPuppy"; ?></title>

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

        <?php echo $sidebar; ?>

        <div class="col-lg-9 mb-4">

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>


            <div class="row">


              <div class="col-lg-6 mb-4">
              <div class="card">
                <h6 class="card-header"><b>E-Mail Address</b></h6>
                <div class="card-body">
                  <p class="card-text"><b>Registered E-Mail: </b><?= $_SESSION['user_data']['email']?></p>
                  <p class="card-text"><b>Status: </b><label style="color: <?php if($_SESSION['user_data']['emailVerified']) { echo 'green'; } else { echo 'red'; } ?>"><?php if($_SESSION['user_data']['emailVerified'] == 1) { echo 'Verified'; } else { echo 'Not-Verified'; } ?></label></p>
                    <?php if($_SESSION['user_data']['emailVerified'] != 1){?>
                  <p class="card-text" style="float: left;"><a href = "<?= base_url('home/resendCode/2')?>">Resend Code</a></p>
                  <p class="card-text" style="float: right;"><a data-toggle="modal" data-target="#email">Entered Wrong E-Mail?</a></p>
                  <div class="clearfix"></div>
                  <p class="card-text">
                    <form class="form-inline" action = "<?= base_url('functions/checkEmailVerificationCode')?>" method = "POST">
                      <label class="sr-only" for="verificationCode">Verification Code</label>
                      <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                      <input type="text" class="form-control mb-2 mr-sm-2" id="verificationCode" name="code" placeholder="Verification Code">
                      <button type="submit" class="btn btn-primary mb-2">Verify</button>
                    </form>
                    <?php } ?>
                  </p>
                </div>
              </div>
              </div>

              <div class="col-lg-6 mb-4">
              <div class="card">
                <h6 class="card-header"><b>Mobile Number</b></h6>
                <div class="card-body">
                  <p class="card-text"><b>Registered Mobile Number: </b>+91-<?= $_SESSION['user_data']['mobile']?></p>
                  <p class="card-text"><b>Status: </b><label style="color: <?php if($_SESSION['user_data']['mobileVerified']) { echo 'green'; } else { echo 'red'; } ?>"><?php if($_SESSION['user_data']['mobileVerified'] == 1) { echo 'Verified'; } else { echo 'Not-Verified'; } ?></label></p>
                    <?php if($_SESSION['user_data']['mobileVerified'] != 1){?>
                  <p class="card-text" style="float: left;"><a href = "<?= base_url('home/resendCode/1')?>">Resend Code</a></p>
                  <p class="card-text" style="float: right;"><a data-toggle="modal" data-target="#mobile">Entered Wrong Mobile Number?</a></p>
                  <div class="clearfix"></div>
                  <p class="card-text">
                    <form class="form-inline" action = "<?= base_url('functions/checkMobileVerificationCode')?>" method = "POST">
                      <label class="sr-only" for="verificationCode">Verification Code</label>
                      <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                      <input type="text" class="form-control mb-2 mr-sm-2" id="verificationCode" name="code" placeholder="Verification Code">
                      <button type="submit" class="btn btn-primary mb-2">Verify</button>
                    </form>
                    <?php } ?>
                  </p>
                </div>
              </div>
              </div>





              <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Change E-Mail Address</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action = "<?=base_url('functions/changeEmail')?>" method = "POST">
                    <div class="modal-body">

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>New E-Mail Address:</label>
                            <input type="email" class="form-control" name="email" required>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                      <button type="submit" class="btn btn-primary">Change E-Mail Address</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>


              <div class="modal fade" id="mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Change Mobile Number</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action = "<?=base_url('functions/changeMobile')?>" method = "POST">
                    <div class="modal-body">

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>New Mobile Number:</label>
                            <input type="text" maxlength="10" max="9999999999" class="form-control" name="mobile" required>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                      <button type="submit" class="btn btn-primary">Change Mobile Number</button>
                    </div>
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
