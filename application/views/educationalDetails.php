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


              <?php if(!empty($educations)){
                foreach($educations as $education){?>
              <div class="col-lg-12 mb-4">
              <div class="card">
                <h6 class="card-header"><b><?php if($education['educationType'] == 1){echo "High School";}elseif($education['educationType'] == 2){echo "Senior Secondary";}elseif($education['educationType'] == 3){echo "Graduation";}else{echo "Post Post-Graduation";}?></b> <?php if
                  ($education['status'] == 2){?><i class="fa fa-check-circle"></i><?php } ?></h6>
                <div class="card-body">
                  <p class="card-text"><b>Year: </b><?= $education['year']?></p>
                  <p class="card-text"><b>Score: </b><?=$education['score']?> <?php if($education['scoreType'] == 1){echo "CGPA";}else{echo "%";}?></p>
                  <?php if($education['educationType'] == 1 || $education['educationType'] == 2){?>
                    <p class="card-text"><b>School/Board/College/University: </b><?= $education['institute']?></p>
                  <?php } ?>
                  <?php if($education['educationType'] == 3 || $education['educationType'] == 4){?>
                    <p class="card-text"><b>School/Board/College/University: </b><?= $education['college']?></p>
                  <?php } ?>
                </div>
                <div class="card-footer">
                  <a href="<?= base_url('functions/deleteEducationalDetail?id='.$education['educationID'])?>" class="btn btn-danger delete deleteEducation" data = "$education['educationID']" style="float: right; margin: 5px;"><i class="fa fa-trash"></i></a>
                  <button class="btn btn-success editWorkEx"  data = '<?= json_encode($education);?>' style="float: right; margin: 5px;"><i class="fa fa-pencil"></i></button>
                </div>
              </div>
              </div>
              <?php }}else{
                echo "No Educational Details Added.";
              } ?>

              <div class="col-lg-12 mb-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" style="float: right;" data-target="#education">
                Add Education
              </button>
              </div>

              <div class="modal fade" id="education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method = "POST" action = "<?= base_url('functions/addEducation');?>" enctype ="multipart/form-data">
                    <div class="modal-body">

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Education Type:</label>
                            <select class="form-control" name="type" id ="type" required>
                              <option value="1">High School</option>
                              <option value="2">Senior Seconday (or equivalent) School</option>
                              <option value="3">Graduation</option>
                                <option value="4">Post-Graduation</option>
                              </select>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Year:</label>
                            <select class="form-control" name="year" id = "year" required>
                              <?php for($i=2025; $i>1960; $i--){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Score Type:</label>
                            <select class="form-control" name="scoreType" id = "scoreType" required>
                              <option value = "1">CGPA</option>
                              <option value = "2">Percentage</option>
                            </select>
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Score:</label>
                            <input class="form-control" placeholder="Score" id = "score" name = "score">
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group">
                          <div class="controls">
                            <label>Supporting Document:</label>
                            <input type="file" class="form-control" name = "file" id ="file" placeholder="Score">
                            <p class="help-block" style="color: red; font-size: 13px;">Upload your Board Certificate/University Degree, to verify the Educational Record.</p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group schoolData">
                          <div class="controls">
                            <label>School/Education Board:</label>
                            <input type="text" class="form-control" name = "board" id = "board" placeholder="School/Education Board">
                            <p class="help-block"></p>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group colleges" style = "display: none;">
                          <div class="controls">
                            <label>Colleges:</label>
                            <select class="form-control" name="college" id ="college" >
                               <option value=""></option>
                              <?php foreach($colleges as $college){?>
                                <option value="<?= $college['college_id']?>"><?= $college['college']?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12 control-group form-group other" style = "display: none;">
                          <div class="controls">
                            <input type="checkbox" name="other" id = "other" value="1">
                            <label> College Not Listed</label>
                          </div>
                        </div>
                        <div class="col-md-12 control-group form-group newCollege" style = "display: none;">
                          <div class="controls">
                            <input type="text" class="form-control" name = "newCollege" id = "newCollege" placeholder="College">
                          </div>
                        </div>


                        <div class="col-md-12 control-group form-group courses" id = "courseBach" style = "display: none;">
                          <div class="controls">
                            <label>Courses:</label>
                            <select class="form-control" name="courseBach" id ="coursesBach" >
                              <option value=""></option>
                              <?php foreach($courses as $course){if($course['courseType'] == 3){?>
                                <option value="<?= $course['course_id']?>"><?= $course['course']?></option>
                              <?php } } ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-12 control-group form-group courses" id = "courseMast" style = "display: none;">
                          <div class="controls">
                            <label>Courses:</label>
                            <select class="form-control" name="courseMast" id ="coursesMast" >
                              <option value=""></option>
                              <?php foreach($courses as $course){if($course['courseType'] == 4){?>
                                <option value="<?= $course['course_id']?>"><?= $course['course']?></option>
                              <?php } } ?>
                            </select>
                          </div>
                        </div>


                        <div class = "hiddenInput">

                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_token; ?>">
                      <button type="submit" class="btn btn-primary submitButton">Add Education</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>





            </div>


        </div>
      </div>

    </div>

    <?php echo $footer; ?>
    <?php echo $footerFiles; ?>

    <script>
    $(document).on('click','.delete',function(event){
      if (!confirm("Are you sure you want to delete this educational profile?")) {
        event.preventDefault();
      }
    });
  </script>

    <script type="text/javascript">

      // var colleges = JSON.parse('<?= json_encode($colleges)?>')
      var value = null;
      // console.log(colleges);
        $(document).ready(function(){
          $('.editWorkEx').on('click', function(res){
            data = $(this).attr('data');
            console.log(data)
            data = JSON.parse(data);
            console.log(data);
            $('#type').val(data.educationType)
            $('#year').val(data.year)
            if(data.educationType == 1 || data.educationType == 2){
              $('#board').val(data.institute)
            }
            if(data.educationType == 3 || data.educationType == 4){
              $('.colleges').show();
              $('.other').show();
              $('#college').val(data.instituteID);
              $('#board').hide();
              if(data.educationType == 3){
                $('#courseBach').show();
                $('#coursesBach').val(data.courseID)
              }
              if(data.educationType == 4){
                $('#courseMast').show();
                $('#coursesMast').val(data.courseID)
              }
            }
            $('#scoreType').val(data.scoreType)
            $('#score').val(data.score)
            $('.submitButton').html("Edit Education")
            $('.hiddenInput').append('<input type="hidden" name ="edit" value = "1"><input type = "hidden" name ="id" value = "'+data.educationID+'">')
            $('#education').modal('show');
          })

          $('#type').on('change', function(){
            value = $(this).val();
            if(value == 3 || value == 4){
              $('.other').show();
              $('.colleges').show();
              $('.schoolData').hide();
              if(value == 3){
                $('#courseMast').hide();
                $('#courseBach').show();
              }
              if(value == 4){
                  $('#courseBach').hide();
                  $('#courseMast').show();
              }

            }else if(value == 1 || value == 2){
              $('.other').hide();
              $('.colleges').hide();
              $('.courses').hide();
              $('.schoolData').show();
            }
          })
         $('#other').on('change', function(){
            if(value != 1)
              value = $(this).val()
            else
              value = '';
            console.log(value)
            if(value != 1){
              $('.colleges').show();
              $('.newCollege').hide();
            }else{
              $('.colleges').hide();
              $('.newCollege').show();
             }
          });
        });
      </script>

      <script type="text/javascript">
         $('#education').on('hidden.bs.modal', function () {
          $('.hiddenInput').empty()
          $('.submitButton').html("Add Education")
          $(this).find('form').trigger('reset');
        })
      </script>

  </body>

</html>
