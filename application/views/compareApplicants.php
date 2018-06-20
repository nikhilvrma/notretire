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

          <ol class="breadcrumb" style="margin-top: 30px;">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('general-details'); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('my-added-offers'); ?>">My Added Offers</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('my-added-offers'); ?>">Applicants</a>
          </li>
          <li class="breadcrumb-item active">Compare Applicants</li>
        </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <p>Comparing Applicants for the Offer: <b><?= $offerTitle?></b></p>
          <hr>
          <?php if(!empty($candidates['skills'][0])){foreach($candidates['skills'][0] as $key => $value){
            $skills[0][$value['skillID']]['skillID'] = $value['skillID'];
            $skills[0][$value['skillID']]['skillName'] = $value['skill_name'];
            $skills[0][$value['skillID']]['type'] = $value['type'];
            $skills[0][$value['skillID']]['score'] = $value['score'];
          }}else{$skills[0] = array();}?>
          <?php if(!empty($candidates['skills'][1])){foreach($candidates['skills'][1] as $key => $value){
            $skills[1][$value['skillID']]['skillID'] = $value['skillID'];
            $skills[1][$value['skillID']]['skillName'] = $value['skill_name'];
            $skills[1][$value['skillID']]['type'] = $value['type'];
            $skills[1][$value['skillID']]['score'] = $value['score'];
          }}else{$skills[1] = array();}?>
          <div class="row">

            <div class="col-md-12 mb-4">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="width: 25%;">Name</th>
                    <?php if(isset($candidates['userDetails'][0])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 25%;" class = "title" id = "title<?= $candidates['userDetails'][0][0]['userID']?>"><?= $candidates['userDetails'][0][0]['name']?></th>
                    <?php }else{}if(isset($candidates['userDetails'][1])){?>
                    <th scope="col" style="background: #2c3e50; color: white; width: 25%;" class = "title" id = "title<?= $candidates['userDetails'][1][0]['userID']?>"><?= $candidates['userDetails'][1][0]['name']?></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Gender</th>
                    <?php if(isset($candidates['userDetails'][0])){if($candidates['userDetails'][0][0]['gender'] == 'M'){echo "<td>Male</td>";}else{echo "<td>Female</td>";}}?>
                    <?php if(isset($candidates['userDetails'][0])){if($candidates['userDetails'][1][0]['gender'] == 'M'){echo "<td>Male</td>";}else{echo "<td>Female</td>";}}?>
                  </tr>

                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">High-School</label></th>

                    <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){ $yes = 0;
                      foreach($candidates['educationalDetails'][0] as $educate){
                        if($educate['educationType'] == 1){
                          $yes = 1;?>
                    <td><p style="font-size: 14px;"><?= $educate['institute']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>

                    <?php }
                          }
                          if($yes != 1){
                      echo "<td>Not Found.</td>";
                    }
                     }else{echo "<td>Not Found.</td>";}?>


                    <?php if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ $yes = 0;
                      foreach($candidates['educationalDetails'][1] as $educate){
                        if($educate['educationType'] == 1){ $yes = 1;?>

                    <td><p style="font-size: 14px;"><?= $educate['institute']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>
                    <?php }} if($yes != 1){echo "<td>Not Found.</td>";}
                     }else{echo "<td>Not Found.</td>";}?>
                  </tr>

                   <tr>
                    <th scope="row">Education:<br><label style="float: right;">Secondary School</label></th>

                     <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){ $yes = 0;
                      foreach($candidates['educationalDetails'][0] as $educate){
                        if($educate['educationType'] == 2){
                          $yes = 1;?>
                    <td><p style="font-size: 14px;"><?= $educate['institute']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>

                    <?php }
                          }
                          if($yes != 1){
                      echo "<td>Not Found.</td>";
                    }
                     }else{echo "<td>Not Found.</td>";}?>


                    <?php if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ $yes = 0;
                      foreach($candidates['educationalDetails'][1] as $educate){
                        if($educate['educationType'] == 2){ $yes = 1;?>

                    <td><p style="font-size: 14px;"><?= $educate['institute']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>
                    <?php }} if($yes != 1){echo "<td>Not Found.</td>";}
                     }else{echo "<td>Not Found.</td>";}?>
                  </tr>

                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">Graduation</label></th>

                     <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){ $yes = 0;
                      foreach($candidates['educationalDetails'][0] as $educate){
                        if($educate['educationType'] == 3){
                          $yes = 1;?>
                    <td><p style="font-size: 14px;"><?= $educate['college']?><br><b>Course: </b><?= $educate['course']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>

                    <?php }
                          }
                          if($yes != 1){
                      echo "<td>Not Found.</td>";
                    }
                     }else{echo "<td>Not Found.</td>";}?>


                    <?php if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ $yes = 0;
                      foreach($candidates['educationalDetails'][1] as $educate){
                        if($educate['educationType'] == 3){ $yes = 1;?>

                    <td><p style="font-size: 14px;"><?= $educate['college']?><br><b>Course: </b><?= $educate['course']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>
                    <?php }} if($yes != 1){echo "<td>Not Found.</td>";}
                     }else{echo "<td>Not Found.</td>";}?>
                  </tr>

                  <tr>
                    <th scope="row">Education:<br><label style="float: right;">Post-Graduation</label></th>

                     <?php if(isset($candidates['educationalDetails'][0]) && !empty($candidates['educationalDetails'][0])){ $yes = 0;
                      foreach($candidates['educationalDetails'][0] as $educate){
                        if($educate['educationType'] == 4){
                          $yes = 1;?>
                    <td><p style="font-size: 14px;"><?= $educate['college']?><br><b>Course: </b><?= $educate['course']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>

                    <?php }
                          }
                          if($yes != 1){
                      echo "<td>Not Found.</td>";
                    }
                     }else{echo "<td>Not Found.</td>";}?>


                    <?php if(isset($candidates['educationalDetails'][1]) && !empty($candidates['educationalDetails'][1])){ $yes = 0;
                      foreach($candidates['educationalDetails'][1] as $educate){
                        if($educate['educationType'] == 4){ $yes = 1;?>

                    <td><p style="font-size: 14px;"><?= $educate['college']?><br><b>Course: </b><?= $educate['course']?><br><b>Score: </b><?= $educate['score']?><?php if($educate['scoreType'] == 1){echo " CGPA";}else{echo '%';}?><br><b>Batch: </b><?= $educate['year']?></p></td>
                    <?php }} if($yes != 1){echo "<td>Not Found.</td>";}
                     }else{echo "<td>Not Found.</td>";}?>
                  </tr>

                  <?php if(!empty($allSkills)){
                    foreach($allSkills as $allSkill){ if(isset($allSkill['skillName']) && $allSkill['skillName'] != NULL){?>
                    <th scope="row">Skill:<br><label style="float: right;"><?php echo $allSkill['skillName'];?></label></th>

                    <td><?php
                            if(!empty($skills[0])){
                                if(isset($skills[0][$allSkill['skillID']])){
                                  echo $skills[0][$allSkill['skillID']]['score'];
                                }else{
                                  echo "Skill Not Found";
                                }
                              }else{
                                echo "Skill Not Found";
                              }
                            if(!empty($skills[0]) && isset($skills[0][$allSkill['skillID']])){
                              if($skills[0][$allSkill['skillID']]['type'] == 2){?>
                                <sup style="color: red;"><b>Premium</b></sup>
                        <?php }} ?>
                    </td>

                    <td><?php
                            if(!empty($skills[1])){
                              if(isset($skills[1][$allSkill['skillID']])){
                                echo $skills[1][$allSkill['skillID']]['score'];
                              }else{
                                echo "Skill Not Found";
                              }
                            }else{
                              echo "Skill Not Found";
                            }
                            if(!empty($skills[1]) && isset($skills[1][$allSkill['skillID']])){
                              if($skills[1][$allSkill['skillID']]['type'] == 2){?>
                                <sup style="color: red;"><b>Premium</b></sup>
                    <?php }}?>
                    </td>
                  </tr>
                <?php }}}else{?>
                  <tr>
                    <th scope="row">Skill:<br><label style="float: right;">NA</label></th>
                    <td>NA</td>
                    <td>NA</td>
                  </tr>
                <?php } ?>

                  <tr>
                    <th scope="row"></th>
                    <td>
                    <small class="text-muted buttonContainer<?= $candidates['userDetails'][0][0]['userID']?>" style="float: right;">
                      <?php if($candidates['status'][0] != '2' && $candidates['status'][0] != '4'){?>
                      <a class="btn btn-success selectCandidate" id = "selectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Select Applicant</a>
                    <?php }else if($candidates['status'][0] == '2') {?>
                      <a class="btn btn-success" style="color: white; margin: 10px;" id = "selectCandidate<?= $candidates['userDetails'][0][0]['userID']?>">Selected</a>
                    <?php }
                    ?>

                    <?php if($candidates['status'][0] != '3' && $candidates['status'][0] != '2'&& $candidates['status'][0] != '4'){?>
                      <a class="btn btn-warning shortlistCandidate" id = "shortlistCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Short-list Applicant</a>
                    <?php }else if($candidates['status'][0] == '3'){ ?>
                      <a class="btn btn-warning" id = 'shortlistCandidate<?= $candidates['userDetails'][0][0]['userID']?>' style="color: white; margin: 10px;" id = "shortlistCandidate<?= $candidates['userDetails'][0][0]['userID']?>">Shortlisted</a>
                    <?php } ?>

                    <?php if($candidates['status'][0] != '4'){?>
                      <a class="btn btn-danger rejectCandidate" id = "rejectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Reject Applicant</a>
                    <?php }else if($candidates['status'][0] == '4') { ?>
                      <a class="btn btn-danger" id = "rejectCandidate<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px;">Rejected</a>
                    <?php }?>

                   </small>
                    <a class="btn btn-primary removeFromCompare" id = "removeFromCompare<?= $candidates['userDetails'][0][0]['userID']?>" data = "<?= $candidates['userDetails'][0][0]['userID']?>" style="color: white; margin: 10px; float: right;">Remove From Compare</a>

                    </td>


                    <td>
                    <small class="text-muted buttonContainer<?= $candidates['userDetails'][1][0]['userID']?>" style="float: right;">
                     <?php if($candidates['status'][1] != '2' && $candidates['status'][1] != '4'){?>
                      <a class="btn btn-success selectCandidate" id = "selectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Select Applicant</a>
                    <?php }else if($candidates['status'][1] == '2') {?>
                      <a class="btn btn-success" style="color: white; margin: 10px;" id = "selectCandidate<?= $candidates['userDetails'][1][0]['userID']?>">Selected</a>
                    <?php }
                    ?>

                    <?php if($candidates['status'][1] != '3' && $candidates['status'][1] != '2'&& $candidates['status'][1] != '4'){?>
                      <a class="btn btn-warning shortlistCandidate" id = "shortlistCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Short-list Applicant</a>
                    <?php }else if($candidates['status'][1] == '3'){ ?>
                      <a class="btn btn-warning" id = 'shortlistCandidate<?= $candidates['userDetails'][1][0]['userID']?>' style="color: white; margin: 10px;" id = "shortlistCandidate<?= $candidates['userDetails'][1][0]['userID']?>">Shortlisted</a>
                    <?php } ?>

                    <?php if($candidates['status'][1] != '4'){?>
                      <a class="btn btn-danger rejectCandidate" id = "rejectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Reject Applicant</a>
                    <?php }else if($candidates['status'][1] == '4') { ?>
                      <a class="btn btn-danger" id = "rejectCandidate<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px;">Rejected</a>
                    <?php }?>

                    </small>
                    <a class="btn btn-primary removeFromCompare" id = "removeFromCompare<?= $candidates['userDetails'][1][0]['userID']?>" data = "<?= $candidates['userDetails'][1][0]['userID']?>" style="color: white; margin: 10px; float: right;">Remove From Compare</a>


                    </td>
                  </tr>
                </tbody>
              </table>

            </div>

          </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

    <script src="<?= base_url('assets/ckeditor/ckeditor.js')?>"></script>

    <a class="btn btn-success selectClone" style="color: white; margin: 10px;display: none">Select Applicant</a>
              <a class="btn btn-warning shortlistClone" style="color: white; margin: 10px;display: none">Short-list Applicant</a>
              <a class="btn btn-danger rejectClone" style="color: white; margin: 10px;display: none">Reject Applicant</a>
              <a class="btn btn-info removeFromClone" style="color: white; margin: 10px;display: none">Remove From Compare</a>

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
          // $('#shortlistCandidate'+data).remove();
          $('#shortlistCandidate'+data).html('Shortlisted').removeClass('shortlistCandidate')
          alert($('#title'+data).html()+' has been successfully shortlisted for the Offer: '+'<?= $offerTitle?>');
        }
      })
    })
  })

  $(document).ready(function(){
    $('body').on('click', '.selectCandidate', function(){
      id = $(this).attr('id')
      data = $('#'+id).attr('data')
      url = "<?= base_url('functions/select')?>"
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
          // $('#selectCandidate'+data).remove();
          $('#selectCandidate'+data).html('Selected').removeClass('selectCandidate');
          $('#shortlistCandidate'+data).remove();
          // $('#rejectCandidate'+data).remove();
          // $('#addToCompare'+data).remove();
          alert($('#title'+data).html()+' has been successfully selected for the Offer: '+'<?= $offerTitle?>');
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
          $('#rejectCandidate'+data).html('Rejected').removeClass('rejectCandidate');
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
          $('#addToCompare'+data).html('Add To Compare')
          alert($('#title'+data).html()+' has been successfully Removed from Candidate Compare for the Offer: '+'<?= $offerTitle?>');
          window.location.href = '<?= base_url('hiring-nucleus/applicants/'.$offer)?>';
        }
        if(res == 'false'){
          alert('No candidate Added To compare.');
        }
        if(res == 'false1'){
          alert('This candidate has not been added to Compare.');
        }
      })
    })
  })


</script>

</html>
