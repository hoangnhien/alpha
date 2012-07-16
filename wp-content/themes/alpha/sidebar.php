	<div class="hn-widget">
		<h1>
			<img src="<?php bloginfo('template_directory')?>/images/icons/widget-title.png" alt="Products" />
			DANH MỤC SẢN PHẨM
		</h1>
		<section id="hn-category-list" style="visibility:hidden;">
			<?php 
			dynamic_sidebar( 'Left Sidebar' ); 

	//wp_list_categories( );
			?>
			
		</section>
	</div>
	<div class="hn-widget">
		<h1>
			<img src="<?php bloginfo('template_directory')?>/images/icons/widget-title.png" alt="Products" />
			SẢN PHẨM NỔI BẬT
		</h1>
		<section>
		<?php 
		// get all the product in noi_bac category

		 $args = array(
		    'numberposts'     => 10,
		    'category'        => 19,
		    'orderby'         => 'post_date',
		    'order'           => 'DESC',
		    'post_type'       => 'post',
		    );
	 	$myposts = get_posts( $args );
	 ?> 
 
 
 <?php foreach( $myposts as $post ) :	setup_postdata($post); ?>
 	<ul class="hn-product-highlight">
 		<li>
			<?php  		
				$thumb = "";	
				
				$rows = get_field('images');
				if($rows) {
					foreach($rows as $row) {
						$thumb = $row['image'];
						break;
					}
				}
			?>
			<a href="<?php the_permalink(); ?>">
	 			<img src="<?php echo $thumb?>" alt="product-thumb" width="49" height="49" />
	 			<span><?php short_title(); ?></span>
 			</a>
 		</li>
 	</ul>
 		
		
	<?php endforeach; ?>
		</section>
		
	</div>
	
	<?php $content = get_field('quangcao_bottom_left', 198);?>
    <?php if($content != ""): ?>
		<div class="hn-widget hn-advert">
		<?php echo $content;?>
		</div>
    <?php endif; ?>
	
