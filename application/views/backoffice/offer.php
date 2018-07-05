<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Offer|Not Retire"; ?></title>

    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/backoffice.css'); ?>" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">


    <?php
    if($offerDetails[0]['offerType'] == 1 ){
      $type = 'Job';
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

  </head>

  <body>

    <nav class="navbar fixed-top nav-bg navbar-expand-lg navbar-dark bg-dark fixed-top" style="height: 70px;">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img class="img-responsive" src="<?php echo base_url('assets/images/nr_logo_white.png'); ?>" style="width: 14%; margin: 10px;">
        </a>
      </div>
    </nav>

    <div class="container" style="margin-top: 10px;">


      <?php if($message['content']!=''){?>

      <ol class="breadcrumb" style="background-color: white !important; margin-top: 20px; border: 1px solid <?=$message['color']?>;">
        <li style="color: <?=$message['color']?>;"><?=$message['content']?></li>
      </ol>
    	<?php }?>

      <div class="row">

        <div class="col-lg-12 mb-4">
          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $type." Offer"; ?></h3>
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
                        <?php if($offerDetails[0]['active'] == 1 && $offerDetails[0]['approved'] == 1){?>
                        <p class="card-text" style="margin-top: 15px;"><b>Share: </b></p>
                        <p class="card-text" style="margin-top: 40px;">
                        </p>
                      <?php } ?>

                        <p class="card-text" style="margin-top: 15px;"><b>Application Deadline: </b><br><?php echo date_format(date_create($offerDetails[0]['applicationDeadline']), 'd-F-Y');?></p>
                        <br>
                        <hr>

                        <?php if($offerDetails[0]['approved'] == 0){?><a href = "<?= base_url('backoffice/approveOffer/'.$offerDetails[0]['offerID'])?>" class="btn btn-success" style="color: white;"><b><i class="fa fa-check"></i></b></a><?php }else if($offerDetails[0]['approved'] == 1){ echo "<p style = 'color: green'>Approved</p>";}?>

                        <?php if($offerDetails[0]['approved'] != 2){?><button class="btn btn-danger reject" id = "rejectOffer<?= $offerDetails[0]['offerID']?>" data = "<?= $offerDetails[0]['offerID']?>" style="color: white;"><b><i class="fa fa-times"></i></b></button><?php }else if($offerDetails[0]['approved'] == 2){ echo "<p style = 'color: red'>Rejected</p>";}?>

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


    <footer class="py-5 bg-dark nav-bg">
     <div class="container">
       <p class="m-0 text-center text-white" style="font-size: 15px;"><a style="color: white;" href="<?php echo base_url('about-us'); ?>">About</a> | <a style="color: white;" href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a> | <a style="color: white;" href="<?php echo base_url('terms-and-conditions'); ?>">Terms and Conditions</a> | <a style="color: white;" href="<?php echo base_url('contact-us'); ?>">Contact Us</a></p>
       <br>
       <p class="m-0 text-center text-white" style="font-size: 14px;">Copyright &copy; Campus Puppy Private Limited 2018</p>
     </div>
    </footer>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remarks</h4>
      </div>
      <div class="modal-body">
          <label><b>Add Remark:</b></label>
          <textarea class = "form-control other" name = "other" placeholder="Remark.."></textarea>
        <div class="candidateData"></div><br>
        <button  class = "form-control btn btn-primary addRemark">Add Remark</button>

      </div>
    </div>

  </div>
</div>

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script>

    $(document).ready(function(){
      $('body').on('click', '.reject', function(){
        id = $(this).attr('id')
        data = $('#'+id).attr('data')
        $('.candidateData').html('<input type="hidden" class = "offerID" name = "offerData" value = "'+data+'">')
        $('#myModal').modal({backdrop: 'static', keyboard: false})
      })
    })

    $(document).ready(function(){
      $('body').on('click', '.addRemark', function(){
        data = $('.offerID').val()
        remark = $('.other').val()
        console.log(remark)
        url = '<?=base_url('backoffice/rejectOffer/')?>'+data
        console.log(url)
        postData = {
          remark:remark
        }
        $.get(url,postData).done(function(res){
          if(res == 'true'){
            location.reload()
          }else{
            console.log(res)
          }
        })
      })
    })
    </script>
  </body>

</html>
