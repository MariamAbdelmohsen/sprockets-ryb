<?php 
/**
 * taken from demo_list_pager.php which demonstrates a list page that paginates data across 
 * multiple pages
 * 
 * This page uses a Pager class which processes a mysqli SQL statement 
 * and spans records across multiple pages. 
 * 
 * @package nmPager
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 3.2 2015/11/24
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0 v. 3.0
 * @see MyAutoLoader.php
 * @see Pager.php 
 * @todo none
 */

include 'includes/config.php';
require 'includes/Pager.php'; #allows pagination
# SQL statement
$sql = "select * from ryb_album";

#Fills <title> tag
$title = 'Row Yr Boat/View/Pager';
# END CONFIG AREA --------------------------------------------------------------

include get_header()?>
<h1>Row Yr Boat</h1>
<p><em>All photographs taken by <a href="https://www.facebook.com/DangerpantsPhotography/" target="_blank">Ian Johnston, Dangerpants Photography</a></em></p>
<hr>

<?php
$prev = '<img src="images/arrow_prev.gif" border="0" />';
$next = '<img src="images/arrow_next.gif" border="0" />';

#Create a connection
# connection comes first in mysqli (improved) function
$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

#Create instance of new 'pager' class
$myPager = new Pager(5,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql,$iConn); #load SQL, pass in existing connection, add offset
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if(mysqli_num_rows($result) > 0)
{#records exist - process
    echo $myPager->showNAV();//show pager if enough records
    if($myPager->showTotal()==1){$itemz = "photo";}else{$itemz = "photos";}//deal with plural
    echo '<h4 align="center">There are ' . $myPager->showTotal() . ' ' . $itemz . '.</h4>';
    while($row = mysqli_fetch_assoc($result))
    {
        echo '<div><p>';
        echo '<a href="ryb_view.php?id=' . $row['picID'] . '">' . $row['caption'] . '</a><br />';
        echo '' . $row['actors'] . '';
        echo '<blockquote>' . $row['quote'] . '</blockquote>';
        echo '</p></div><hr>';
    }  
    echo $myPager->showNAV();//show pager if enough records

}else{//inform there are no records
    echo '<p>There are no pictures.</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);    
    
    
?>
<?php get_footer()?>