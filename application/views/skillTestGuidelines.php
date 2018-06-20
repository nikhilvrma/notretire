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
              <div class="col-lg-12 mb-4">
              <p>
                <ol>
                  <?php if($settings['numberQuestions'] != NULL){?>
                    <li>This test has <?= $settings['numberQuestions']?> questions.</li>
                  <?php }else{ ?>
                    <li>This test has no fixed number of questions.</li>
                  <?php }?>
                  <li>This test goes on for <?= $settings['testTime']/60?> minutes.</li>
                </ol>
              </p>

              </div>
              <div class="col-lg-12 mb-4">
              <center>
                <a class="btn btn-lg btn-primary" href = "<?= base_url('skill_functions/beginTest?skillID='.$skill);?>">Start Test</a>
              </center>
              </div>



            </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>
      $(document).ready(function(){
        editor = CKEDITOR.replace('careerObjective');
      });
      </script>

  </body>

</html>
