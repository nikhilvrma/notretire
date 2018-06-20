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
            <p>Campus Puppy&rsquo;s mission is to connect the company professionals with potential candidates available for jobs and internships. Our registered users (&ldquo;Members&rdquo;) share their professional identities, engage with their network, and find business and career opportunities.<br /><br />We believe that our services allow our Members to effectively compete and achieve their full career potential. The cornerstone of our business is to focus on our Members first.<br /><br />Maintaining your trust is our top priority, so we adhere to the following principles to protect your privacy:<br /><br />We protect your personal information and will only provide it to third parties:</p><p>1. with your consent.<br />2.&nbsp;where it is necessary to carry out your instructions.<br />3.&nbsp;as reasonably necessary in order to provide our features and functionality to you.<br />4.&nbsp;when we reasonably believe it is required by law, subpoena or other legal process, or<br />5.&nbsp;as necessary to enforce our User Agreement or protect the rights, property, or safety of CampusPuppy, our Members and Visitors, and the public.</p><p>We have implemented appropriate security safeguards designed to protect your information in accordance with industry standards.</p><p>We may modify this Privacy Policy from time to time, and if we make material changes to it, we will provide notice through our Service, or by other means so that you may review the changes before you continue to use our Services. If you object to any changes, you may contact us regarding the same.</p><p><strong>1. Data Controllers</strong></p><p>Our Privacy Policy applies to any Member or Visitor. We collect information when you use our Services to offer you a personalized and relevant experience. If you have any concern about providing information to us or having such information displayed on our Services or otherwise used in any manner permitted in this Privacy Policy and the User Agreement, you should not become a Member. If you have already registered, you can contact us regarding the issues.</p><p><strong>2. Consent</strong></p><p>If you use our Services, you consent to the collection, use and sharing of your personal data under this Privacy Policy and agree to the User Agreement.<br /><br /><strong>3. Change</strong></p><p>We may modify this Privacy Policy, and if we make material changes to it, we will provide notice through our Services, or by other means, to provide you the opportunity to review the changes before they become effective. Your continued use of our Services after we publish or send a notice about our changes to this Privacy Policy means that you are consenting to the updated Privacy Policy.<br /><br /><strong>A. Information We Collect</strong></p><p><strong>1. Registration</strong></p><p>To create an account on CampusPuppy, you must provide us with at least your name, email address, mobile number and a password and agree to our User Agreement and this Privacy Policy, which governs how we treat your information. You may provide additional information during the registration flow (for example, &nbsp;educational details and skills) to help you build your profile. You understand that, by creating an account, we and others will be able to identify you by your CampusPuppy profile.</p><p><strong>2. Profile Information</strong></p><p>We collect information when you fill out a profile. A complete CampusPuppy profile that includes professional details &ndash; like your education details, and skills &ndash; helps you get found by other people for opportunities. After you create an account, you may choose to provide additional information on your Campus Puppy profile, such as descriptions of your skills, professional experience, and educational background. Providing additional information enables you to derive more benefit from our Services by helping you express your professional identity, find other professionals, opportunities, and information, and help recruiters.</p><p><strong>B. Information we collect:</strong></p><p><strong>1. Customer Service</strong></p><p>We collect information when you contact us for customer support. When you contact our customer support services, we may have to access your inbox, and other contributions to our Services and collect the information we need to categorize your question, respond to it, and, if applicable, investigate any breach of our User Agreement or this Privacy Policy. We also use this information to track potential problems and trends and customize our support responses to better serve you.</p><p><strong>2. Using the CampusPuppy Site</strong></p><p>We collect information when you visit our Services &nbsp;and interact with advertising on and off our Services.</p><p><strong>3. Messages</strong></p><p>We collect information about you when you send, receive, or engage with messages in connection with our Services.</p><p><strong>4. Others</strong></p><p>Our Services are a dynamic, innovative environment, which means we are always seeking to improve the Services we offer you. We often introduce new features, some of which may result in the collection of new information. Furthermore, new partnerships or corporate acquisitions may result in new features, and we may potentially collect new types of information. If we start collecting substantially new types of personal information and materially change how we handle your data, we will modify this Privacy Policy and notify you.<br /><br /><strong>C. How We Use Your Data</strong><br /><br /><strong>1. Services</strong></p><p>Our Services help you connect with others, find and be found for work opportunities, stay informed, get training and be more productive. We use your data to authenticate you and authorize access to our Services.</p><p><strong>2. Stay Connected</strong></p><p>Our Services allow you to stay in touch, in communication and up to date with colleagues, and other professional contacts. To do so, you will &ldquo;connect&rdquo; with the professionals who you choose, and who also wish to &ldquo;connect&rdquo; with you.<br />It is your choice whether to send a connection request, or allow another Member to become your connection. When you invite someone to connect with you, your invitation will include your name, photo, and contact information. We will send invitation reminders to the person you invited.</p><p><strong>3. Career</strong></p><p>Our Services allow you to explore careers, evaluate educational opportunities, and seek out, and be found for, career opportunities. Your profile can be found by those looking to hire (for a job) or be hired by you. We will use your data to recommend jobs, show you and others who work at a company, in an industry, function or location or have certain skills and connections.</p><p><strong>4. Productivity</strong></p><p>Our Services allow you to collaborate with fellow colleagues and employers. Our Services allow you to communicate with them.</p><p><strong>5. Communications</strong></p><p>We contact you and enable communications between members.<br /><br />We will contact you through email, notices posted on our website, messages to your CampusPuppy inbox, and other ways through our Services. We will send you messages about the availability of our Services, security, or other service-related issues. We also send messages about how to use the Services, network updates, reminders, job suggestions and promotional messages from us and our partners. Please be aware that you cannot opt out of receiving service messages from us, including security and legal notices.</p><p><strong>6. Marketing</strong></p><p>We use data and content about Members for invitations and communications promoting membership and network growth, engagement and our Services.<br /><br /><strong>D. Developing Services and Research</strong><br /><br /><strong>1. Service Development</strong></p><p>We use data, including public feedback, to conduct research and development for the further development of our Services in order to provide you and others with a better, more intuitive and personalized experience, drive membership growth and engagement on our Services, and help connect professionals to each other and to economic opportunity.<br /><br /><strong>2. Other Research</strong></p><p>We seek to create economic opportunity for members of the global workforce and to help them be more productive and successful. We use the data available to us to research social, economic and workplace trends such as jobs availability and skills needed for these jobs and policies that help bridge the gap in various industries and geographic areas. &nbsp;</p><p><strong>3. Customer Support</strong></p><p>We use the data (which can include your communications) needed to investigate, respond to and resolve complaints and Service issues (e.g., bugs).</p><p><strong>4. Security and Investigations</strong></p><p>We use your data (including your communications) if we think it&rsquo;s necessary for security purposes or to investigate possible fraud or other violations of our User Agreement or this Privacy Policy and/or attempts to harm our Members or Visitors.<br /><br /><strong>E. How We Share Information</strong></p><p><strong>1. Our Services</strong></p><p>Any information you include on your profile will be seen by others.</p><p><strong>2. Service Providers</strong></p><p>We use others to help us provide our Services (e.g., maintenance, analysis, fraud detection, marketing and development). They will have access to your information as reasonably necessary to perform these tasks on our behalf and are obligated to not to disclose or use it for other purposes.</p><p><strong>3. Legal Disclosures</strong></p><p>We may need to share your data when we believe it&rsquo;s required by law or to protect your and our rights and security.</p><p>It is possible that we will need to disclose information about you when required by law, or other legal process or if we have a good faith belief that disclosure is reasonably necessary to</p><p>1. investigate, prevent, or take action regarding suspected or actual illegal activities or to assist government enforcement agencies;<br />2.&nbsp;enforce our agreements with you,<br />3.&nbsp;investigate and defend ourselves against any third-party claims or allegations,<br />4.&nbsp;protect the security or integrity of our Service (such as by sharing with companies facing similar threats); or<br />5.&nbsp;exercise or protect the rights and safety of Campus Puppy, our Members, personnel, or others. We attempt to notify Members about legal demands for their personal data when appropriate in our judgment, unless prohibited by law or court order or when the request is an emergency. We may dispute such demands when we believe, in our discretion, that the requests are overbroad, vague or lack proper authority, but we do not promise to challenge every demand.<br /><br /><strong>F. Your Choices &amp; Obligations</strong><br /><br /><strong>1. Data Retention</strong></p><p>We retain the personal data you provide while your account is in existence or as needed to provide you Services. Even if you only use our Services when looking for a new job every few years, we will retain your information and keep your profile open.</p><p><br /><strong>G. Other Important Information</strong></p><p><strong>1. Security</strong></p><p>We monitor for and try to prevent security breaches. Please use the security features available through our Services.<br /><br /><strong>2. Contact Information</strong></p><p>If you have questions or complaints regarding this Policy, please first contact Campus Puppy online. You can also reach us by physical mail. If contacting us does not resolve your complaint, you have more options.</p>
          </p>


        </div>
      </div>

    </div>
  </div>

    <?php echo $footer; ?>

    <?php echo $footerFiles; ?>

  </body>

</html>
