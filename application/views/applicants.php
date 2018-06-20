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

        <?php echo $sidebar; ?>

        <div class="col-lg-9 mb-4">

          <ol class="breadcrumb" style="margin-top: 30px;">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('general-details'); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('my-added-offers'); ?>">My Added Offers</a>
          </li>
          <li class="breadcrumb-item active">Applicants</li>
        </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <p>Listing Applicants for the Offer: <b><?= $offerTitle?></b></p>
          <hr>

          <div class="row">
            <div class="col-md-12 mb-4">
              <div class="row">

              <div class="col-sm-2 mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filters">Filter Applicants</button>
              </div>
              <div class="col-sm-1 mb-4"></div>
              <div class="col-sm-1 mb-4">
                <a href = "<?= base_url('functions/clearFilters/'.$offer)?>" class="btn btn-primary">Clear Filters</a>
              </div>
              <div class="col-sm-1 mb-4"></div>
              <div class="col-sm-7 mb-4">
                <form class="form-inline" style="float: right;" method = "get" action = "<?= base_url('functions/filterApplicantsByStatus/'. $offer)?>">
                  <label style="margin: 5px;"><b>Display Applicants</b></label>
                  <br>
                  <select class="form-control mb-2 mr-sm-2" name = "type">
                    <option value = "1" <?php if($type == 1){echo 'selected';}?>>All Applicants</option>
                    <option value = "2" <?php if($type == 2){echo 'selected';}?>>Selected Applicants</option>
                    <option value = "3" <?php if($type == 3){echo 'selected';}?>>Short-Listed Applicants</option>
                    <option value = "4" <?php if($type == 4){echo 'selected';}?>>Rejected Applicants</option>
                    <option value = "5">Applicants to Compare</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2">Display</button>
                </form>
              </div>
            </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12 mb-4" id = "candidateList">
              <?php
              if(empty($applicants)){echo "<center>No Applicant Found.</center>";}foreach($applicants as $applicant){ ?>
              <div class="card" id = "candidate<?= $applicant['userID']?>">
                <h6 class="card-header cardheader"><span class = "title" id = 'title<?= $applicant['userID']?>'><?= $applicant['name']?></span><br><br><a href = "<?= base_url('hiring-nucleus/profile/'.$offer.'/'.$applicant['userID'])?>" target = "_blank"><label style="font-size: 14px;">View Profile</label></a></h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text" style="font-size: 14px;"><b>Skills: </b><br>
                        <ul style="font-size: 14px;">
                          <?php $skills = explode(',', $applicant['skillName']);
                                $skillScore = explode(',', $applicant['score']);
                                $skillType = explode(',', $applicant['type']);
                                $i=0;
                                $k = 0;
                          if($applicant['skillName'] == Null){
                            echo "No Skill Found";
                          }else{
                          foreach ($skills as $key => $skill) {
                            if(($skillType[$i] == 2 && $skillScore[$i] >= 10) || $skillType[$i] == 1){ $k++;?>
                            <li><?= $skill?> <?php if($skillType[$i] == 2){echo '<sup style="color: red;">Premium</sup>';}?></li>
                          <?php }$i++;} if($k == 0){echo "No Skill Found";}} ?>
                         <!--<sup style="color: red;">Premium</sup>  -->
                        </ul>
                      </p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Status: </b><label class = "status" id = "status<?= $applicant['userID']?>"><?php if($applicant['status'] == 1){echo "<b>Applied</b>";}else if($applicant['status'] == 2){echo "<b style = 'color:green'>Selected</b>";}else if($applicant['status'] == 3){echo "<b style = 'color:yellow'>Shortlisted</b>";}else{echo "<b style = 'color:red'>Rejected</b>";}?></label></p>
                      <p class="card-text"><b>Gender: </b><?php if($applicant['gender'] == 'M'){echo "Male";}else if($applicant['gender'] == 'F'){echo "Female";}else{echo "Gender Not Found.";}?></p>
                      <p class="card-text"><b>Location: </b><?= $applicant['city'].', '. $applicant['state']?></p>
                    </div>
                    <div class="col-md-12 mb-4">
                      <p class="card-text"><b>E-Mail Address: </b><label class = "email" id = "email<?= $applicant['userID']?>"><?php if($applicant['status'] == 3 || $applicant['status'] == 2){echo $applicant['email'];}else{?><i>Short-List Applicant to unlock E-Mail Address</i><?php } ?></label></p>
                      <p class="card-text"><b>Mobile Number: </b><label class="mobile" id = "mobile<?= $applicant['userID']?>"><?php if($applicant['status'] == 3 || $applicant['status'] == 2){echo $applicant['mobile'];}else{?><i>Short-List Applicant to unlock Mobile Number</i><?php } ?></label></p>
                    </div>
                  </div>

                </div>
                <div class="card-footer ">
                  <small style = "float:right;">
                    <?php  if(!in_array($applicant['userID'], $_SESSION['compare'])){?>
                    <a class="btn btn-primary addToCompare" id = "addToCompare<?= $applicant['userID']?>" data = "<?= $applicant['userID']?>" style="color: white; margin: 10px;">Compare Applicant</a>
                    <?php }else{?>
                      <a class="btn btn-primary removeFromCompare" id = "removeFromCompare<?= $applicant['userID']?>" data = "<?= $applicant['userID']?>" style="color: white; margin: 10px;">Remove From Compare</a>
                    <?php }?>

                    <br><a href="<?= base_url('hiring-nucleus/compare-applicants')?>" style="float: right; margin-right: 2% ">Access Compare Applicants</a>
                  </small>

                  <small class="text-muted buttonContainer<?= $applicant['userID']?>" style="float: right;">
                    <?php if($applicant['status'] != '2' && $applicant['status'] != '4'){?>
                      <a class="btn btn-success selectCandidate" id = "selectCandidate<?= $applicant['userID']?>" data = "<?= $applicant['userID']?>" style="color: white; margin: 10px;">Select Applicant</a>
                    <?php }
                    ?>

                    <?php if($applicant['status'] != '3' && $applicant['status'] != '2'&& $applicant['status'] != '4'){?>
                      <a class="btn btn-warning shortlistCandidate" id = "shortlistCandidate<?= $applicant['userID']?>" data = "<?= $applicant['userID']?>" style="color: white; margin: 10px;">Short-list Applicant</a>
                    <?php }?>

                    <?php if($applicant['status'] != '4'){?>
                      <a class="btn btn-danger rejectCandidate" id = "rejectCandidate<?= $applicant['userID']?>" data = "<?= $applicant['userID']?>" style="color: white; margin: 10px;">Reject Applicant</a>
                    <?php }?>
                  </small>
                </div>
              </div>
              <br>
              <?php } ?>
            </div>

            <?php if($hasMore){?>
            <div class="col-md-12 mb-4">
              <center><a class="btn btn-primary btn-lg" id = "loadMore" style="color: white;">Load More</a></center>
            </div>
            <?php } ?>

          </div>


        </div>
      </div>

    </div>

    <div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Applicants</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action = "<?= base_url('functions/filterApplicantsByParameters/'.$offer)?>" method = "GET">
          <div class="modal-body">

              <div class="row">

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Gender</b>
                  <div style="margin-top: 10px;">
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="gender[]" value = "M" <?php if(isset($appliedFilters['gender']) && $appliedFilters['gender'] != '' && in_array('M',$appliedFilters['gender'])){echo "checked";}?>><label style="margin-left: 5px;">Male</label></div>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="gender[]" value = "F" <?php if(isset($appliedFilters['gender']) && $appliedFilters['gender'] != '' && in_array('F',$appliedFilters['gender'])){echo "checked";}?>><label style="margin-left: 5px;">Female</label></div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Skills</b>
                  <div style="margin-top: 10px;">
                    <?php if(!empty($allOfferSkills)){ foreach($allOfferSkills as $offerSkill){ if(isset($offerSkill['skillID'])){?>
                      <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="skills[]" value = "<?=$offerSkill['skillID']?>" <?php if(isset($appliedFilters['skills']) && $appliedFilters['skills'] != '' && in_array($offerSkill['skillID'] ,$appliedFilters['skills'])){echo "checked";} ?>><label style="margin-left: 5px;"><?= $offerSkill['skill_name']?></label></div>
                    <?php }}}else{echo "Skill Filter Not Applicable.";}?>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Location</b>
                  <div style="margin-top: 10px;">
                    <!-- <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" value = "0" name="locations[]" <?php if(isset($appliedFilters['locations']) && $appliedFilters['locations'] != '' && in_array('0',$appliedFilters['locations'])){echo "checked";}?>><label style="margin-left: 5px;">Work From Home.</label></div> -->
                    <?php if(!empty($allOfferLocations)){ foreach($allOfferLocations as $offerLocation){ if(isset($offerLocation['cityID'])){?>
                      <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="locations[]" value = "<?= $offerLocation['cityID']?>" <?php if(isset($appliedFilters['locations']) && $appliedFilters['locations'] != '' && in_array($offerLocation['cityID'] ,$appliedFilters['locations'])){echo "checked";} ?>><label style="margin-left: 5px;"><?= $offerLocation['city'].', '.$offerLocation['state']?></label></div>
                    <?php }}}else{echo "Location Filter Not Applicable.";}?>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>College(s)</b>
                  <div style="margin-top: 10px;">
                     <?php if(!empty($colleges)){ foreach($colleges as $college){ if(isset($college['instituteID'])){?>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="colleges[]" value = "<?= $college['instituteID']?>" <?php if(isset($appliedFilters['colleges']) && $appliedFilters['colleges'] != '' && in_array($college['instituteID'] ,$appliedFilters['colleges'])){echo "checked";} ?>><label style="margin-left: 5px;"><?= $college['college']?></label></div>
                    <?php }}}else{ echo "College Filter Not Applicable.";} ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12 control-group form-group">
                <div class="controls">
                  <b>Courses</b>
                  <div style="margin-top: 10px;">
                    <?php if(!empty($courses)){ foreach($courses as $course){ if(isset($course['courseID'])){?>
                    <div class="col-sm-12" style="font-size: 14px;"><input type="checkbox" name="courses[]" value = "<?= $course['courseID']?>" <?php if(isset($appliedFilters['courses']) && $appliedFilters['courses'] != '' && in_array($course['courseID'] ,$appliedFilters['courses'])){echo "checked";} ?>><label style="margin-left: 5px;"><?= $course['course']?></label></div>
                    <?php }}}else{ echo "Course Filter Not Applicable.";} ?>
                  </div>
                </div>
              </div>

              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Apply</button>
          </div>
        </form>
        </div>
      </div>
    </div>


    <div class="card containerWrap" style = "display:none">
                <h6 class="card-header cardheader"><span class = "title"></span><br><br><a href = "" id = "profileLink"><label style="font-size: 14px;">View Profile</label></a></h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <p class="card-text" style="font-size: 14px;"><b>Skills: </b><br>
                        <ul style="font-size: 14px;" class = "skillList">

                         <!--<sup style="color: red;">Premium</sup>  -->
                        </ul>
                      </p>
                    </div>
                    <div class="col-md-6 mb-4">
                      <p class="card-text"><b>Status: </b><label class = "status"></label></p>
                      <p class="card-text"><b>Gender: </b><label class = "gender"></label></p>
                      <p class="card-text"><b>Location: </b><label class = "location"></label></p>
                    </div>
                    <div class="col-md-12 mb-4">
                      <p class="card-text"><b>E-Mail Address: </b><label class = "email"></label></p>
                      <p class="card-text"><b>Mobile Number: </b><label class = "mobile"></label></p>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <small>
                    <a class="btn btn-primary addToCompare" style="color: white; margin: 10px;">Compare Applicant</a>
                    <br><a href="<?= base_url('hiring-nucleus/compare-applicants')?>" style="float: right; margin-right: 2% ">Access Compare Applicants</a>
                  </small>
                  <small class="text-muted buttonContainer" style="float: right;">
                    <a class="btn btn-success selectCandidate" style="color: white; margin: 10px;">Select Applicant</a>
                    <a class="btn btn-warning shortlistCandidate" style="color: white; margin: 10px;">Short-List Applicant</a>
                    <a class="btn btn-danger rejectCandidate" style="color: white; margin: 10px;">Reject Applicant</a>
                  </small>
                </div>
              </div>


              <a class="btn btn-success selectClone" style="color: white; margin: 10px;display: none">Select Applicant</a>
              <a class="btn btn-warning shortlistClone" style="color: white; margin: 10px;display: none">Short-list Applicant</a>
              <a class="btn btn-danger rejectClone" style="color: white; margin: 10px;display: none">Reject Applicant</a>
              <a class="btn btn-primary addToClone" style="color: white; margin: 10px;display: none">Compare Applicant</a>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remarks</h4>
      </div>
      <div class="modal-body">
          <label><b>Select Remark:</b></label>
        <select class="form-control remark" name = "remark">
          <option value = "1">Skill Requirement(s) Not Met.</option>
          <option value = "2">Educational Requirement(s) Not Met.</option>
          <option value = "3">Work Experience Requirement(s) not met.</option>
          <option value = "4">Other</option>
        </select>
        <br>
      <div class = "otherRemark" style ="display:none">
        <label><b>Add Other Remark:</b></label>
        <textarea class = "form-control other" name = "other" placeholder="Remark.."></textarea>
      </div>
        <div class="candidateData"></div><br>
        <button  class = "form-control btn btn-primary addRemark">Add Remark</button>

      </div>
    </div>

  </div>
</div>

  </body>

  <script type="text/javascript">
  var page = 1;
  var slug = '<?= $offer?>';
  var compare = '<?= json_encode($_SESSION['compare'])?>'
  compare = JSON.parse(compare)
    $(document).ready(function(){
      $('#loadMore'). click(function(){
        page++;
        url = '<?= base_url('functions/loadMoreApplicants')?>';
        data = {
                  slug : slug,
                  page : page
                };
        $.get(url,data).done(function(res){
          console.log(res);
          res = JSON.parse(res);
          data = res.data
          more = res.more
          res = data
          if(res != false){
            for(var i = 0; i < res.length; i++){
              var container = $('.containerWrap').clone()
              container.attr('id', 'candidate'+res[i].userID)
              container.removeClass('candidateWrap');
              container.find('.title').html(res[i].name);
              container.find('.title').attr('id', 'title'+res[i].userID)
              container.find('.location').html(res[i].city+' '+res[i].state)
              if(res[i].status == 2){
                container.find('.email').html(res[i].email).attr('id', 'email'+res[i].userID)
                container.find('.mobile').html(res[i].mobile).attr('id', 'mobile'+res[i].userID)
              }else{
                container.find('.email').html('<i>Select Candidate to view E-Mail Address</i>').attr('id', 'email'+res[i].userID)
                container.find('.mobile').html('<i>Select Candidate to view Mobile Number</i>').attr('id', 'mobile'+res[i].userID)
              }
              if(res[i].gender == 'M'){
                container.find('.gender').html('Male');
              }else if(res[i].gender == 'F'){
                container.find('.gender').html('Female');
              }else{
                container.find('.gender').html('Gender Not Found.');
              }
              container.find('.status').attr('id', 'status'+res[i].userID)
              if(res[i].status == 1){
                container.find('.status').html('<b>Applied</b>');
              }else if(res[i].status == 2){
                container.find('.status').html('<b>Selected</b>').css('color', 'green');
              }else if(res[i].status == 3){
                container.find('.status').html('<b>Shortlisted</b>').css('color', 'yellow');
              }else{
                container.find('.status').html('<b>Rejected</b>').css('color', 'red');
              }
              if(res[i].skillName == null){
                 container.find('.skillList').html('No Skills Found')
              }else{
                var skillName = (res[i].skillName).split(',')
                var skilltype = (res[i].type).split(',')
                var skillScore = (res[i].score).split(',')
                var k = 0;
                if(skilltype[0] == 2 && skillScore[0] >=10){
                  var skill = '<li>'+ skillName[0] +'</li><sup style="color: red;">Premium</sup>';
                  k++;
                }
                if(skilltype[0] == 1){
                  var skill = '<li>'+ skillName[0] +'</li>';
                  k++;
                }

                for(var j = 1; j < skillName.length; j++){
                   if(skilltype[j] == 2 && skillScore[j] >=10){
                  var skill = '<li>'+ skillName[j] +'</li><sup style="color: red;">Premium</sup>';
                  k++;
                }
                if(skilltype[j] == 1){
                  var skill = '<li>'+ skillName[j] +'</li>';
                  k++;
                }
                }
                if(k = 0){
                  skill = "No Skill Found";
                }
                container.find('.skillList').html(skill)
              }
              container.find('.buttonContainer').addClass('buttonContainer'+res[i].userID).removeClass('buttonContainer')
              container.find('.shortlistCandidate').attr({id:'shortlistCandidate'+res[i].userID, data:res[i].userID})
              container.find('.selectCandidate').attr({id:'selectCandidate'+res[i].userID, data:res[i].userID})
              container.find('.rejectCandidate').attr({id:'rejectCandidate'+res[i].userID, data:res[i].userID})
              container.find('.addToCompare').attr({id:'addToCompare'+res[i].userID, data:res[i].userID})
              x = compare.indexOf(res[i].userID)
              if(x != -1){
                container.find('.addToCompare').attr('id' , 'removeFromCompare'+res[i].userID).html('Remove From Compare')
                container.find('.addToCompare').addClass('removeFromCompare')
                container.find('removeFromCompare').removeClass('addToCompare')
              }

              if(res[i].status == 2){
                container.find('.shortlistCandidate').remove();
                container.find('.selectCandidate').html('Selected').removeClass('selectCandidate').attr('id','');
                container.find('.rejectCandidate').remove();
                container.find('.addToCompare').remove();
              }
              if(res[i].status == 4){
                container.find('.shortlistCandidate').remove();
                container.find('.selectCandidate').remove();
                container.find('.rejectCandidate').html('Rejected').removeClass('rejectCandidate');
                container.find('.addToCompare').remove();
              }
              if(res[i].status == 3){
                  container.find('.shortlistCandidate').html('Shortlisted').removeClass('shortlistCandidate');
              }
              $('#candidateList').append(container[0]);
              container.show()
            }
          }
          if(more == false){
            $('#loadMore').hide();
          }
        })
      })
    })

</script>
<script type="text/javascript">

  $(document).ready(function(){
    $('body').on('click', '.shortlistCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/shortlist')?>';
      postData = {
        data: data,
        offer: '<?= $offer?>'
      }

      $.get(url,postData).done(function(res){
        console.log(res)
         res = JSON.parse(res);
        candidateDetail = res.data[0];
        if(res.res == 'true'){
          $('#status'+data).html('<b style = "color:yellow">Shortlisted</b>')
          $('#email'+data).html(candidateDetail.email)
          $('#mobile'+data).html(candidateDetail.mobile)
          $('#shortlistCandidate'+data).remove();
          // $('#shortlistCandidate'+data).html('Shortlisted').removeClass('shortlistCandidate')
          alert($('#title'+data).html()+' has been successfully shortlisted for the Offer: '+'<?= $offerTitle?>');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('change', '.remark', function(){
      data = $('.remark').val()
      console.log(data);
      if(data == 4){
        $('.otherRemark').show();
      }else{
        $('.otherRemark').hide();
      }
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.selectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/select')?>';
      postData = {
        data: data,
        offer: '<?= $offer?>'
      }
      $.get(url,postData).done(function(res){
        res = JSON.parse(res);
        candidateDetail = res.data[0];
        if(res.res == 'true'){
           $('#status'+data).html('<b style = "color:green">Selected</b>')
          $('#email'+data).html(candidateDetail.email)
          $('#mobile'+data).html(candidateDetail.mobile)
          $('#selectCandidate'+data).remove();
          // $('#selectCandidate'+data).html('Selected').removeClass('selectCandidate').attr('id','');
          $('#shortlistCandidate'+data).remove();
          // $('#rejectCandidate'+data).remove();
          // $('#addToCompare'+data).remove();
          alert($('#title'+data).html()+' has been successfully selected for the Offer: '+'<?= $offerTitle?>');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.rejectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      $('.candidateData').html('<input type="hidden" class = "candidateID" name = "candidateData" value = "'+data+'">')
      $('#myModal').modal({backdrop: 'static', keyboard: false})
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.addRemark', function(){
      data = $('.candidateID').val()
      value = $('.remark').val()
      if(value == 4){
      }else{
        remark = '';
      }
      console.log(remark)
      url = '<?=base_url('functions/reject')?>'
      postData = {
        data: data,
        value:value,
        remark:remark,
        offer: '<?= $offer?>'
      }
      $.get(url,postData).done(function(res){
        if(res == 'true'){
          $('#status'+data).html('<b style = "color:red">Rejected</b>')
          $('#rejectCandidate'+data).remove();
          $('#selectCandidate'+data).remove();
          $('#shortlistCandidate'+data).remove();
          alert($('#title'+data).html()+' has been successfully rejected for the Offer: '+'<?= $offerTitle?>');
          $('#myModal').modal('hide')
          $('.candidateData').empty()
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.addToCompare', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/addToCompare')?>'
      postData = {
        data: data,
        offer: '<?= $offer?>'
      }
      $.get(url,postData).done(function(res){
        console.log(res);
        if(res == 'true'){
          $('#'+id).addClass('removeFromCompare');
          $('#'+id).removeClass('addToCompare')
          $('#'+id).attr('id', 'removeFromCompare'+data)
          $('#removeFromCompare'+data).html('Remove From Compare')
          if(compare[0] == null){
            compare[0] = data
          }else{
            compare[1] = data
          }
          alert($('#title'+data).html()+' has been successfully added for Candidate Compare for the Offer: '+'<?= $offerTitle?>');
        }
        if(res == 'false'){

          alert('You can only add a Maximum of Two Candidates to Compare.');
        }
        if(res == 'false1'){
          alert($('#title'+data).html()+' has already been added for Candidate Compare for the Offer: '+'<?= $offerTitle?>');
        }
        if(res == 'false2'){
          alert('Something went wrong. Please Try Again.')
          location.reload()
        }
      })
    })
  })


  $(document).ready(function(){
    $('body').on('click', '.removeFromCompare', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = '<?=base_url('functions/RemoveFromCompare')?>'
      postData = {
        data: data,
        offer: '<?= $offer?>'
      }
      $.get(url,postData).done(function(res){
        console.log(res);
        if(res == 'true'){
          $('#'+id).addClass('addToCompare')
          $('#'+id).removeClass('removeFromCompare');
          $('#'+id).attr('id', 'addToCompare'+data)
          $('#addToCompare'+data).html('Compare Applicant')
          if(compare[0] == data){
            compare[0] = null
          }else{
            compare[1] = null
          }
          alert($('#title'+data).html()+' has been successfully Removed from Candidate Compare for the Offer: '+'<?= $offerTitle?>');
        }
        if(res == 'false'){
          alert('No candidate Added To compare.');
        }
        if(res == 'false1'){
          alert('This candidate has not been added to Compare.');
        }
        if(res == 'false2'){
          alert('Something went wrong. Please Try Again.')
          location.reload()
        }
      })
    })
  })

</script>

</html>
