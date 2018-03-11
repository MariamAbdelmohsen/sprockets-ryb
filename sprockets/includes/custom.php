<?php
function cleanblog_clean_post($key)
{
        if(isset($_POST[$key])){
            return strip_tags(trim($_POST[$key]));
        }else{
            return '';
        }
}
?>