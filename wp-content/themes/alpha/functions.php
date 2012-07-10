<?php
function add_themescript(){
    if(!is_admin()){
    wp_enqueue_script('jquery');
    wp_enqueue_script('thickbox',null,array('jquery'));
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
    }
 
}
add_action('init','add_themescript');

add_theme_support( 'post-thumbnails', array( 'page','post' ) );

function register_my_menus() {
  register_nav_menus(
    array( 'alpha-menu' => __( 'Alpha Menu' ))
  );
}
add_action( 'init', 'register_my_menus' );


// register side bar

register_sidebar( array(
	'name' => __( 'Left Sidebar', 'hoangnhien' ),
	'id' => 'left-sidebar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '<p style="display:none">',
	'after_title' => '</p>',
) );


/* show all gallery in album Vimmebbider - HARRY */
function getGallery($perPage = 2, $offset = 0) {
	global $wpdb;
	
	$albums = $wpdb->get_results("SELECT * FROM wp_ngg_album");
	//var_dump($albums);
	foreach ($albums as $key => $value) {
		if($key == 0) {
		$gallery = empty ($albums[$key]->sortorder) ? array() : (array) unserialize($albums[$key]->sortorder);
		
		} else break;
	}
	
	
	for($i = $offset; $i < sizeof($gallery); $i++) {
		/*
		$galleryInfo = $wpdb->get_results("SELECT `name` FROM `wp_ngg_gallery` WHERE `gid` = $gallery[$i]");
		if($galleryInfo != null){
			$galleryName = $galleryInfo[0]->name;
		}
		 
		 */
		if($i == $offset + $perPage) break;
		$galleryName = getGalleryName($gallery[$i]);
		?>
		<section>
			<div class="album-title">
				<img src="<?php bloginfo('template_directory')?>/images/album-list-style.png" alt="album list"/>
				<?php echo $galleryName ?>
				<a href="<?php bloginfo('home');?>/vimmeldiber/gallery/?gallery=<?php echo $gallery[$i]; ?>">VISA FLER</a>
			</div>
			<div class="album-thumbnail">
				<?php
					echo do_shortcode('[nggallery id='. $gallery[$i] .']');
				?>

				
			</div>
			<div class="clear"></div>
		</section>
		<?php
	}
	
	//$test = new nggdb();
	//$test->find_all_album();
	//$test->find_album(2);
	//var_dump($test);
}

function getNumOfGallery() {
	global $wpdb;
	
	$albums = $wpdb->get_results("SELECT * FROM wp_ngg_album");
	//var_dump($albums);
	$gallery = array();
	foreach ($albums as $key=>$value) {
		if($key == 0) {
		$gallery = empty ($albums[$key]->sortorder) ? array() : (array) unserialize($albums[$key]->sortorder);
		
		} else break;
	}
	return sizeof($gallery);
}
	


function getGalleryName($galleryId){
	global $wpdb;
	$galleryInfo = $wpdb->get_results("SELECT `name` FROM `wp_ngg_gallery` WHERE `gid` = $galleryId");
	if($galleryInfo != null){
		return $galleryInfo[0]->name;
	} else return "";
}

function getGalleryPagination($currentPage = 1, $perPage = 2) {
	?>
<?php $totalPage = ceil(getNumOfGallery()/$perPage); ?>
	<nav class="pagination top">
	<ul>
		<li class="prev <?php if($currentPage == 1) echo 'enable';?>">
			<?php if($currentPage == 1): ?>
			<a href="javascript:void(0);"></a>
			<?php else: ?>
			<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $currentPage-1;?>"></a>
			<?php endif;?>
		</li>
		
		<?php if($totalPage < 5):?>
			<?php for($i = 1; $i <= $totalPage; $i++): ?>
				<li <?php if($i == $currentPage) echo 'class="current-page"';?>>
				<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $i;?>"><?php echo $i; ?></a>
				</li>
			<?php endfor; ?>
		<?php else:?>
			<?php if($currentPage >= $totalPage - 2): ?>
				<?php for($i = $totalPage - 3; $i <= $totalPage; $i++): ?>
					<li <?php if($i == $currentPage) echo 'class="current-page"';?>>
						<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $i;?>"><?php echo $i;?></a>
					</li>
				<?php endfor; ?>
			<?php else: ?>
				<?php $first = $currentPage - 1; if($first < 1) $first = 1; ?>
				<?php for($i = $first; $i <= $first+2; $i++): ?>
					<li <?php if($i == $currentPage) echo 'class="current-page"';?>>
						<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $i;?>"><?php echo $i;?></a>
					</li>
				<?php endfor; ?>
				<li><a href="javascript:void(0);">&hellip;</a></li>
				<li <?php if($i == $currentPage) echo 'class="current-page"';?>>
						<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $totalPage;?>"><?php echo $totalPage;?></a>
				</li>
				
			<?php endif;?>
				
			
		<?php endif;?>
			
		<li class="next <?php if($currentPage == $totalPage) echo 'enable';?>">
			<?php if($currentPage == $totalPage): ?>
			<a href="javascript:void(0);"></a>
			<?php else: ?>
			<a href="<?php bloginfo('home');?>/vimmelbider/?page=<?php echo $currentPage+1;?>"></a>
			<?php endif;?>
		</li>
	</ul>
	</nav>
<?php } ?>
<?php
function get_page_id($pageSlug){
	$args=array(
		'name' => "$pageSlug",
		'post_type' => 'page'
	);
	$my_posts = get_posts($args);
	return $my_posts[0]->ID;

}
?>
<?php 
function wp_get_postcount($id)
{
//return count of post in category child of ID 15
$count = 0;
$taxonomy = 'category';
$args = array(
  'child_of' => $id,
);
$tax_terms = get_terms($taxonomy,$args);
foreach ($tax_terms as $tax_term) {
$count +=$tax_term->count;
}
return $count;
}
?>
<?php 
function short_title() {
	$mytitleorig = get_the_title();
	$title = html_entity_decode($mytitleorig, ENT_QUOTES, "UTF-8");

	$pad="...";
	$limit = "40";
	if(strlen($title) >= ($limit+3)) {
		$title = substr($title, 0, $limit) . $pad;
	}

	echo $title;
}
function thumb_title() {
	$mytitleorig = get_the_title();
	$title = html_entity_decode($mytitleorig, ENT_QUOTES, "UTF-8");
	
	$pad="...";
	$limit = "60";
	if(strlen($title) >= ($limit+3)) {
		$title = substr($title, 0, $limit) . $pad;
	}
	
	echo $title;
}
function short_content($content, $limit) {
	$content = html_entity_decode($content, ENT_QUOTES, "UTF-8");
	$pad = "...";
	if(strlen($content) >= ($limit+3)) {
		$content = substr($content,0, $limit) . $pad;
	}
	echo $content;	
}
?>
<?php 
function hn_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'hn_login_logo_url' );

function hn_login_logo_url_title() {
	return 'Alpha';
}
add_filter( 'login_headertitle', 'hn_login_logo_url_title' );
function hn_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/admin-logo.png);
            padding-bottom: 30px;
 
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'hn_login_logo' );
?>