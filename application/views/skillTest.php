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



              <div class="col-lg-4 mb-4">
                  <div class="card h-100">
                    <h6 class="card-header cardheader">Skill Name</h6>

                    <div class="card-body">
                      <p class="card-text"><?= $skillData['skillName']?></p>
                    </div>


                  </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                      <h6 class="card-header cardheader">Remaining Test Time</h6>

                      <div class="card-body">
                        <p class="card-text" id = "timer"></p>
                      </div>


                    </div>
                  </div>

                  <div class="col-lg-4 mb-4">
                      <div class="card h-100">
                        <h6 class="card-header cardheader">Remaining Question Time</h6>

                        <div class="card-body">
                          <p class="card-text" id = "questionTimer"></p>
                        </div>


                      </div>
                    </div>


                  <div class="col-lg-12 md-4">
                    <p class="mcq" style="float: right;"><a style="font-size: 16px;" class = "skipQuestion">Skip Question (<b>Skips Left: </b><span id = "skipsLeft"><?= $skips?></span>)</a></p>
                    <p class="mcq"><strong>Question</strong></p>
                    <div class="mcq" id = "question"><?= $questionData[0]['question']?></div>
                                <div class="options">
                      <div class = 'option'>
                        <span class="opt">A</span>
                        <input type="radio" name="answer" id="optionA" value="1" />
                        <label for="optionA" id = 'option1'><?= $questionData[0]['option1']?></label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">B</span>
                        <input type="radio" name="answer" id="optionB" value="2" />
                        <label for="optionB" id = 'option2'><?= $questionData[0]['option2']?></label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">C</span>
                        <input type="radio" name="answer" id="optionC" value="3" />
                        <label for="optionC" id = 'option3'><?= $questionData[0]['option3']?></label>
                      </div>
                      <div class = 'option'>
                        <span class="opt">D</span>
                        <input type="radio" name="answer" id="optionD" value="4" />
                        <label for="optionD" id = 'option4'><?= $questionData[0]['option4']?></label>
                      </div>
                    </div>

                    <center>
                                  <button id="reset" class="btn btn-primary" style="margin-top: 10px;">RESET</button>
                                  <button class="btn btn-primary submitAns" style="margin-top: 10px;">SUBMIT</button>
                                  <br><hr>
                                  <button class="btn btn-primary finishTest" style="margin-top: 10px;">FINISH TEST</button>
                              </center>
                              
                  </div>

            </div>

        </div>
      </div>

    </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>


    <script type="text/javascript">
    var timePassed= 0;

var totalTime = <?php echo $totalTime; ?>;
// var totalTime = 90;
var questionTime = <?= 2*$questionData[0]['expert_time']?>;
var interval = null;
(function ( $ ) {
    $.fn.svgTimer = function(options) {

        return this.each(function() {
          var qtime = questionTime,r=document.getElementById('questionTimer'),temp=qtime;
            interval = setInterval(function () {
                var tt = temp--,hr = (tt/3600)>>0,min=((tt-hr*3600)/60)>>0,sec=(tt-min*60-hr*3600)+'';
                if(min>0){
                    questionTimer.textContent= min+' : '+(sec.length>1?'':'0')+sec
                }else{
                    questionTimer.textContent= (sec.length>1?'':'0')+sec
                }
                if (tt<1) {
                    submitAnswers('0',--questionTime,tmp);
                }

            },1000);

        });
    };


}(jQuery));

$(function () {
  $('#questionTimer').svgTimer();
});

var time = totalTime,r=document.getElementById('timer'),tmp=time;
setInterval(function () {
    var c = tmp--,h = (c/3600)>>0,m=((c-h*3600)/60)>>0,s=(c-m*60-h*3600)+'';
    if(h>0){
        timer.textContent= h+' : '+m+' : '+(s.length>1?'':'0')+s
    }else{
        timer.textContent= m+' : '+(s.length>1?'':'0')+s
    }
    if (c<1) {
        finishTest();
    }

},1000);



var ans = 0;
var selected = null;
$('.option').on('click', function(){
    selected = $(this).find("input[name = answer]").attr('id');
    ans = $("#"+selected).val();
});
$('.skipQuestion').on('click', function(){
    data = {answer: '0', timeConsumed: totalTime-tmp, totalTime:tmp};
   $.get('<?= base_url('skill_functions/skipQuestion')?>', data).done(function(res){
        res = JSON.parse(res);
        console.log(res);
        if(res.skips!=false)
            populate(res);
        else{
            populate(res);
            $('.skipQuestion').hide();
        }
   })
});

$('#reset').on('click', function() {
   $('input[type=radio]').prop('checked', function () {
       return this.getAttribute('checked') == 'checked';
   });
})

$('.submitAns').on('click', function(){
    $(this).hide();
    $('#reset').hide();
    submitAnswers(ans, totalTime-tmp, tmp);
});

$('.finishTest').on('click', function(){
    finishTest();
});
function submitAnswers(ans, timePassed, tmp){
   data = {answer: ans, timeConsumed: timePassed, totalTime:tmp};
   $.get('<?= base_url('skill_functions/nextQuestion')?>', data).done(function(res){
        if(res == 'false'){
            window.location = "<?= base_url('skill-tests')?>";
        }
        res = JSON.parse(res);
        console.log(res);
        if(res.skips!=false){
            populate(res);
            $('.skipQuestion').show();
        }
        else{
            populate(res);
            $('.skipQuestion').hide();
        }
   })
}

function finishTest(){
    clearInterval(interval);
    window.location = "<?= base_url('skill_functions/endTest')?>";
}

function populate(res){
    if(res.questionData == null){
        finishTest();
    }else{
    $('.submitAns').hide()
    $('#reset').hide();
    $('#question').empty();
    $("#"+selected).prop("checked", false);
    $('#question').html(res.questionData.question);
    $('#option1').html(res.questionData.option1);
    $('#option2').html(res.questionData.option2);
    $('#option3').html(res.questionData.option3);
    $('#option4').html(res.questionData.option4);
    $(document).find('#skipsLeft').html(res.skipsLeft);
    $('.skipQuestion').show();
    questionTime = 2*res.questionData.expert_time;
    totalTime = res.totalTime;
    clearInterval(interval);
    $('#questionTimer').empty();
    $('#questionTimer').svgTimer();
        var hey = setInterval(function () {
            var nc = 0;
            if (nc<=0) {
                clearInterval(hey);
                $('.submitAns').show()
                $('#reset').show()
                }
        },1000);
}
}


  </script>

  </body>

</html>
