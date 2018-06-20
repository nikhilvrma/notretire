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
                <div class="col-sm-2 mb-4">
                  <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#filters">Filter Offers</button>
                </div>
                <div class="col-sm-1 mb-4">
                </div>
              <div class="col-sm-2 mb-4">
                <a href = "<?= base_url('functions/clearOfferFilters')?>" class="btn btn-primary" style="float: right;">Clear Filters</a>
              </div>
              <div class="col-sm-7 mb-4">
                <form class="form-inline" style="float: right;" method="GET" action = "<?= base_url('functions/filterRelevantAvailable')?>">
                  <label style="margin: 5px;"><b>Display Offers</b></label>
                  <br>
                  <select class="form-control mb-2 mr-sm-2" name="status">
                    <option value = "1">All Available Offers</option>
                    <option value = "2"  <?php if(isset($status) && $status == 2){echo "selected";}?>>My Relevant Offers</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2">Display</button>
                </form>
              </div>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-4">
              <?php $j = 0; if(!empty($offers)){
              foreach($offers as $offer){
                date_default_timezone_set("Asia/Kolkata");
          			$date = strtotime($offer['applicationDeadline']);
          			$timestamp = time();
          			if(!($date<=$timestamp)){
                  $j++;
                ?>
              <div class="card">
                <h6 class="card-header cardheader"><?= $offer['offerTitle']?></h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-7 mb-4">
                      <p class="card-text"><b>Offer Type: </b><?php if($offer['offerType'] == 1){echo "Job Offer";}else{echo "Internship Offer";}?></p>
                      <?php $location = ""; $i = 1; if(!empty($offerLocations[$offer['offerID']]))foreach($offerLocations[$offer['offerID']] as $locations){ if($i == 1){$location = $location.$locations['city'];}else{$location = $location.', '.$locations['city'];} $i++;}else $location = "Work From Home";?>
                      <p class="card-text"><b>Offer Location(s): </b><?= $location?></p>
                      <?php $skill = ""; $i = 1; if(!empty($offerSkills[$offer['offerID']]))foreach($offerSkills[$offer['offerID']] as $skills){ if($i == 1){$skill = $skill.$skills['skill_name'];}else{$skill = $skill.', '.$skills['skill_name']; } $i++;}else $skill = "None";?>
                      <p class="card-text"><b>Skills Required: </b><?= $skill?></p>
                      <p class="card-text"><b>Application Deadline: </b><?= date_format(date_create($offer['applicationDeadline']), 'd-F-Y')?></p>
                        <p class="card-text"><b>Joining Date: </b><?= date_format(date_create($offer['joiningDate']), 'd-F-Y')?></p>
                    </div>
                    <div class="col-md-5 mb-4">
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
            <?php }}}else{ echo "<center>There are no Offers Available Yet.</center>"; } if(!empty($offers) && $j == 0){echo "<center>There are no Offers Available Yet.</center>";}?>
              <div class ="offerCont"></div>
            </div>

            <div class="col-md-12 mb-4">
              <center><a class="btn btn-primary btn-lg loadMore" style="color: white;<?php if(!$hasMore){ echo 'display: none'; };?>">Load More</a></center>
            </div>

          </div>


        </div>
      </div>

    </div>

    <div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Offers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method = "GET" action = "<?=base_url('functions/filterAvailableOffers')?>">
          <div class="modal-body">
              <div class="row">
              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Offer Type</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="offerType[]" value = "1" <?php if(isset($appliedFilters['offerType']) && $appliedFilters['offerType'] != '' && in_array('1',$appliedFilters['offerType'])){echo "checked";}?>><label style="margin-left: 5px;">Job Offers</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="offerType[]" value = "2" <?php if(isset($appliedFilters['offerType']) && $appliedFilters['offerType'] != '' && in_array('2',$appliedFilters['offerType'])){echo "checked";}?>><label style="margin-left: 5px;">Internship Offers</label></div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Skills</b>
                  <div style="margin-top: 10px;">
                    <?php if(isset($allOfferSkills)){?>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="offerSkills[]" value = "0" <?php if(isset($appliedFilters['offerSkills']) && $appliedFilters['offerSkills'] != '' && in_array('0',$appliedFilters['offerSkills'])){echo "checked";} if(isset($status)){ echo "checked";}?>><label style="margin-left: 5px;" >No Skill Required.</label></div>

                      <?php foreach($allOfferSkills as $offerSkill){?>
                        <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="offerSkills[]" value = "<?= $offerSkill['skillID']?>" <?php if(isset($appliedFilters['offerSkills']) && $appliedFilters['offerSkills'] != '' && in_array($offerSkill['skillID'] ,$appliedFilters['offerSkills'])){echo "checked";} if(isset($status) && $userSkills!= '' && in_array($offerSkill['skillID'] ,$userSkills)){ echo "checked";}?>><label style="margin-left: 5px;"><?= $offerSkill['skill_name']?></label></div>
                    <?php }}else{
                      echo "No Added offer Has any Skill Requirement.";
                    }?>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Location</b>
                  <div style="margin-top: 10px;">
                    <?php if(isset($allOfferLocations)){?>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name = "offerLocations[]" value="0" <?php if(isset($appliedFilters['offerLocations']) && $appliedFilters['offerLocations'] != '' && in_array('0',$appliedFilters['offerLocations'])){echo "checked";}?>><label style="margin-left: 5px;" >Work From Home</label></div>
                      <?php foreach($allOfferLocations as $offerLocation){?>
                        <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name = "offerLocations[]" value="<?= $offerLocation['cityID']?>" <?php if(isset($appliedFilters['offerLocations']) && $appliedFilters['offerLocations'] != '' && in_array($offerLocation['cityID'] ,$appliedFilters['offerLocations'])){echo "checked";} ?>><label style="margin-left: 5px;" ><?= $offerLocation['city'].', '. $offerLocation['state'] ?></label></div>
                      <?php }}else{
                      echo "All The offers Added are Work From Home.";
                    }?>
                  </div>
                </div>
              </div>

              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href = "<?=base_url('available-offers')?>" class="btn btn-primary">Reset</a>
            <input type="submit" class="btn btn-primary" value = "Apply">
          </div>
        </form>
        </div>
      </div>
    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

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

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>
        <script type="text/javascript">
      var j = 1;
      $(document).ready(function(){
        $('.loadMore').on('click', function(){
          url = '<?= base_url('functions/getMoreOffers')?>'
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
