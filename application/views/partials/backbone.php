<div class="well well-small">
    <div class="row-fluid">
        <div class="span3">
            <ul class="unstyled">
                <?php foreach( $backbone['pages'] as $page): ?>
                <li><a href="<?php echo site_url($page->page_uri); ?>"><?php echo $page->page_name;?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    <!--
	//print_r($backbone);
           foreach ( $backbone as $position => $backbone_list ) { 
            echo "<span class='span3'>";
            echo '<ul class="unstyled">';
            foreach ( $backbone_list as $name => $uri) {
                if($name != 'Browse Makaya Products'){
                    echo "<li><a href='{$uri}'>{$name}</a></li>";
                }
                else{
                    echo "<strong>{$name}</strong>";
                }
            }
            echo '</ul>';
            echo "</span>";
        }*/ -->
    </div>
</div>
