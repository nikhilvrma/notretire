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
      <?php if(isset($_SESSION['user_data']['loggedIn']) && $_SESSION['user_data']['loggedIn']){ ?>
        <?php echo $sidebar; ?>
      <?php } ?>
      <?php if(isset($_SESSION['user_data']['loggedIn']) && $_SESSION['user_data']['loggedIn']){ ?>
        <div class="col-lg-9 mb-4">
      <?php } ?>
      <?php if(!(isset($_SESSION['user_data']['loggedIn']) && !($_SESSION['user_data']['loggedIn']))) { ?>
        <div class="col-lg-12 mb-4">
      <?php } ?>

            <ol class="breadcrumb" style="margin-top: 30px;">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
          </ol>

          <h3 class="mt-4 mb-3" style="float: right;"><?php echo $pageTitle; ?></h3>
          <div class="clearfix"></div>
          <hr>

          <p style="font-size: 14px;">
            <p>The cornerstone of our business is to focus on our Members first. We protect your personal information using industry ­standard safeguards. We may share your information with your consent or as required by law, and we will always let you know when we make significant changes to this Terms and Conditions.</p><p>Statement of Rights and Responsibilities This Statement of Rights and Responsibilities ("Statement," "Terms," or "SRR") derives from the CampusPuppy Principles, and is our terms of service that governs our relationship with users and others who interact with CampusPuppy, as well as CampusPuppy brands, products and services, which we call the “CampusPuppy Services” or “Services”. By using or accessing the CampusPuppy Services, you agree to this Statement, as updated from time to time in accordance with the section below.</p><p><strong>A. Amendments</strong><br /><br />1. We’ll notify you before we make changes to these terms and give you the opportunity to review and comment on the revised terms before continuing to use our Services.</p><p>2. If we make changes to policies, guidelines or other terms referenced in or incorporated by this Statement, we may provide you notice regarding the same.</p><p>3. Your continued use of the CampusPuppy Services, following notice of the changes to our terms, policies or guidelines, constitutes your acceptance of our amended terms, policies or guidelines.</p><p>4. Termination If you violate the letter or spirit of this Statement, or otherwise create risk or possible legal exposure for us, we can stop providing all or part of CampusPuppy to you.</p><p><strong>B. Disputes</strong></p><p>1. You will resolve any claim, cause of action or dispute (claim) you have with us arising out of or relating to this Statement or CampusPuppy exclusively in the Delhi District Court, and you agree to submit to the personal jurisdiction of such courts for the purpose of litigating all such claims. The laws of the Country(India) will govern this Statement, as well as any claim that might arise between you and us, without regard to conflict of law provisions.</p><p>2. If anyone brings a claim against us related to your actions, content or information on CampusPuppy, you will indemnify and hold us harmless from and against all damages, losses, and expenses of any kind (including reasonable legal fees and costs) related to such claim. Although we provide rules for user conduct, we do not control or direct users' actions on CampusPuppy and are not responsible for the content or information users transmit or share on CampusPuppy. We are not responsible for any offensive, inappropriate, obscene, unlawful or otherwise objectionable content or information you may encounter on CampusPuppy. We are not responsible for the conduct, whether online or offline, of any user of CampusPuppy.</p><p>3. We try to keep CampusPuppy up, bugfree and safe, but you use it at your own risk. we are providing CampusPuppy as is without any express or implied warranties, but not limited to, fitness for a particular purpose, and non­infringement. we do not guarantee that CampusPuppy will always be safe, secure or error ­free or that CampusPuppy will always function without disruptions, delays or imperfections. CampusPuppy is not responsible for the actions, content, information, or data of third parties, and you release us, our directors, officers, employees, and agents from any claims and damages, known and unknown, arising out of or in any way connected with any claim you have against any such third parties.</p><p><strong>C. Safety:</strong></p><p>We do our best to keep CampusPuppy safe, but we cannot guarantee it. We need your help to keep it safe, which includes the following commitments by you:</p><p>1. You will not post unauthorized commercial communications (such as spam) on CampusPuppy.<br />2. You will not collect users' content or information, or otherwise access CampusPuppy , using automated means (such as harvesting bots, robots, spiders, or scrapers) without our prior permission.<br />3. You will not engage in unlawful multi­level marketing, such as a pyramid scheme, on CampusPuppy.<br />4. You will not upload viruses or other malicious code.<br />5. You will not solicit login information or access an account belonging to someone else.<br />6. You will not bully, intimidate, or harass any user.<br />7. You will not post content that: is hate speech, threatening, or pornographic, incites violence, or contains nudity or graphic or gratuitous violence.<br />9. You will not use CampusPuppy to do anything unlawful, misleading, malicious, or discriminatory.<br />10. You will not do anything that could disable, overburden, or impair the proper working or appearance of CampusPuppy, such as a denial of service attack or interference with page rendering or other CampusPuppy functionality.<br />11. You will not facilitate or encourage any violations of this Statement or our policies.</p><p><strong>D. Registration:</strong></p><p>To create an account on CampusPuppy, you must provide us with at least your name, email address mobile number, and a password and agree to our User Agreement and this Privacy Policy, which governs how we treat your information. You may provide additional information during the registration flow (for example, college details, educational achievements, skills etc) to help you build your profile and to provide. You understand that, by creating an account, we and others will be able to identify you by your CampusPuppy profile.</p><p>CampusPuppy users provide their real names and information, and we need your help to keep it that way. Here are some commitments you make to us relating to registering and maintaining the security of your account:<br /><br />1. You will not provide any false personal information on CampusPuppy, or create an account for anyone other than yourself without permission.<br />2. You will not create more than one personal account.<br />3. If we disable your account, you will not create another one without our permission.<br />4. You will not use CampusPuppy if you are under 16.<br />5. You will keep your contact information accurate and up­-to-­date.<br />6. You will not share your password, let anyone else access your account, or do anything else that might jeopardize the security of your account.<br />7. You will not transfer your account to anyone without first getting our written permission.</p><p><strong>E. Consent to CampusPuppy Processing Information About You</strong></p><p>You agree that information you provide on your profile can be seen by others and used by us as described in this Privacy Policy and our User Agreement.</p><p>The personal information that you provide to us may reveal or allow others to identify aspects of your life that are not expressly stated on your profile (for example, your picture or your name may reveal your gender). By providing personal information to us when you create or update your account and profile, you are expressly and voluntarily accepting the terms and conditions of our User Agreement and freely accepting and agreeing to our processing of your personal information in ways set out by this Privacy Policy. Supplying to us any information deemed “sensitive” by applicable law is entirely voluntary on your part. You can withdraw or modify your consent to our collection and processing of the information you provide at any time, in accordance with the terms of this Privacy Policy and the User Agreement, by changing your account settings or your profile on CampusPuppy or by closing your CampusPuppy account.</p>
          </p>


        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
