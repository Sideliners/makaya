<div class="well well-small">
    <div class="row-fluid">
        <div class="span3">
            <ul class="unstyled">
                <?php foreach( $backbone['pages'] as $page): ?>
                <li><a href="<?php echo site_url('page/'.$page->page_uri); ?>"><?php echo $page->page_name;?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        
        <div class="span3">
            <ul class="unstyled">
            	<?php foreach( $backbone['statics'] as $key => $val): ?>
                <li><a href="<?=$val; ?>"><?php echo $key;?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        
        <div class="span3">
            <ul class="unstyled">
            	<li><strong>Browse Makaya Products</strong></li>
            	<?php foreach( $backbone['collections'] as $key => $val): ?>
                <li><a href="<?=$val; ?>"><?=$key;?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
