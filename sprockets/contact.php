<?php include 'includes/config.php'?>
<?php get_header()?>
<h2>Contact Us</h2>
<?php
//email3.php
if(isset($_POST['Submit']))
{//send email?
    
    $to = "catherineblakesmith@gmail.com";
    
    $subject = "Sprocket Feedback " . date("m/d/y, G:i:s");
    
    //collect and clean post data
    $FirstName = cleanblog_clean_post('FirstName');
    $LastName = cleanblog_clean_post('LastName');
    $Email = cleanblog_clean_post('Email');
    $Show = cleanblog_clean_post('Show');
    $Heard = cleanblog_clean_post('heard');
    $Comments = cleanblog_clean_post('Comments');
    
    //build body of email
    $text = '';//initialize variable
    $text .= 'First Name: ' . $FirstName . PHP_EOL . PHP_EOL;
    $text .= 'Last Name: ' . $LastName . PHP_EOL . PHP_EOL;
    $text .= 'Email: ' . $Email . PHP_EOL . PHP_EOL;
    $text .= 'Did you see the show? ' . $Show . PHP_EOL . PHP_EOL;
    $text .= 'I knew about the show because: ' . $Heard . PHP_EOL . PHP_EOL;
    $text .= 'Comments: ' . $Comments . PHP_EOL . PHP_EOL;
    
    $headers = 'From: noreply@growlingwillow.com' . PHP_EOL .
    'Reply-To: ' . $Email . PHP_EOL .
    'X-Mailer: PHP/' . phpversion();
    
    mail($to,$subject,$text,$headers);
    
    echo '<div>
        <h3>Message Sent</h3>
        <p>I will get back to you as soon as I can!</p>
        </div>';
        
}else{//show form!
    echo '
    <form action="contact.php" method="post">
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
    <br />
    <div class="control-group">
            <fieldset>
            <legend>Did you see <em>Row Yr Boat (Achievement Unlocked)</em> at Annex Theatre?</legend><br />
            <input type="radio" name="Show" value="Yes" required="required" class="floating-label-form-group label"> Yes<br />
            <input type="radio" name="Show" value="No" class="floating-label-form-group label"> No<br />
            </fieldset>
    </div>
    <br />
    <div class="control-group">
            <fieldset>
            <legend>How did you hear about the show?</legend><br />
            <input type="checkbox" name="heard" value="Actor" class="floating-label-form-group label"/> I was in it<br />
            <input type="checkbox" name="heard" value="Crew" class="floating-label-form-group label"/> I worked on it<br />
            <input type="checkbox" name="heard" value="Audience"class="floating-label-form-group label" /> I went to see it<br />
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
            <label class="text-heading" for="Comments">Comments</label>
            <textarea class="form-control" name="Comments" id="Comments" placeholder="Tell me more"></textarea>
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