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
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="hn-category-view">
		<div class="hn-category-title-block">
			<div class="hn-category-title">
				<img src="<?php bloginfo('template_directory')?>/images/icons/category-view-title.png" alt="Products" />
				MTTX-LAPTOP
				<a href="hoangnhien.net">&gt;&gt; xem tất cả</a>
			</div>
			<div class="hn-category-filter">
				<h1><?php the_title();?></h1>
			</div>
			
		</div>
		<section class="clearfix product-detail">
			<div class="hn-product-gallery">
				<img src="<?php bloginfo('template_directory')?>/images/contents/product-full.jpg" alt="Products" />
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
		<section class="clearfix product-related">
			<div class="section-title">
				<h1>SẢN PHẨM CÙNG LOẠI</h1>
			</div>
			<div class="hn-product-item-short">
				<h1>HP Pavilio G4-1314TU (A9M54PA)</h1>
				<img src="<?php bloginfo('template_directory')?>/images/contents/product-thumbnail.jpg" alt="Products" />
				<p><a href="#">[chi tiết...]</a></p>
			</div>
			
			<div class="hn-product-item-short">
				<h1>HP Pavilio G4-1314TU (A9M54PA)</h1>
				<img src="<?php bloginfo('template_directory')?>/images/contents/product-thumbnail.jpg" alt="Products" />
				<p><a href="#">[chi tiết...]</a></p>
			</div>
			
			<div class="hn-product-item-short">
				<h1>HP Pavilio G4-1314TU (A9M54PA)</h1>
				<img src="<?php bloginfo('template_directory')?>/images/contents/product-thumbnail.jpg" alt="Products" />
				<p><a href="#">[chi tiết...]</a></p>
			</div>
		</section>
		
	</div>
	<?php endwhile;?>
	<?php endif;?>
	

</div>

<div class="clear"></div>

<?php get_footer(); ?>