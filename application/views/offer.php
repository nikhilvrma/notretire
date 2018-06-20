<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle."|CampusPuppy"; ?></title>

    <?php echo $headerFiles; ?>

    <meta property="og:url"                content="<?= base_url('offers/'.$offerDetails[0]['offerID'])?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?= $offerDetails[0]['offerTitle']?>" />
    <?php
    if(isset($_SESSION['loginRedirect']) && isset($_SESSION['offerID'])){
      unset($_SESSION['loginRedirect']);
      unset($_SESSION['offerID']);
    }
    if($offerDetails[0]['offerType'] == 1 ){
      $type = 'Job';
    }else{
      $type = 'Internship';
    }
    $employer = $employerDetails['companyName'];
    if(!empty($offerLocations)){
      $i = 0;
      foreach($offerLocations as $locations){
        if($i == 0)
          $loc = 'at '.$locations['city'];
        else
          $loc = ', '.$locations['city'];
        $i++;
      }
    }else{ $loc = "Work From Home";} ?>
    <meta property="og:description"        content="<?= $type?> Opportunity with <?= $employer?> <?= $loc?>"/>
    <meta property="og:image"              content="<?= base_url('/')?><?= $employerDetails['companyLogo']?>" />

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
          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $type." ".$pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>
          <div class="row">


              <div class="col-md-12 mb-4" style="font-size: 14px;">

                <div class="row">

                <div class="col-sm-8">

                    <p>
                    <b>Offer Title: </b>
                      <?= $offerDetails[0]['offerTitle' ]?>
                    </p>

                    <p>
                    <b>Offer Description: </b><br>
                      <?= $offerDetails[0]['offerDescription']?>
                    </p>

                    <p>
                    <b>Skill(s) Required</b><br>
                      <ul>
                        <?php if(!empty($offerSkills))foreach($offerSkills as $skills){ ?>
                        <li><?= $skills['skill_name']?></li>
                        <?php }else echo "No Skills Required"; ?>
                      </ul>
                    </p>

                    <p>
                    <b>Location(s)</b><br>
                      <ul>
                        <?php if(!empty($offerLocations))foreach($offerLocations as $locations){ ?>
                        <li><?= $locations['city'].', '.$locations['state'] ?></li>
                        <?php }else echo "Work From Home"; ?>
                      </ul>
                    </p>

                    <p>
                    <b>Compensation Offered</b>
                    <?php if(isset($offerDetails[0]['compensation'])){?>
                      INR <?= $offerDetails[0]['compensation'] ?>/- per month
                    <?php }else if(isset($offerDetails[0]['minCompensation']) && isset($offerDetails[0]['maxCompensation'])){?>
                      INR <?= $offerDetails[0]['minCompensation'].' - '. $offerDetails[0]['maxCompensation'] ?>/- per month
                    <?php }else{?>
                      <?php echo("No Compensation Will be awarded.")?>
                    <?php } ?>
                    </p>

                    <p>
                    <?php if($offerDetails[0]['offerType'] == 2){?>
                      <h6><b>Internship Duration</b></h6>
                        <?= $offerDetails[0]['duration'] ?> Weeks
                      </p>
                    <?php } ?>

                    <p>
                    <b>Joining Date</b>
                      <?= date_format(date_create($offerDetails[0]['joiningDate']), 'd-F-Y')?>
                    </p>

                    <p>
                    <b>Number of Opening(s)</b>
                      <?= $offerDetails[0]['openings']?>
                    </p>

              </div>

              <div class="col-sm-4">

                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <center><img src="<?php echo base_url().$employerDetails['companyLogo']; ?>" style="width: 80%;">
                        <p class="card-text"><b><?= $employerDetails['companyName']?></b></p>
                        </center>
                        <!-- <p class="card-text"><b>Website: </b>http://www.campuspuppy.com/</p> -->
                        <?php if($offerDetails[0]['active'] == 1 && $offerDetails[0]['approved'] == 1){?>
                        <p class="card-text" style="margin-top: 15px;"><b>Share: </b></p>
                        <p class="card-text" style="margin-top: 40px;">
                          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('offers/'.$offerDetails[0]['offerID'])?>" target="_blank" class="btn" style="color: white; background: #3b5998;"><i class="fa fa-facebook"></i></a>
                          <a href="https://twitter.com/intent/tweet?url=<?= base_url('offers/'.$offerDetails[0]['offerID'])?>" class="btn" style="color: white; background: #1DA1F2;"><i class="fa fa-twitter"></i></a>
                        </p>
                      <?php } ?>

                        <p class="card-text" style="margin-top: 15px;"><b>Application Deadline: </b><br><?php echo date_format(date_create($offerDetails[0]['applicationDeadline']), 'd-F-Y');?></p>
                        <br>
                        <hr>

                        <?php if(isset($_SESSION['user_data']['accountType']) && $_SESSION['user_data']['accountType'] != 2){?>
                          <!-- <p class="card-text"><center><a href = "<?= base_url('functions/apply/'.$offerDetails[0]['offerID'])?>" class="btn btn-lg btn-primary" style="color: white;">Apply Now</a></center></p> -->
                          <br>
                          <center><button class="btn btn-primary btn-lg applyNow" style="color: white;">Apply Now</button></center>
                        <?php } else if(!isset($_SESSION['user_data']['accountType'])){?>
                          <p class="card-text" style="margin-top: 15px;"><center><a href = "<?= base_url('functions/apply/'.$offerDetails[0]['offerID'])?>" class="btn btn-lg btn-primary" style="color: white;">Apply Now</a></center></p>
                        <?php }?>
                        <?php if(isset($_SESSION['user_data']['accountType']) && $_SESSION['user_data']['accountType'] == 2){
                          if($offerDetails[0]['approved'] == 0){?>
                           <p class="card-text" style="margin-top: 15px; float:right"><a class="btn btn-primary editoffer" target="_blank" href = "<?= base_url('edit-offer/'.$offerDetails[0]['offerID'])?>" style="color: white;">Edit Offer</a></p>
                        <?php }}?>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            </div>



          </div>


        </div>
      </div>

</div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <p>
               <ol>
                 <li>High School Educational Detail. <?php if($userData['education'][1]){?><i class="fa fa-check" aria-hidden="true" style="color: green;"></i><?php }else{?><i class="fa fa-times" aria-hidden="true" style="color: red;"></i><i style="font-size: 14px;"><a href = "<?= base_url('educational-details')?>">Add Education to Profile Now</a></i><?php } ?></li>

                 <li>Senior Secondary (or equivalent) Educational Details. <?php if($userData['education'][2]){?><i class="fa fa-check" aria-hidden="true" style="color: green;"></i><?php }else{?><i class="fa fa-times" aria-hidden="true" style="color: red;"></i><i style="font-size: 14px;"><a href = "<?= base_url('educational-details')?>">Add Education to Profile Now</a></i><?php } ?></li>

                 <li>Graduation Educational Details. <?php if($userData['education'][3]){?><i class="fa fa-check" aria-hidden="true" style="color: green;"></i><?php }else{?><i class="fa fa-times" aria-hidden="true" style="color: red;"></i><i style="font-size: 14px;"><a href = "<?= base_url('educational-details')?>">Add Education to Profile Now</a></i><?php } ?></li>
                 <?php if(!empty($offerSkills)){
                  foreach($offerSkills as $offerSkill){?>
                    <li>Skill: <b><?= $offerSkill['skill_name']?></b>. <?php if(!$offerSkill['user']){?><i class="fa fa-times" aria-hidden="true" style="color: red;"></i><?php }else{?><i class="fa fa-check" aria-hidden="true" style="color: green;"></i><i style="font-size: 14px;"><a>Add Skill to Profile Now</a></i><?php } ?></li>
                  <?php } }?>
               </ol>
             </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script type="text/javascript">
      education = '<?php if(isset($userData['education'])){ echo json_encode($userData['education']);}else{echo "null";}?>'
      skills = '<?= json_encode($offerSkills)?>'
      allSkillSatisfied = '<?= json_encode($allSkillSatisfied)?>'
      education = JSON.parse(education)
      skills = JSON.parse(skills)
      $(document).ready(function(){
        $('body').on('click','.applyNow', function(){
          if(!education[1] || !education[2] || !education[3]){
           $('#myModal').modal('show');
          }else if(!allSkillSatisfied){
            $('#myModal').modal('show');
          }else{
            window.location.href = '<?= base_url('functions/apply/'.$offerDetails[0]['offerID'])?>'
          }
        })
        //
      })
    </script>

  </body>

</html>
