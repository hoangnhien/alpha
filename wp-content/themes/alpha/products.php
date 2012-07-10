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
	<div class="hn-widget">
		<h1>
			<img src="<?php bloginfo('template_directory')?>/images/icons/widget-title.png" alt="Products" />
			DANH MỤC SẢN PHẨM
		</h1>
		<section>
		<p>MTXT - Laptop</p>
		<ul>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
		</ul>
		</section>
	</div>
	<div class="hn-widget">
		<h1>
			<img src="<?php bloginfo('template_directory')?>/images/icons/widget-title.png" alt="Products" />
			SẢN PHẨM NỔI BẬT
		</h1>
		<section>
		<p>MTXT - Laptop</p>
		<ul>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
			<li>Laptop HP</li>
		</ul>
		</section>
	</div>
</div>

<div id="right-contain">
	<div id="top-banner">
		<img src="<?php bloginfo('template_directory')?>/images/banner.jpg" alt="top banner" />
	</div>
	<div class="hn-category-view">
		<div class="hn-category-title-block">
			<div class="hn-category-title">
				<img src="<?php bloginfo('template_directory')?>/images/icons/category-view-title.png" alt="Products" />
				MTTX-LAPTOP
				<a href="hoangnhien.net">&gt;&gt; xem tất cả</a>
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
			$total = 8;
			$iFirstLastLine = $total - (int)($total / 3);
			?>
			<?php for($i == 0; $i < $total; $i++): ?>
			<?php 
				$sPositionClass = "";
				if(($i % 3) == 2) $sPositionClass = " last-col";
				if($i >= $iFirstLastLine) $sPositionClass = $sPositionClass . " last-line";
			?>	
				<div class="hn-product-thumb clearfix <?php echo $sPositionClass; ?> ">
				<a href="hoangnhien.net" class="title">HP PAVILIO G4-1314TU (A9M54PA)</a>
				<img src="<?php bloginfo('template_directory')?>/images/contents/product-thumbnail.jpg" alt="Products" />
				<p>
				Intel® Core™ Core i5-2450M (2.5Ghz/3MB/1066Mhz) - HDD 640GB SATA - 2 GB RAM DDR3
				</p>
				<a href="hoangnhien.net" class="view-more">[chi tiết&hellip;]</a>
			</div>
			<?php endfor; ?>
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