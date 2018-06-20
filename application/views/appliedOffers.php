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
            <div class="col-md-12 mb-4">
              <div class="row">

              <div class="col-sm-12 mb-4">
                <form class="form-inline" style="float: right;" method = "get" action = "<?= base_url('functions/filterAppliedOffers')?>">
                  <label style="margin: 5px;"><b>Display Offers</b></label>
                  <br>
                  <select class="form-control mb-2 mr-sm-2" name="status">
                    <option value = "1" >All Applied Offer(s)</option>
                    <option value = "2" <?php if(isset($status) && $status == 2){echo "selected";}?>>Offers with Selected Status</option>
                    <option value = "3" <?php if(isset($status) && $status == 3){echo "selected";}?>>Offers with Short-Listed Status</option>
                    <option value = "4" <?php if(isset($status) && $status == 4){echo "selected";} unset($_SESSION['filter']);?>>Offers with Rejected Status</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2">Display</button>
                </form>
              </div>
            </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12 mb-4">
              <?php if(!empty($offers)){
              foreach($offers as $offer){
                ?>
              <div class="card">
                <h6 class="card-header cardheader"><?= $offer['offerTitle']?></h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Offer Type: </b><?php if($offer['offerType'] == 1){echo "Job Offer";}else{echo "Internship Offer";}?></p>
                      <?php $location = ""; $i = 1; if(!empty($offerLocations[$offer['offerID']]))foreach($offerLocations[$offer['offerID']] as $locations){ if($i == 1){$location = $location.$locations['city'];}else{$location = $location.', '.$locations['city'];} $i++;}else $location = "Work From Home"; ?>
                      <p class="card-text"><b>Offer Location(s): </b><?= $location?></p>
                      <?php $skill = ""; $i = 1; if(!empty($offerSkills[$offer['offerID']]))foreach($offerSkills[$offer['offerID']] as $skills){ if($i == 1){$skill = $skill.$skills['skill_name'];}else{$skill = $skill.', '.$skills['skill_name']; } $i++;}else $skill = "None";?>
                      <p class="card-text"><b>Skills Required: </b><?= $skill?></p>
                      <p class="card-text"><b>Application Deadline: </b><?= date_format(date_create($offer['applicationDeadline']), 'd-F-Y')?></p>
                        <p class="card-text"><b>Joining Date: </b><?= date_format(date_create($offer['joiningDate']), 'd-F-Y')?></p>
                        <?php if($offer['status'] == 4){?>
                          <p class="card-text"><b>Remarks: </b><?php if($offer['remark'] == ''){echo "None.";}else{echo $offer['remark'];}?></p>
                        <?php } ?>
                    </div>

                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Status: </b><?php if($offer['status'] == 1){echo "<b>Applied</b>";}else if($offer['status'] == 2){echo "<b style = 'color:green'>Selected</b>";}else if($offer['status'] == 3){echo "<b style = 'color:yellow'>Shortlisted</b>";}else{echo "<b style = 'color:red'>Rejected</b>";}?></p>
                        <center><img src="<?= base_url($offer['companyLogo'])?>" alt = "<?=$offer['companyLogo']?>'s Logo.'" width="150px"></center>
                        <p class = card-text><center><b><?= $offer['companyName']?></b></center></p>

                    </div>

                  </div>

                </div>
                <div class="card-footer">
                  <small class="text-muted" style="float: right;">
                    <a class="btn btn-primary" href = "<?= base_url('offer/'.$offer['offerID'])?>" target = "_blank" style="color: white; margin: 10px;">View Offer</a>
                  </small>
                </div>
              </div>
              <br>
            <?php }}else{ echo "<center>You have applied For any Offers Yet.</center>"; } ?>
              <div class ="offerCont"></div>
            </div>

            <div class="col-md-12 mb-4">
              <center><a class="btn btn-primary btn-lg loadMore" style="color: white;<?php if(!$hasMore){ echo 'display: none'; };?>">Load More</a></center>
            </div>

          </div>


        </div>
      </div>

    </div>
     <div class="card containerWrap" style = "display: none">
      <h6 class="card-header cardheader offerTitle"></h6>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">
            <p class="card-text"><b>Offer Type: </b><span class = "offerType"></span></p>
            <p class="card-text"><b>Offer Location(s): </b><span class = "offerLocation"></span></p>
          </div>
          <div class="col-md-6 mb-4">
            <p class="card-text"><b>Application Deadline: </b><span class = "applicationDeadline"></span></p>
            <p class="card-text"><b>Joining Date: </b><span class = "joiningDate"></span></p>
          </div>
          <div class="col-md-12 mb-4">
            <p class="card-text"><b>Skills Required: </b><span class = "skillsReq"></span></p>
          </div>
        </div>

      </div>
      <div class="card-footer">
        <small class="text-muted" style="float: right;">
          <a class="btn btn-primary viewOffer" href = "" target = "_blank" style="color: white; margin: 10px;">View Offer</a>
        </small>
      </div>
    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
    <script type="text/javascript">
      var j = 1;
      $(document).ready(function(){
        $('.loadMore').on('click', function(){
          url = '<?= base_url('functions/getMoreAppliedOffers')?>'
          data = {offset: j }
          $.get(url,data).done(function(res){
            res = JSON.parse(res)
            for(var i = 0; i<res.offers.length; i++){
            container = $('.containerWrap').clone()
            container.find('.offerTitle').html(res.offers[i].offerTitle)
            if(res.offers[i].offerType == 1){
              offerType = 'Job Offer'
            }else{
              offerType = 'Internship Offer'
            }

            locations = '';
            skills = '';
            if(res.offerLocations[res.offers[i].offerID]){
            for(var k = 0; k < res.offerLocations[res.offers[i].offerID].length; k++){
              if(k==0){
                locations = locations + res.offerLocations[res.offers[i].offerID][k].city
              }else{
                locations = locations+ ' ' +res.offerLocations[res.offers[i].offerID][k].city
              }
            }
            }else{
              locations = 'Work From Home'
            }
            if(res.offerSkills[res.offers[i].offerID]){
            for(var k = 0; k < res.offerSkills[res.offers[i].offerID].length; k++){
              if(k==0){
                skills = skills + res.offerSkills[res.offers[i].offerID][k].skill_name
              }else{
                skills = skills+ ' ' +res.offerSkills[res.offers[i].offerID][k].skill_name
              }
            }
          }else{
            skills = 'None'
          }
            container.find('.offerLocation').html(locations)
            container.find('.skillsReq').html(skills)
            container.find('.offerType').html(offerType)
            date = new Date(res.offers[i].applicationDeadline)
            month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            month = month[date.getMonth()];
            day = date.getDate();
            year = date.getFullYear();
            date  = day+'-'+month+'-'+year;
            container.find('.applicationDeadline').html(date)
            date = new Date(res.offers[i].joiningDate)
            month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            month = month[date.getMonth()];
            day = date.getDate();
            year = date.getFullYear();
            date  = day+'-'+month+'-'+year;
            container.find('.joiningDate').html(date)
            view = '<?= base_url('offer/')?>'
            edit = '<?= base_url('editOffer/')?>'
            access = '<?= base_url('accessApplicants/')?>'
            container.find('.viewOffer').attr('href', view + res.offers[i].offerID)
            $('.offerCont').append(container[0])
            container.show()
            }
            j++
            if(!res.hasMore){
              $('.loadMore').hide();
            }

          })
        })
      })
    </script>

  </body>

</html>
