<div class="well well-small">
	<h4>Matches for <font style="font-style:italic;">'<?=$this->input->post('q');?>'</font></h4>

   	<div id="result_list">
        <?php if(!empty($search)): ?>
        <div class="pagination"><?php echo (isset($pagination)) ? $pagination : '';?></div>
        <div class="clearfix">
        	<?php foreach ($search  as $collection => $items): ?>
                <h5>Collection <i>'<?=$collection?>'</i></h5>
                <?php if ($items): ?>
                    <?php foreach ($items as $result): ?>
                        <div class="media well well-small">
                            <a class="pull-left" role="button" href="<?=site_url('product/'. $result->product_id . '/'. str_replace(' ', '-', strtolower($result->product_name)));?>">
                                <img class="media-object" src="<?=$img_path.$result->product_image;?>" />
                            </a>
                            
                            <div class="media-body">
                                <h5 class="media-heading"><?=$result->product_name;?></h5>
                                <?=substr(strip_tags($result->product_description), 0, 250).'...';?>
                                <div class="clearfix margin-top">
                                    <div class="pull-left"><button  name="add_to_cart" id="add_to_cart" class="btn btn-mini btn-primary add_to_cart" type="button" data-product-id="<?=intval($result->product_id);?>"><i class="icon-shopping-cart"></i> Add to cart</button>&nbsp;&nbsp;&nbsp;<span id="modal-msg-<?=intval($result->product_id);?>"></span></div>
                                    
                                    <div class="pull-right"><a  role="button" href="<?=site_url('product/'. $result->collection_id .'/' . $result->product_id . '/'. str_replace(' ', '-', strtolower($result->product_name)));?>">read more</a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
        	<?php endforeach; ?>
        <div class="pagination"><?php echo (isset($pagination)) ? $pagination : '';?></div>
        </div>
        <?php else: ?>
        <p class="alert alert-info">No results</p>
        <?php endif; ?>
    </div>
</div>
