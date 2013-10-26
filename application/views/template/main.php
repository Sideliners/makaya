<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?=$metatags;?>
    <?=$header_elements;?>
    <title>
    <?php
    if(isset($page_title)){
        echo $page_title.' | '.$site_title;
    }
    else{
        echo $site_title;
    }
    ?>
    </title>
</head>
<body>
    <div class="container">
        <div class="navbar"><?=$navigation;?></div>
        <div class="row">
            <div class="span3 clearfix visible-desktop">
                <?=$sidemenu;?>
            </div>
            <div class="span9">            	
                <?=$page;?>
                <?=$backbone;?>
            </div>
        </div>
    <!-- <div class="footer">footer</div> -->
    </div>
    <?=$scripts;?>
    <?=$modals?>
</body>
</html>
