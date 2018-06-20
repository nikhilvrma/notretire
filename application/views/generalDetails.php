<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url('/assets/css/croppie.css'); ?>" rel="stylesheet">
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

          <form method="post" action="<?php echo base_url('functions/updateGeneralDetails'); ?>">

            <div class="row">



              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Full Name:</b></label>
                  <input type="text" class="form-control" value="<?php echo $generalData['name']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-4 control-group form-group">
                <div class="controls">
                  <label><b>E-Mail Address:</b></label>
                  <input type="email" class="form-control" value="<?php echo $generalData['email']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-3 control-group form-group">
                <div class="controls">
                  <label><b>Mobile Number:</b></label>
                  <input type="text" maxlength="10" class="form-control" value="<?php echo $generalData['mobile']; ?>" disabled>
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-5 control-group form-group">
                <div class="controls">
                  <label><b>Current Location:</b></label>
                  <select name = "location" class="form-control">
                    <option value = "0"> </option>
                    <?php foreach($locations as $location){
                      if($location['cityID'] != $generalData['cityID']){
                      ?>
                    <option value="<?= $location['cityID']?>"><?=$location['city']?>, <?=$location['state']?></option>
                    <?php }else{?>
                    <option value="<?= $location['cityID']?>" selected><?=$location['city']?>, <?=$location['state']?></option>
                  <?php  }} ?>
                  </select>
                  <p class="help-block"></p>
                </div>
              </div>

              <?php if($_SESSION['user_data']['accountType'] == 1){?>
              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Career Objective:</b></label>
                  <textarea class="form-control" id="careerObjective" name="careerObjective" required>
                     <?php echo $generalData['careerObjective']; ?>
                  </textarea>
                  <p class="help-block"></p>
                </div>
              </div>


              <?php } ?>
              <?php if($_SESSION['user_data']['accountType'] == 2){?>
              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Company Name:</b></label>
                  <input type="text" class="form-control" placeholder="Company Name" name="companyName" value = " <?php echo $companyData['companyName']; ?>">
                  <p class="help-block"></p>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <label><b>Company Description:</b></label>
                  <textarea class="form-control" id="companyDescription" name = "companyDescription"> <?php echo $companyData['companyDescription']; ?></textarea>
                  <p class="help-block"></p>
                </div>
              </div>
              <?php } ?>

            </div>
            <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
            <button type="submit" class="btn btn-primary" id="sendMessageButton" style="float: right;">Update General Details</button>
          </form>

          <div class="clearfix"></div>


          <?php if($_SESSION['user_data']['accountType'] == 1){?>

          <div class="col-md-12 control-group form-group" style="margin-top: 5%">
            <div class="controls">
              <label><b>Preferred Location(s):</b></label>
              <table class="table">
                <?php if(!empty($preferredLocation)){
                  $i = 1;

                  ?>

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">City</th>
                  <th scope="col" style="width: 20%">Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach($preferredLocation as $location){?>
                <tr>
                  <th scope="row"><?= $i?></th>
                  <td><?= $location['city']?>, <?= $location['state']?></td>
                  <td><a class="btn btn-danger" href = "<?= base_url('functions/deletePreferredLocation?location='.$location['cityID'])?>" style="color: white; font-size: 14px;"><i class="fa fa-trash"></i> Remove</a></td>
                </tr>
                <?php $i++;}}else{?>
                 <tbody>
                <tr>No Preferred Location Added.</tr>
                <?php }if(sizeof($preferredLocation) < 5){ ?>

                <tr>
                  <td colspan="3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLocation" style="color: white; float: right;">Add Preferred Location</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
          </div>

          <div class="col-md-12 control-group form-group" style="margin-top: 5% ">
            <div class="controls">
              <label><b>Available For:</b></label>
              <table class="table">
                <tr>
                  <?php if($generalData['available'] == 0){echo "Not available for both Job and Internship Offers.";}else if($generalData['available'] == 1){echo "Available for Job Offers.";}else if($generalData['available'] == 2){echo "Available for Internship Offers.";}else{echo "Available for Job and Internship Offers.";}?>
                </tr>
                <tr>
                  <td colspan="3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#availability" style="color: white; float: right;">Update Availability</button></td>
                </tr>

              </tbody>
            </table>
            </div>
          </div>

          <?php } ?>

          <div class="clearfix"></div>

          <h3 class="mt-4 mb-3" style="float: right;">Profile Image</h3>
          <div class="clearfix"></div>
          <hr>
          <div class="row">

          <div class="col-md-4 mb-4">
            <b>Current Profile Image</b>
            <center><img src="<?php echo base_url().$_SESSION['user_data']['profileImage']; ?>" style="width: 100%; border-radius: 50%;"></center>
          </div>

          <div class="col-md-8 mb-4">
            <b>Upload New Profile Image</b>


                <br>

                <div class="col-md-12 control-group form-group" style="margin-top: 35px;">
                  <div class="controls">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile Image</button>
                  </div>
                </div>





          </div>
        </div>

        <div class="clearfix"></div>
        <?php if($_SESSION['user_data']['accountType'] == 2){?>
        <h3 class="mt-4 mb-3" style="float: right;">Company Logo</h3>
        <div class="clearfix"></div>
        <hr>
        <div class="row">

        <div class="col-md-5 mb-4">
          <b>Current Uploaded Company Logo</b>
          <?php if(isset($companyData['companyLogo'])){?>
            <center><img src="<?php echo $companyData['companyLogo'] ?>" style="width: 100%;"></center>
          <?php }else{?>
          <p style="margin-top: 20px; font-size: 14px;">No Logo Uploaded Yet</p>
          <?php }?>
        </div>

        <div class="col-md-7 mb-4">
          <b>Upload New Company Logo</b>




              <br>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <button type="submit" class="btn btn-primary"  data-toggle="modal" data-target="#myModal2" >Update Company Logo</button>
                </div>
              </div>







        </div>
      </div>
      <?php } ?>

        </div>
      </div>

    </div>

    <div class="modal fade" role="dialog" id="myModal">
    <div class="modal-dialog">
   <div class="modal-content">


     <div class="modal-body">
      <h3>Edit Profile Pic</h3>
      <form action="<?php echo base_url('functions/updateProfileImage'); ?>" method="POST" class="form" enctype="multipart/form-data">
        <div class="horizontal-group">
          <div class="form-group">
            <div class = "inputPic">
              <label>New Profile Image:</label>
              <input type="file" class="form__input updatedUserPic" id="updatedUserPic" required accept="image/*" name = img[] required>
              <input type="hidden" name="profilePic">
              <p class="help-block" style="font-size: 14px;">Formats allowed include .jpg, .jpeg, and .png<br>Maximum file size allowed in 4 MB</p>
            </div>
          </div>
        </div>
        <div class = "form-group">
          <div class = "crop" style = "display:none">
            <img src="" alt="" id="cropped-pic" style ="padding-left: 7%">
          </div>
        </div>
        <div class="form-group action-bar" style="float: right">
           <button type="button" class="btn btn-default close-save_pic" data-dismiss="modal" style="display: none">Close</button>
         <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
          <input type = 'submit'  class="btn btn--primary save_pic" value="Save Changes" style="display: none">
        </div>
      </form>
        <div class="form-group action-bar" style="float: right">
         <button type="button" class="btn btn-default close-upload-pic" data-dismiss="modal">Close</button>
          <button class="btn btn--primary upload-pic">Upload Image</button>
        </div>
    </div>
  </div>
</div>
  </div>

      <div class="modal fade" role="dialog" id="myModal2">
    <div class="modal-dialog">
   <div class="modal-content">


     <div class="modal-body">
      <h3>Edit Company Logo</h3>
      <form action="<?php echo base_url('functions/updateCompanyImage'); ?>" method="POST" class="form" enctype="multipart/form-data">
        <div class="horizontal-group">
          <div class="form-group">
            <div class = "inputLogo">
              <label>New Company Logo:</label>
             <input type="file" class="form__input logo" id="logo" required accept="image/*" name = img[] required>
              <input type="hidden" name="companyLogo">
              <p class="help-block" style="font-size: 14px;">Formats allowed include .jpg, .jpeg, and .png<br>Maximum file size allowed in 4 MB</p>
            </div>
          </div>
        </div>
       <div class = "form-group">
          <div class = "demo" style = "display:none">
            <img src="" alt="" id="cropped-img" style ="padding-left: 18%">
          </div>
        </div>
        <div class="form-group action-bar" style="float: right">
           <button type="button" class="btn btn-default close-submit-changes" data-dismiss="modal" style="display: none">Close</button>
           <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
          <input type = 'submit'  class="btn btn--primary submit-changes" value="Save Changes" style="display: none">
        </div>
      </form>
        <div class="form-group action-bar" style="float: right">
         <button type="button" class="btn btn-default close-upload-result" data-dismiss="modal">Close</button>
          <button class="btn btn--primary upload-result">Upload Image</button>
        </div>
    </div>
  </div>
</div>
  </div>

  <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method = "POST" action = "<?= base_url('functions/addPreferredLocation')?>">
        <div class="modal-body">

            <div class="row">
            <div class="col-md-12 control-group form-group">
              <div class="controls">
                <label>Location:</label>
                <select name = "preferredLocation" class="form-control">
                    <option value = "0"> </option>
                    <?php foreach($locations as $location){?>
                    <option value="<?= $location['cityID']?>"><?=$location['city']?>, <?=$location['state']?></option>
                    <?php } ?>
                  </select>
                  <p class="help-text" style="font-size: 12px; color: red;">Maximum of 5 Preferred Location(s) can be Added to the Profile.</p>
              </div>
            </div>
            </div>


        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Location</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="availability" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Availability</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method = "POST" action = "<?= base_url('functions/addAvailability')?>">
        <div class="modal-body">
            <div class="row">
            <div class="col-md-12 control-group form-group">
              <div class="controls">
                <label>Availability:</label>
                <select name = "availability" class="form-control">
                    <option value = "0">Not available for both Job and Internship Offers</option>
                    <option value = "1">Available for Job Offers</option>
                    <option value = "2">Available for Internship Offers</option>
                    <option value = "3">Available for Job and Internship Offers</option>
                  </select>
              </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Availability</button>
        </div>
      </form>
      </div>
    </div>
  </div>


    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script src="<?= base_url('assets/js/croppie.js')?>"></script>
    <script>
      $(document).ready(function(){
        <?php if($_SESSION['user_data']['accountType'] == 1){?>
        editor = CKEDITOR.replace('careerObjective');
        <?php } ?>
        <?php if($_SESSION['user_data']['accountType'] == 2){?>
        editor = CKEDITOR.replace('companyDescription');
        <?php } ?>
      });
      </script>

      <script type="text/javascript">
  var $uploadImage;

  function readFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $uploadImage.croppie('bind', {
          url: e.target.result
        });
        $('.crop').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
    else {
      alert("Sorry - you're browser doesn't support the FileReader API");
    }
  }
  $uploadImage = $('#cropped-pic').croppie({
    viewport: {
      width: 400,
      height: 400,
      type: 'square'
    },
    boundary: {
      width: 450,
      height: 450,
    },
    exif: false
  });


  $('#updatedUserPic').on('change', function () { readFile(this)});
  $('.upload-pic').on('click', function () {
      $uploadImage.croppie('result',{
        type: 'canvas',
        size: 'viewport',
        format:'jpeg'
      }).then(function (resp) {
        console.log(resp)
        $('.upload-pic').hide();
        $('.save_pic').show();
         $('.close-upload-pic').hide();
        $('.close-save_pic').show();
        $('.cr-boundary').hide();
        $('.cr-slider-wrap').hide();
        $('.inputPic').hide();
        $('#cropped-pic').attr('src', resp)
        $('#cropped-pic').show()
        $('.crop').show()
        $('input[name="profilePic"]').val(resp)
        $('#userProfilePic').hide()
      });
    });
  </script>

  <script type="text/javascript">
  var $uploadCrop;

  function readImgFile(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        console.log(e.target.result)
        $uploadCrop.croppie('bind', {
          url: e.target.result
        });
        $('.demo').show();
      }
      reader.readAsDataURL(input.files[0]);
    }
    else {
      alert("Sorry - you're browser doesn't support the FileReader API");
    }
  }
  $uploadCrop = $('#cropped-img').croppie({
    viewport: {
      width: 300,
      height: 300,
      type: 'square'
    },
    boundary: {
      width: 350,
      height: 350,
    },
    exif: false
  });

  $('#logo').on('change', function () { readImgFile(this)});
  $('.upload-result').on('click', function () {
      $uploadCrop.croppie('result',{
        type: 'canvas',
        size: 'viewport',
        format:'jpeg'
      }).then(function (resp) {
        console.log(resp)
        $('.upload-result').hide();
        $('.submit-changes').show();
         $('.close-upload-result').hide();
        $('.close-submit-changes').show();
        $('.cr-boundary').hide();
        $('.cr-slider-wrap').hide();
        $('.inputLogo').hide();
        $('#cropped-img').attr('src', resp)
        $('#cropped-img').show()
        $('.demo').show()
        $('input[name="companyLogo"]').val(resp)
      });
    });
  </script>




  </body>

</html>
