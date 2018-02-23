<?php include 'includes/config.php'?>
<?php include 'includes/header.php'?>
<h1>Row Yr Boat</h1>
<p><em>All photographs taken by <a href="https://www.facebook.com/DangerpantsPhotography/" target="_blank">Ian Johnston, Dangerpants Photography</a></em></p>
<hr>

<?php
$sql = "select * from ryb_album";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        echo '<div><p>';
        echo '<a href="ryb_view.php?id=' . $row['picID'] . '">' . $row['caption'] . '</a><br />';
        echo '' . $row['actors'] . '';
        echo '<blockquote>' . $row['quote'] . '</blockquote>';
        echo '</p></div><hr>';
    }    

}else{//inform there are no records
    echo '<p>There are no pictures.</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);    
    
    
?>
<?php include 'includes/footer.php'?>