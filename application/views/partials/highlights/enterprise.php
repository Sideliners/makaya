<div class="well well-small" id="highlights">
    <?php if(!empty($highlights)): ?>
    <h4 id="modal_name" style="display: none;"><?=$highlights->enterprise_name?></h4>
    <h4 id="collection_name" class="text-center"><small><?=$highlights->collection_name;?></small><hr /></h4>
    <div class="clearfix">
    	<div class="thumbnail pull-left background-white" id="enterprise">
    		<p><img src="<?=$this->config->item('image_enterprise_path').$highlights->enterprise_image?>" style="max-width: 300px;" alt="<?=$highlights->enterprise_name?>" title="<?=$highlights->enterprise_name?>" /></p>
            <p class="text-center"><strong><?=$highlights->enterprise_name?></strong></p>
        </div>
        
        <div class="pull-right">
        	<div id="product">
                <p class="text-center">
                    <a href="<?=site_url('product/'.$highlights->product_id.'/'.$highlights->clean_pname);?>" class="thumbnail background-white" title="<?=$highlights->product_name;?>">
                        <img src="<?=$this->config->item('image_product_path').$highlights->product_image;?>" alt="<?=$highlights->product_name;?>" title="<?=$highlights->product_name;?>" />
                        <strong><?=$highlights->product_name;?></strong>
                    </a>
                </p>
            </div>
            <div id="artisan">
                <p class="text-center">
                    <a href="<?=site_url('artisan/'.$highlights->artisan_id.'/'.$highlights->clean_aname);?>" class="thumbnail background-white" title="<?=$highlights->artisan_name;?>">
                        <img src="<?=$this->config->item('image_artisan_path').$highlights->artisan_image?>" alt="<?=$highlights->artisan_name?>" title="<?=$highlights->artisan_name?>" />
                        <strong><?=$highlights->artisan_name?></strong>
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <div id="article" class="margin-top">
        <dl>
		    <dt id="name"><?=$highlights->enterprise_name?></dt>
    		<dd><?=$highlights->enterprise_description;?></dd>
        </dl>
        <dl class="well well-large">
            <dt>"<?=$highlights->article_title;?>"</dt>
            <dd><?=$highlights->article_body;?></dd>
        </dl>
    </div>
    <span id="read_more"><a href="#" onclick="show_details('enterprise',<?=$highlights->enterprise_id?>)">READ MORE</a></span>
	<?php else: 
        redirect(site_url());
	endif; ?>
</div>
