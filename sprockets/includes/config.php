<?php
/*
config.php
configuration info sprockets
*/

//removes header already sent errors
ob_start();

define('SECURE',false); #force secure, https, for all site pages

define('PREFIX', 'sprockets_wn18_'); #Adds uniqueness to your DB table names. Limits hackability, naming collisions

header("Cache-Control: no-cache");header("Expires: -1");#Helps stop browser & proxy caching

define('DEBUG',TRUE); #we want to see all the errors

//other include files referenced here
include 'credentials.php';#stores database info
include 'common.php';#stores favorite functions
include 'custom.php';#stores custom functions

//prevents date errors
date_default_timezone_set('America/Los_Angeles');

//create config object
$config = new stdClass;

$config->nav1['index.php'] = "HOME";
$config->nav1['about.php'] = "ABOUT";
$config->nav1['ryb_list.php'] = "PHOTOS";
$config->nav1['dramaturgy.php'] = "DRAMATURGY";
$config->nav1['contact.php'] = "CONTACT";
$config->nav1['request.php'] = "REQUEST";

//create default page identifier
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//START NEW THEME STUFF - be sure to add trailing slash!
$sub_folder='sprockets/';
$config->theme = 'cleanblog1';//sub folder to themes

//will add sub-folder if not loaded to root:
$config->physical_path = $_SERVER["DOCUMENT_ROOT"] . '/' . $sub_folder;
//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#force HTTPS
    header("Location:https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{
    //adjust protocol
    $protocol = (SECURE==true ? 'https://' : 'http://');
    //returns true
    
}
$config->virtual_path = $protocol . $_SERVER["HTTP_HOST"] . '/' . $sub_folder;

define('ADMIN_PATH', $config->virtual_path . '/admin/'); 
define('INCLUDE_PATH', $config->physical_path . '/includes/');

//defaults for header.php
$config->banner = 'SPROCKETS';
$config->slogan = 'Sprockets are superior to widgets';
$config->loadhead = '';#place items in <head> element

switch(THIS_PAGE){
        
    case 'template.php':
        $config->title = 'Template Page';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Template';
        $config->slogan = 'Not all pages look the same';
    break;
        
    case 'index.php':
        $config->title = 'Home';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Home';
        $config->slogan = '';
    break;
        
    case 'about.php':
        $config->title = 'About';
        $config->headerImage = 'ryb.png';
        $config->banner = 'About';
        $config->slogan = 'A play produced for politically-conscious audiences';
    break;
        
    case 'ryb_list.php':
        $config->title = 'Row Yr Boat Photo Gallery';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Photo Gallery';
        $config->slogan = 'Row Yr Boat (Achievement Unlocked)';
    break;
                
    case 'ryb_view.php':
        $config->title = 'Row Yr Boat Photo';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Production Photo';
        $config->slogan = 'Row Yr Boat (Achievement Unlocked)';
    break;
        
    case 'dramaturgy.php':
        $config->title = 'Row Yr Boat Dramaturgy';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Dramaturgy';
        $config->slogan = 'Row Yr Boat (Achievement Unlocked)';
    break;
        
    case 'contact.php':
        $config->title = 'Contact';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Contact';
        $config->slogan = 'Tell us what you think';
    break;
        
    case 'request.php':
        $config->title = 'Request';
        $config->headerImage = 'ryb.png';
        $config->banner = 'Request';
        $config->slogan = '';
    break;
        
    default:
        $config->title = THIS_PAGE;   
}//end page switch

//creates theme virtual path for theme assets, JS, CSS, images
$config->theme_virtual = $config->virtual_path . 'themes/' . $config->theme . '/';

/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
if(startSession() && isset($_SESSION['AdminID']))
{#add admin logged in info to sidebar or nav
    
    $config->adminWidget = '
        <a href="' . ADMIN_PATH . 'admin_dashboard.php">ADMIN</a> 
        <a href="' . ADMIN_PATH . 'admin_logout.php">LOGOUT</a>
    ';
}else{//show login (YOU MAY WANT TO SET TO EMPTY STRING FOR SECURITY)
    
    $config->adminWidget = '
        <a  href="' . ADMIN_PATH . 'admin_login.php">LOGIN</a>
    ';
}

?>