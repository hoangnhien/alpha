<?php
/**
 * Description of products.php
 * 
 * @author HoangNhien
 * Jun 29, 2012
 */
?>
<?php
/*
Template Name: Products Template
*/
?>
<?php get_header(); ?>

<div id="left-contain">
<?php get_sidebar(); ?>
</div>

<div id="right-contain">
	<div id="top-banner">
		<img src="<?php bloginfo('template_directory')?>/images/banner.jpg" alt="top banner" />
	</div>
	<div class="hn-category-view">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="hn-category-title-block">
			<div class="hn-category-title">
				<img src="<?php bloginfo('template_directory')?>/images/icons/category-view-title.png" alt="Products" />
				<?php $catId = get_query_var('cat');?>
				<span><a href="<?php echo get_category_link($catId);?>">MTXT-LAPTOP</a></span>
				<a class="view-cat" href="hoangnhien.net">&gt;&gt; xem tất cả</a>
			</div>
			<div class="hn-category-filter">
				<h1><?php the_title();?></h1>
			</div>
			
		</div>
		<a href="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg&keepThis=true&TB_iframe=true&height=600&width=700"
									title="" class="thickbox">AAAAAA</a>
	
		<section class="clearfix product-detail">
			<div class="hn-product-gallery">
				
			<ul id="pikame" class="jcarousel-skin-pika">
				<li><a href="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg&keepThis=true&TB_iframe=true&height=600&width=700"
									title="" class="thickbox"><img src="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg" alt="Products" /></a><span></span></li>
				<li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg" alt="Products" /></a><span></span></li>
				<li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg" alt="Products" /></a><span></span></li>
				<li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg" alt="Products" /></a><span></span></li>
			</ul>

			</div>
			<div class="hn-product-description">
				<?php the_field('long_description');?>
				<?php
				/* short_description
				 * long_description
				 * tong_quan_san_pham
				 * thong_so_ky_thuat
				 */
				?>
				<a href="#">CLICK VÀO ĐÂY ĐỂ ĐẶT HÀNG</a>
			</div>
			<div class="clear"></div>
			<button class="hn-tab hn-product-intro-button">Tổng quan về sản phẩm</button>
			<button class="hn-tab hn-product-info-button active">Thông số kỹ thuật</button>
			<div class="hn-tab-content hn-product-intro"  style="display:none">
				<?php the_field('tong_quan_ve_san_pham');?>
			</div>
			<div class="hn-tab-content hn-product-info">
				<p>
				<?php the_field('thong_so_ky_thuat');?>
				</p>
			</div>
		</section>
		<?php endwhile;?>
		<?php endif;?>
				
		<?php
			global $post;
			$currentPostID = $post->ID;
			$categories = get_the_category($post->ID);
			$relatedCat = null;
			foreach($categories as $category) {
				if($category->slug != 'noi_bat') {
					$relatedCat = $category;
					break;
				}
			}
		?>
		<?php if(!empty($relatedCat)):?>
		
		<?php 
			global $post;
			$args = array( 'numberposts' => 4, 'offset'=> 0, 'category' => $relatedCat->cat_ID );
			$myposts = get_posts( $args );
		?>
		<?php if(sizeof($myposts) > 0): ?>
			<section class="clearfix product-related">
				<div class="section-title">
				<h1>SẢN PHẨM CÙNG LOẠI</h1>
				</div>
				<?php $index = 0; ?>
				<?php foreach( $myposts as $post ) :	setup_postdata($post);?>
				<?php if(get_the_ID() == $currentPostID) continue;
					$index++;
					if($index == 4) break;
					?>
					<div class="hn-product-item-short">
					<h1><?php the_title();?></h1>
					<img src="<?php bloginfo('template_directory')?>/images/contents/product-thumbnail.jpg" alt="Products" />
					<p><a href="<?php the_permalink();?>">[chi tiết...]</a></p>
					</div>
				<?php endforeach; ?>	
			
		</section>
		<?php endif?>
		<?php endif?>
	</div>
		

</div>

<div class="clear"></div>

<?php get_footer(); ?>