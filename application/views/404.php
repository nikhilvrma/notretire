<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>404-Page Not Found|CampusPuppy</title>

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

          <div class="clearfix"></div>


          <p style="font-size: 200px; color: #2c3e50;">
            404!
            <label style="font-size: 65px; color: #2c3e50;">Page Not Found</label>
          </p>
          <center><a href="<?php echo base_url(); ?>" class="btn btn-primary btn-lg" style="color: white;">Go back to Home-Page</button></a>




        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
