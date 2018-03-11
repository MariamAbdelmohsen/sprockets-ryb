<?php include 'includes/config.php' ?>
<?php get_header()?>
<h2>Request</h2>
<?php
//email4.php

if(isset($_POST['Submit']))
{//send email?
    
    $to = "catherineblakesmith@gmail.com";
    
    $subject = "Incoming Request" . date("m/d/y, G:i:s");
    
    //collect and clean post data
    $FirstName = cleanblog_clean_post('FirstName');
    $LastName = cleanblog_clean_post('LastName');
    $Email = cleanblog_clean_post('Email');
    $Request = cleanblog_clean_post('Request');
    
    //build body of email
    $text = '';//initialize variable
    $text .= 'First Name: ' . $FirstName . PHP_EOL . PHP_EOL;
    $text .= 'Last Name: ' . $LastName . PHP_EOL . PHP_EOL;
    $text .= 'Email: ' . $Email . PHP_EOL . PHP_EOL;
    $text .= 'Please write a blog post about: ' . $Request . PHP_EOL . PHP_EOL;
    
    $headers = 'From: noreply@growlingwillow.com' . PHP_EOL .
    'Reply-To: ' . $Email . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();
    
    mail($to,$subject,$text,$headers);
    
    echo '<div>
        <h3>Message Sent</h3>
        <p>We will contact you within 24 hours.</p>
        </div>';
        
}else{//show form!
    echo '
    <form action="request.php" method="post">
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
            <label class="text-heading" for="FirstName">First Name</label>
            <input class="form-control" type="text" name="FirstName" id="FirstName" placeholder="First Name" autofocus required/>
        </div>
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
            <label class="text-heading" for="LastName">Last Name</label>
            <input class="form-control" type="text" name="LastName" id="LastName" placeholder="Last Name" required/>
        </div>
    </div>
    <div class="control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
            <label class="text-heading" for="Email">Email</label>
            <input class="form-control" type="email" name="Email" id="Email" placeholder="Email" required/>
        </div>    
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
            <label class="text-heading" for="Request">Please cover...</label>
            <textarea class="form-control" name="Request" id="Request" placeholder="What part of the show do you want to see a picture of?"></textarea>
        </div> 
    </div>
    <br />
    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="sendMessageButton" name="Submit">Submit</button>
    </div> 
    </form>
    '; 
}
get_footer()?>