<div class="well well-small">
    <?php
    	foreach ( $springboards as $collection => $articles ) { 
			echo "<h3>{$collection}</h4>";
			echo "<div>";
			echo '<ul class="inline">';
			if ( $articles ) {
				foreach ( $articles as $article) {
					$image_path = $this->config->item('image_article_path').$article["image_name"];
					$url = "article/{$article["collection_id"]}/{$article["article_id"]}/{$article["url_title"]}";					
					echo "<li class='thumbnail album-li'>";
					echo "<div class='center-cropped' style='background-image: url(\"{$image_path}\")'></div>";
					echo "<a href='" . site_url($url) . "'>{$article["title"]}</a>";
					echo "</li>";
				}
				
				echo "</ul>";
				echo "<div>";
			}
			else {
				echo "No Articles Here";
			}
			echo "</div>";
		}
	?>
</div>
