<?php
class UrlHelper{

    public function __construct() {}
    
    public static function NavigatePage($page){
        ?> 
            <meta http-equiv='refresh' content='0; url=http://<?php pola('', $page.'/'); ?>'>
        <?php
    }
            
}
?>

