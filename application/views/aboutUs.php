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
          <iframe width="100%" height="500px" src="https://www.youtube.com/embed/RWQysw51ktU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          <p style="font-size: 15px; margin-top: 15px;">
            CampusPuppy helps in eradicating the gap between employers and potential candidates, we, consider it a need in this era to connect an individual with a company, based on the individual’s specific skill set and expertise in it. Linking together a social community, we intend to provide a hassle free experience of recruitment to both students and employers, at the same time. The professionally socialized environment created by CampusPuppy allows candidates to take various tests to validate individualistic skills. Our sole intention is to bring out a genuine and relaxed recruitment environment and we believe that is what gives us our special place in the market.
          </p>
          <p><b>What do we do?</b></p>
          <p>
            <ul>
              <li>Bridge the gap between companies and potential candidates.</li>
              <li>Platform to test individualistic skill sets.</li>
              <li>Help in providing dream jobs/internship.</li>
              <li>Employers can post skill based jobs/internships.</li>
              <li>Employers can save on time and resources, as only skilled candidates are provided.</li>
              <li>Candidates can verify skill possessed by them and apply for internship/job according to the skills verified.</li>
              <li>Candidates get a chance for self improvement and get recognised among their colleagues.</li>
              <li>Hassle free and relaxed recruitment process.</li>
            </ul>
          </p>


        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
