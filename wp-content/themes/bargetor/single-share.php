<ul class="single-bar single-share-bar">
	<li class="single-bar-item single-share-bar-item"><a
		href="javascript:void(0);"
		onclick="shareToWeibo('', '<?php the_permalink();?>', '<?php the_title();?> -- <?php the_post_sub_title(get_the_ID());?>', findPic('<?php the_product_post_meta_product_home_background_img(get_the_ID())?>', '<?php the_product_post_meta_upper_img(get_the_ID())?>', '<?php the_post_meta_background_img(get_the_ID())?>'));"
		class="single-bar-item" title="分享到微博">
		<div class="single-bar-icon single-share-bar-icon single-share-bar-icon-weibo">
		</div>
		</a>
	</li>

	<li class="single-bar-item single-share-bar-item"><a
		href="javascript:void(0);"
		onclick="shareToQzone('', '<?php the_permalink();?>', '<?php the_title();?> -- <?php the_post_sub_title(get_the_ID());?>', findPic('<?php the_product_post_meta_product_home_background_img(get_the_ID())?>', '<?php the_product_post_meta_upper_img(get_the_ID())?>', '<?php the_post_meta_background_img(get_the_ID())?>'));"
		class="single-bar-item" title="分享到Qzone">
		<div class="single-bar-icon single-share-bar-icon single-share-bar-icon-Qzone">
		</div>
		</a>
	</li>
</ul>
