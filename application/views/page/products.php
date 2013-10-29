<div class="well well-small">
	<h3><?=$page_title?></h3>
    <?php
		  if (!empty($products) ) {
			  echo "<div>";			  
			  echo '<ul class="inline">';
			  
			  foreach ($products as $product) {                    
              	echo "<li class='thumbnail album-li'>";
				echo "<div class='center-cropped' style='background-image: url(\"{$product->image_path}\")'></div>";
				echo "<a href='" . site_url($product->url) . "'>{$product->product_name}</a>";
				echo "</li>";
			  }
			  
			  echo "</ul>";
			  echo "</div>";
		  }
		  else {
			  echo "No Products Here";
		  }
	?>
</div>

