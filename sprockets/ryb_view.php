<?php
//ryb_view.php - shows single image and quote
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:ryb_list.php');
}

$sql = "select * from ryb_album where picID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $caption = stripslashes($row['caption']);
        $actors = stripslashes($row['actors']);
        $quote = stripslashes($row['quote']);
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This photo does not exist!</p>';
}

?>
<?php get_header();?>
<?php
    
if($Feedback == '')
{//data exists, show it

    echo '<div><p>';
    echo '<img src="images/ryb-prod/ryb' . $id . '.jpg" /><br />';
    echo '<blockquote>' . $quote . '</blockquote>';
    echo '</p></div>'; 
    
}else{//warn user no data
    echo $Feedback;
}    

echo '<h1><a href="ryb_list.php">GO BACK</a></h1>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php get_footer();?>