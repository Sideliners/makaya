<div class="well well-small">
    <?php

		foreach ( $springboards as $collection => $articles ) { 
			echo "<h3>{$collection}</h4>";
			echo "<div class='row-fluid'>";
			if ( $articles ) {
				foreach ( $articles as $article) {	
					echo "<span class='pull-left well'  style='max-width: 100px;'>";
					echo "<img src='".$this->config->item('image_article_path').$article["image_name"]."'/><br>";
					echo  "<a href='".site_url('article/'.$article["id"].'/'.$article["url_title"])."'>{$article["title"]}</a>";
					echo "</span>";
				}
			}
			else {
				echo "No Articles Here";
			}
			echo "</div>";
		}
	?>
</div>
