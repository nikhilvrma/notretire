<html>

<head>
  <title><?= $generalData['name']?></title>

  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/backoffice.css'); ?>" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

   <div class="container" style="margin-top: 10px;">



     <div class="row">



       <div class="col-lg-12 mb-4">

         <h4 class="mt-4 mb-3" style="float: right;"><b>Job/Internship Application and Assessment Report</b></h4>

         <p class="mt-4 mb-3" style="float: right; font-size: 14px;"></p>
         <div class="clearfix"></div>

         <div style="background: black; color: white; padding: 10px; height: 40px;">
           <p><b><?= $generalData['name']?></b></p>
         </div>
         <br>
         <p style="font-size: 15px;"><b>E-Mail Address:</b> <?=$generalData['email']?><br><b>Mobile Number:</b> +91-<?=$generalData['mobile']?><br><b>Location:</b> <?= $generalData['city']?>, <?=$generalData['state']?></p>

         <hr>

         <div class="table-responsive">
         <b>Educational Details</b>
          <?php if(!empty($educationalDetails)){?>
             <table class="table" style="width: 100%; margin-top: 20px; font-size: 15px;">
               <thead>
                 <tr>
                   <th>Educational Category</th>
                   <th>School/Board/College/University</th>
                   <th>Year</th>
                   <th>Score</th>
                 </tr>
               </thead>
               <tbody>
                <?php foreach ($educationalDetails as $key => $education) {?>
                 <tr>
                   <td><b><?php if($education['educationType'] == 1){echo "High School";}elseif($education['educationType'] == 2){echo "Senior Secondary";}elseif($education['educationType'] == 3){echo "Graduation";}else{echo "Post-Graduation";}?></b> <?php if($education['status'] == 2){?><i class="fa fa-check-circle"></i><?php } ?></td>
                    <?php if($education['educationType'] == 1 || $education['educationType'] == 2){?>
                     <td><?= $education['institute']?></td>
                    <?php } ?>
                    <?php if($education['educationType'] == 3 || $education['educationType'] == 4){?>
                    <td><?= $education['college']?></td>
                    <?php } ?>
                   <td><?= $education['year']?></td>
                   <td><?= $education['score']?> <?php if($education['scoreType'] == 1){echo "CGPA";}else{echo "%";}?></td>
                 </tr>
                 <?php } ?>
               </tbody>
             </table>
             <?php }else{
              echo "<center><b>No Education Found.</b></center>";
             } ?>
          </div>

          <hr>

          <b>Skills</b>
          <?php if(!empty($skills)){?>
          <ul style="font-size: 15px; margin-top: 15px;">
            <?php foreach($skills as $skill){if($skill['score'] > 10){?>
            <li><?= $skill['skill_name'] ?> <?php if($skill['type'] == 2){?><i class="fa fa-check-circle"></i><?php }?></li>
            <?php } }?>
          </ul>
          <?php }else{ echo "<center><b>No Skill Found.</b></center>";} ?>

          <hr>

          <b>Work-Experience</b>
          <ul style="font-size: 15px; margin-top: 15px;">
            <?php if(!empty($workExperience)){?>
            <?php foreach ($workExperience as $key => $experience) { ?>
              <li><b><?= $experience['companyName']?></b><br><?= $experience['position'] ?><br><?= $experience['startMonth']?> <?= $experience['startYear']?> - <?php if($experience['currentlyWorking'] == 1){echo "Present";}else{?><?= $experience['endMonth']?> <?= $experience['endYear']?><?php } ?><br><br><b>Role: </b><?= $experience['role']?></li>
            <?php }}else{ echo "<center><b>No Work-Experience Found.</b></center>";}?>
          </ul>

          <hr>
          <div class="table-responsive">
          <b>Skill Assessment</b>

          <?php if(!empty($premiumSkills)){
                    $i = 1;?>
              <table class="table" style="width: 100%; margin-top: 20px; font-size: 15px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="width: 15%;">Skill</th>
                    <th>Score</th>
                    <th>Score-Analysis</th>
                    <th>Current Standing</th>
                  </tr>
                </thead>
                <tbody>

                    <?php foreach($premiumSkills as $premiumSkill){?>
                  <tr>
                    <td><?= $i?>.</td>
                    <td><?=$premiumSkill['skill_name']?></td>
                    <td><?= $premiumSkill['score']?></td>
                    <td>
                      <table class="table" style="font-size: 14px;">
                        <tr>
                          <td><b>Number of Attempt(s)</b></td>
                          <td><?= $skillResponse[$premiumSkill['skillID']]['responses']?></td>
                        </tr>
                        <tr>
                          <td><b>Correct Attempt(s)</b></td>
                          <td><?= $skillCorrect[$premiumSkill['skillID']]['responses']?></td>
                        </tr>
                        <tr>
                          <td><b>Wrong Attempt(s)</b></td>
                          <td><?= $skillIncorrect[$premiumSkill['skillID']]['responses']?></td>
                        </tr>
                        <tr>
                          <td><b>Skip(s)</b></td>
                          <td><?= $skillResponse[$premiumSkill['skillID']]['responses'] - $skillIncorrect[$premiumSkill['skillID']]['responses'] - $skillCorrect[$premiumSkill['skillID']]['responses']?></td>
                        </tr>
                      </table>
                    </td>
                    <td>
                      <div class="progress">
                        <?php $percent = round($premiumSkill['score']/$skillMax[$premiumSkill['skillID']]['max']*100);?>
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percent?>%;" aria-valuenow="<?= $percent?>" aria-valuemin="0" aria-valuemax="100"><?= $percent?>%</div>
                      </div>
                    </td>
                  </tr>
                  <?php $i++;} ?>
                </tbody>
              </table>
              <?php }else{
                echo "<center><b>No Skill Found.</b></center>";
              } ?>
           </div>



          <hr>
          <!-- <div class="table-responsive">
          <b>Behavioural Assessment</b>

              <table class="table" style="width: 100%; margin-top: 20px; font-size: 15px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th style="width: 15%;">Attribute</th>
                    <th style="width: 20%;">Score</th>
                    <th style="width: 60%;">Remark</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Team-Work</td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%; color: black;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">35%</div>
                      </div>
                    </td>
                    <td><p>You are the one who has active participation in, and facilitation of, team effectiveness; You are the one taking actions that demonstrate consideration for the feelings and needs of others; being aware of the effect of one&#39;s behaviors on others.<br />
You make sure that there is active cooperation by every member is vital to team success. Your ideology is that the team members cannot sit back and observe or allow others to do the work; they must work proactively to achieve group goals and facilitate cohesiveness. You believe that, effective teams are not just collections of people. Rather, they are an entity that is greater than the sum of its parts.&nbsp;</p></td>
                  </tr>

                  <tr>
                    <td>2.</td>
                    <td>Leadership</td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </td>
                    <td><p>You are the one who readily makes decisions, render judgements, take actions or commit oneself. In addition to analysing problems, you often reach a conclusion, make a recommendation or take action. With available information, you make decisions on time and take action without waiting for more information or guidance. Decisiveness deals with the number of decisions made and the time it takes to reach conclusions. The quality of your decision or conclusion is covered by judgement and independent variable.&nbsp;</p></td>
                  </tr>

                  <tr>
                    <td>3.</td>
                    <td>Risk Taking</td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 18%;" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">18%</div>
                      </div>
                    </td>
                    <td><p>You understand the impact and implications of decisions on the community and other departments. Hence, you do not take decisions for the community<br />
which involves taking chances or risking interest of any department. You are fully aware of how the decisions and actions of one department affect the rest of the organization but you do not take risks in making decisions or requests for resources. This dimension is a subset of judgment. Although you are aware of &nbsp;the needs of the community as well as the needs, expectations or viewpoints of others but when it comes to taking risk in certain decisions you avoid it.&nbsp;</p>
</td>
                  </tr>

                </tbody>
              </table>
           </div> -->

       </div>
     </div>
     <p style="float: right; font-size: 12px;"><b>Note: </b><i class="fa fa-check-circle"></i> indicates a verified skill or a detail, verified by CampusPuppy. Details without <i class="fa fa-check-circle"></i> are claimed by the user and not verified by CampusPuppy</p>
     <div class="clearfix"></div>
     <div style="background: black; color: white; padding: 10px; height: 35px;">
       <center><p style="font-size: 12px;">Application and Assessment Report generated by <b>CampusPuppy</b> as, on <i><?php date_default_timezone_set('Asia/Kolkata');
echo date('d-F-Y h:i A');?></i></p></center>
     </div>

   </div>



   <script src="http://localhost.hn/assets/vendor/jquery/jquery.min.js"></script>
<script src="http://localhost.hn/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
