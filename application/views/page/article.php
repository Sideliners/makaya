<div class="well well-small">
    <?php
		echo "<h3>{$article->title} <small> {$article->theme->theme_name} </small></h3>";
		echo "<small> DATE CREATED: {$article->date_created} </small> <br>";
		echo "<small> LAST MODIFIED: {$article->last_modified} </small> <br>";
		
		echo "<img src='".$this->config->item('image_article_path').$article->article_image."' class='well well-small'/>";
		echo "<div>{$article->body}</div>";
	?>
</div>