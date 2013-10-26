<div class="well well-small">
    <div class="row-fluid">
    <?php
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
        }
    ?>
    </div>
</div>
