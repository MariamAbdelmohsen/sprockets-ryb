<?php
/*
config.php
configuration info sprockets
*/

//other include files referenced here
include 'credentials.php';

define('DEBUG',TRUE); #we want to see all the errors

define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

$nav1['index.php'] = "HOME";
$nav1['about.php'] = "ABOUT";
$nav1['ryb_list.php'] = "ROW YR BOAT";
$nav1['contact.php'] = "CONTACT";
$nav1['request.php'] = "REQUEST";

//defaults for header.php
$banner = 'SPROCKETS';
$slogan = 'Sprockets are superior to widgets';

switch(THIS_PAGE){
        
    case 'template.php':
        $title = 'Template Page';
        $headerImage = 'ryb.png';
        $banner = 'Template';
        $slogan = 'Not all pages look the same';
    break;
        
    case 'index.php':
        $title = 'Home';
        $headerImage = 'ryb.png';
        $banner = 'Home';
        $slogan = '';
    break;
        
    case 'about.php':
        $title = 'About';
        $headerImage = 'ryb.png';
        $banner = 'About';
        $slogan = 'A play produced for politically-conscious audiences';
    break;
        
    case 'ryb_list.php':
        $title = 'Row Yr Boat';
        $headerImage = 'ryb.png';
        $banner = 'Photo Gallery';
        $slogan = 'Row Yr Boat (Achievement Unlocked)';
    break;
                
    case 'ryb_view.php':
        $title = 'Row Yr Boat Image';
        $headerImage = 'ryb.png';
        $banner = 'Production Photo';
        $slogan = 'Row Yr Boat (Achievement Unlocked)';
    break;
        
    case 'contact.php':
        $title = 'Contact';
        $headerImage = 'ryb.png';
        $banner = 'Contact';
        $slogan = 'Tell us what you think';
    break;
        
    case 'request.php':
        $title = 'Request';
        $headerImage = 'ryb.png';
        $banner = 'Request';
        $slogan = '';
    break;
        
    default:
        $title = THIS_PAGE;   
}//end page switch

function myerror($myFile, $myLine, $errorMsg)
{
    if(defind('DEBUG') && DEBUG)
    {
        echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
        echo "Error Message: <b>" . $errorMsg . "</b><br />";
        die();
    }else{
        echo "I'm sorry, we have encountered an error. Would you like to buy some coffee?";
        die();
    }
}//end myerror()

function cleanblog_links($nav1){
    foreach($nav1 as $url => $text){
        if (THIS_PAGE == $url){
            echo '
            <li class="nav-item"><a class="nav-link" href="' . $url . '">' . $text . '</a></li>';
        }else{
            echo '
            <li class="nav-item"><a class="nav-link" href="' . $url . '">' . $text . '</a></li>';
        }
    }
}//cleanblog_links()

?>