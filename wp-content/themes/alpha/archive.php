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
		<div class="hn-category-title-block">
			<div class="hn-category-title">
				<img src="<?php bloginfo('template_directory')?>/images/icons/category-view-title.png" alt="Products" />
				<span>Trang chủ </span>&gt;
				
				<?php 
					$catId = get_query_var('cat');
					echo get_category_parents($catId, TRUE, ' &gt; ');
				?>
				
				
			</div>
			<div class="hn-category-filter">
				<nav class="pagination">
					<ul>
						<li><a href="#">&lt;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&gt;</a></li>
					</ul>
				</nav>
			</div>
			
		</div>
		<section class="clearfix">
			<?php 
			$catId = get_query_var('cat');
			$total = 0;
			if(have_posts()): while(have_posts()): the_post();
				$total++;
			endwhile;
			endif;
			wp_reset_query();
			
			if($total <=3 ) $iFirstLastLine = 0;
			else $iFirstLastLine = ((int)($total / 3))*3 + 1;
			?>
			<?php $i = 1; ?>
			<?php if(have_posts()): while(have_posts()): the_post();?>
			<?php 
				$sPositionClass = "";
				if(($i % 3) == 0) $sPositionClass = " last-col";
				if($i >= $iFirstLastLine) $sPositionClass = $sPositionClass . " last-line";
				$i++;
			?>	
				<div class="hn-product-thumb clearfix <?php echo $sPositionClass; ?> ">
				<h1><a href="<?php the_permalink();?>" class="title"><?php thumb_title();?></a></h1>
				
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
	 			<img src="<?php echo $thumb?>" alt="product-thumb" width="90" height="90" />
				<div class="short-description">
					<?php short_content(get_field('short_description'), 100);?>
				</div>
				<a href="hoangnhien.net" class="view-more">[chi tiết&hellip;]</a>
			</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</section>
		<div class="hn-category-footer">
			<nav class="pagination">
					<ul>
						<li><a href="#">&lt;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&gt;</a></li>
					</ul>
				</nav>
		</div>
	</div>
	

</div>

<div class="clear"></div>

<?php get_footer(); ?>