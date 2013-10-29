<div class="well well-small" id="highlights">
    <?php if(!empty($highlights)): ?>
    <h4 id="modal_name" style="display: none;"><?=$highlights->artisan_name?></h4>
    <h4 id="collection_name" class="text-center"><small><?=$highlights->collection_name;?></small><hr /></h4>
    <div class="clearfix">
    	<div class="thumbnail pull-left background-white" id="artisan">
    		<p><img src="<?=$this->config->item('image_artisan_path').$highlights->artisan_image?>" style="max-width: 300px;" alt="<?=$highlights->artisan_name?>" title="<?=$highlights->artisan_name?>" /></p>
            <p class="text-center"><strong><?=$highlights->artisan_name?></strong></p>
        </div>
        
        <div class="pull-right">
        	<div id="enterprise">
                <p class="text-center">
                    <a href="<?=site_url('enterprise/'.$highlights->collection_id.'/'.$highlights->enterprise_id.'/'.$highlights->clean_ename);?>" class="thumbnail background-white" title="<?=$highlights->enterprise_name;?>">
                        <img src="<?=$this->config->item('image_enterprise_path').$highlights->enterprise_image;?>" alt="<?=$highlights->enterprise_name;?>" title="<?=$highlights->enterprise_name;?>" />
                        <strong><?=$highlights->enterprise_name;?></strong>
                    </a>
                </p>
            </div>
            <div id="product">
                <p class="text-center">
                    <a href="<?=site_url('product/'.$highlights->collection_id.'/'.$highlights->product_id.'/'.$highlights->clean_pname);?>" class="thumbnail background-white" title="<?=$highlights->product_name;?>">
                        <img src="<?=$this->config->item('image_product_path').$highlights->product_image?>" alt="<?=$highlights->product_name?>" title="<?=$highlights->product_name?>" />
                        <strong><?=$highlights->product_name?></strong>
                    </a>
                </p>
            </div>
        </div>
    </div>
    
   <div id="article" class="margin-top">
        <dl>
		    <dt id="name"><?=$highlights->artisan_name?></dt>
    		<dd><?=$highlights->artisan_description;?></dd>
        </dl>
        <dl class="well well-large">
            <dt>"<?=$highlights->article_title;?>"</dt>
            <dd><?=$highlights->article_body;?></dd>
        </dl>
    </div>
    <span id="read_more"><a href="#" onclick="show_details('artisan',<?=$highlights->artisan_id?>)">READ MORE</a></span>
	<?php else: ?>
        <h1>No Artisan to Display</h>
	<?php endif; ?>
</div>
