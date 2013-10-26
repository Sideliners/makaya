<div class="well well-small">
	<h3><?=$page_title?></h3>
    <?php
		  if ( !isset($product) ) {
			  echo "<div class='row-fluid'>";
			  foreach ( $products as $product) {	
				  echo "<span class='pull-left well'  style='max-width: 100px;'>";
				  echo "<img src='".$this->config->item('image_product_path').$product->primary_image."'/><br>";
				  echo "<a href='".site_url("product/".$product->product_id."/".$product->clean_pname)."' alt='{$product->product_name}' title='{$product->product_name}'>{$product->product_name}</a><br>";
				  echo "</span>";
			  }
			  echo "</div>";
		  }
		  else {
			  echo "No Products Here";
		  }
	?>
</div>

