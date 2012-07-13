<?php
/*
Plugin Name: ChikunCounter
Plugin URI: http://www.thechikun.com
Description: An easy to use hit counter for you blog!
Version: 1.3
Author: LoONeYChIKuN
Author URI: http://www.thechikun.com
*/

/*  Copyright 2009  LoONeYChIKuN  (email : areenan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Installation section */
global $chikuncount_db_version;
$chikuncount_db_version = "1.0";

register_activation_hook(__FILE__, '_chikuncount_install');
function _chikuncount_install() {
	global $wpdb;
	global $chikuncount_db_version;

	$table = $wpdb->prefix . "chikuncounter";

	if($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
		// The table doesn't exist so we have to create it
		$create_sql = "CREATE TABLE `$table` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`ip` TEXT NOT NULL,
				`browser` TEXT,
				`page` TEXT NOT NULL,
				`host` TEXT NOT NULL,
				`time` DATETIME NOT NULL,
				UNIQUE KEY id (id)
				);";

		require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
		dbDelta($create_sql);

		add_option("chikuncount_db_version", $chikuncount_db_version);
	}
}
/* Done with Install section for now...Lets move to the dirty work and do admin later */

/* Worker stuffs */
add_action('get_header', '_chikuncount_updatehits');
function _chikuncount_updatehits() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// We'll just update our hitcounter
	$ip = $_SERVER['REMOTE_ADDR'];
        $host = strtolower($_SERVER['HTTP_HOST']);
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $page = $_SERVER['REQUEST_URI'];

	// Avoid apache dummy connections
	if($host == '' || $ip == '::1')
		return;

	// Ignore favicon and robots.txt
	if($page == '/favicon.ico' || $page == '/robots.txt')
		return;

	$sql = "INSERT INTO $table (ip, browser, page, host, time) VALUES ('$ip', '$browser', '$page', '$host', NOW());";

	$wpdb->query($sql);
}

// The function to be called from the template
function chikuncount($current = false, $format = true) {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// We're always going to need the host...Not sure if this is even applicable to a WP plugin
	// More investigation LAT0RZ!
	$host = strtolower($_SERVER['HTTP_HOST']);

	// Check if we're getting the current page
	if($current) {
		// We are, so build our SQL accordingly
		// Also going to need to know what page we're on
		$page = $_SERVER['REQUEST_URI'];
		$sql = "SELECT COUNT(ip) FROM $table WHERE host = '$host' AND page LIKE '$page';";
	}
	else
		$sql = "SELECT COUNT(ip) FROM $table WHERE host = '$host';";

	$result = $wpdb->get_var($sql);

	if($format)
		$result = number_format($result);

	return $result;
}

/* Done with Worker stuff...Admin coming next               **
** Admin section is going to consist basically of reporting */

// Allow us to add menu options
add_action('admin_menu', '_chikuncount_create_admin_hooks');
function _chikuncount_create_admin_hooks() {
	// The subpage for reporting
	add_submenu_page('index.php', 
		'ChikunCount Reporting', 'ChikunCount', 'administrator', 'chikuncount-reporting', '_chikuncount_adminpage');
}

// Generate our "options" which is really just links
function _chikuncount_adminpage() {
?>
<div class="wrap">
	<h2>ChikunCount Reporting</h2>
	<div class="narrow" style="width:400px;margin-left:50px;float:left;">
		<script type="text/javascript" src="<?php echo plugins_url('chikuncount/swfobject.js'); ?>"></script>
		<script type="text/javascript">
			swfobject.embedSWF("<?php echo plugins_url('chikuncount/open-flash-chart.swf'); ?>", "hits-by-day", "450", "200", "9.0.0", "expressInstall.swf", {"data-file":"<?php echo urlencode(bloginfo('url') . '/wp-admin/index.php?chikuncount=sevendays-ofc');?>"});
			swfobject.embedSWF("<?php echo plugins_url('chikuncount/open-flash-chart.swf'); ?>", "browsers", "450", "250", "9.0.0", "expressInstall.swf", {"data-file":"<?php echo urlencode(bloginfo('url') . '/wp-admin/index.php?chikuncount=browsers-ofc');?>"});
		</script>
		<p>ChikunCount provides reporting for a number of stats in CSV format for easy graphing.  If you do not have a way of graphing CSV files, I recommend <a href="http://www.openoffice.org" target="_BLANK">OpenOffice.org</a> as it is free and very Excel like.</p>


		<h3 style="margin-bottom:2px;">Total Hits: <?php echo chikuncount(); ?></h3>
		<ul style="margin-left: 8px;">
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=totalhits-byday" target="_BLANK">By Day</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=totalhits-byweek" target="_BLANK">By Week</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=totalhits-bymonth" target="_BLANK">By Month</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=totalhits-byyear" target="_BLANK">By Year</a></li>
		</ul>

		<h3 style="margin-bottom:2px;">Unique Visitors: <?php echo _chikuncount_getUnique(); ?></h3>
		<ul style="margin-left: 8px;">
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=unique-byday" target="_BLANK">By Day</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=unique-byweek" target="_BLANK">By Week</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=unique-bymonth" target="_BLANK">By Month</a></li>
		<li><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=unique-byyear" target="_BLANK">By Year</a></li>
		</ul>

		<h3><a href="<?php echo bloginfo('url'); ?>/wp-admin/index.php?chikuncount=hitsbyblog" target="_BLANK">Hits by Blog / Page</a></h3>
	</div>
	<div class="narrow" style="width:450px;float:right;text-align:right;">
		<h3 style="text-align:center;">Live Stats</h3>
		<div id="hits-by-day"></div>
		<div id="browsers"></div>
	</div>
</div>
<?php
}

// Live reporting functions
function _chikuncount_getPastSeven() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	$now = strtotime('-7 days');

	$sql = "SELECT COUNT(ip) FROM $table WHERE DATE(time) >= DATE(FROM_UNIXTIME($now));";

	$result = $wpdb->get_var($sql);

	$result = number_format($result);

	return $result;
}

function _chikuncount_getToday() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// We want to return how many hits we have today
	$now = time();

	$sql = "SELECT COUNT(ip) FROM $table WHERE DATE(time) = DATE(FROM_UNIXTIME($now));";

	$result = $wpdb->get_var($sql);

	$result = number_format($result);

	return $result;
}

function _chikuncount_getUnique() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// A total count of our unique visitors
	$uniq = $wpdb->get_var("SELECT COUNT(*) FROM (SELECT ip FROM $table GROUP BY ip) AS foo;");

	return number_format($uniq);
}

// Actions we have for reporting
// We want this priority 0 sense we're going to be playing with headers
add_action('admin_init', '_chikuncount_report', 0);

function _chikuncount_report() {
	if(isset($_GET['chikuncount'])) {
		// We want a report
		$chikunaction = $_GET['chikuncount'];

		switch($chikunaction) {
			// Total hits section
			case "totalhits-byday":
				_chikuncount_report_totalhits('day');
				break;
			case "totalhits-byweek":
				_chikuncount_report_totalhits('week');
				break;
			case "totalhits-bymonth":
				_chikuncount_report_totalhits('month');
				break;
			case "totalhits-byyear":
				_chikuncount_report_totalhits('year');
				break;

			// Hits by blog
			case "hitsbyblog":
				_chikuncount_report_byblog();
				break;

			// Unique visitors
			case "unique-byday":
				_chikuncount_report_unique('day');
				break;
			case "unique-byweek":
				_chikuncount_report_unique('week');
				break;
			case "unique-bymonth":
				_chikuncount_report_unique('month');
				break;
			case "unique-byyear":
				_chikuncount_report_unique('year');
				break;

			// Flash section
			case "sevendays-ofc":
				_chikuncount_report_totalhits_ofc();
				break;
			case "browsers-ofc":
				_chikuncount_report_browsers_ofc();
				break;
		}
	}
}

function _chikuncount_report_byblog() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	$sql = "SELECT COUNT(ip), page FROM $table GROUP BY page;";

	$result = $wpdb->get_results($sql, ARRAY_N);

	$output = '';

	foreach($result as $row) {
		$output .= $row[1] . ',' . $row[0] . "\r\n";
	}

	header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"hits-by-blog.csv\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".strlen($output));

        echo $output;

        die();
}

function _chikuncount_report_unique($type) {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// SQL is determined by $type
	switch($type) {
		case 'day':
			$sql = "SELECT COUNT(ip), DATE(time) FROM (SELECT ip, time FROM $table GROUP BY ip) as foo GROUP BY DATE(time);";
			$file = 'unique-by-day';
			break;
		case 'week':
			$sql = "SELECT COUNT(ip), WEEK(time) FROM (SELECT ip, time FROM $table GROUP BY ip) as foo GROUP BY WEEK(time);";
			$file = 'unique-by-week';
			break;
		case 'month':
			$sql = "SELECT COUNT(ip), MONTH(time) FROM (SELECT ip, time FROM $table GROUP BY ip) as foo GROUP BY MONTH(time);";
			$file = 'unique-by-month';
			break;
		case 'year':
			$sql = "SELECT COUNT(ip), YEAR(time) FROM (SELECT ip, time FROM $table GROUP BY ip) as foo GROUP BY YEAR(time);";
			$file = 'unique-by-year';
			break;
	}

	$result = $wpdb->get_results($sql, ARRAY_N);

	$output = '';

	foreach($result as $row) {
		$output = $row[1] . ',' . $row[0] . "\r\n";
	}

	header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"hits-by-blog.csv\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".strlen($output));

	echo $output;

	die();
}

function _chikuncount_report_totalhits_ofc() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	$now = strtotime('-7 days');

	// Get our SQL results first, then lets build the chart
	$sql = "SELECT COUNT(ip), DATE(time) FROM $table WHERE DATE(time) >= DATE(FROM_UNIXTIME($now)) GROUP BY DATE(time);";

	$result = $wpdb->get_results($sql, ARRAY_N);

	// Now that we have that, lets worry about building the chart
	require_once(dirname(__FILE__) . '/php-ofc-library/open-flash-chart.php');

	// Init our data / label
	$data = array();
	$labels = array();

	$maxy = 0;

	foreach($result as $row) {
		if($row[0] > $maxy)
			$maxy = $row[0];
		$data[] = (int)$row[0];
		// Strip the year out...its the past 7 days, I think they'll get it
		$labels[] = substr($row[1], 5);
	}

	$title = new title("Hits - Past 7 Days");
	$title->set_style('font-weight:bold; padding-bottom:7px; font-size:18px;color:#093E56');

	$area = new area();
	$area->set_default_dot_style(new hollow_dot());
	$area->set_fill_colour('#093E56');
	$area->set_fill_alpha(0.4);
	$area->set_values($data);
	$area->set_width(2);
	$area->on_show(new line_on_show('pop-up', 2, 0.5));
	
	$x_axis = new x_axis();
	$x_axis->set_labels_from_array($labels);
	$x_axis->set_colours('#000000','#000000');

	$y_axis = new y_axis();
	$y_axis->set_range(0, $maxy, ceil($maxy / 6));
	$y_axis->set_colours('#093E56','#093E56');
	$y_axis->set_offset(false);

	$chart = new open_flash_chart();

	$chart->set_title($title);
	$chart->set_y_axis($y_axis);
	$chart->set_x_axis($x_axis);
	$chart->add_element($area);
	$chart->set_bg_colour("#f5f4ef");

	echo $chart->toPrettyString();

	die();
}

function _chikuncount_report_browsers_ofc() {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// We need to grab total hits, then each for msie, firefox, opera, chrome
	$total = $wpdb->get_var("SELECT COUNT(browser) FROM $table;");
	$msie = $wpdb->get_var("SELECT COUNT(browser) FROM $table WHERE browser LIKE '%msie%';");
	$firefox = $wpdb->get_var("SELECT COUNT(browser) FROM $table WHERE browser LIKE '%firefox%';");
	$opera = $wpdb->get_var("SELECT COUNT(browser) FROM $table WHERE browser LIKE '%opera%';");
	$chrome = $wpdb->get_var("SELECT COUNT(browser) FROM $table WHERE browser LIKE '%chrome%';");

	$other = $total - ($msie + $firefox + $opera + $chrome);

	// Lets start building our charts
	require_once(dirname(__FILE__) . '/php-ofc-library/open-flash-chart.php');

	$title = new title("Browsers");
	$title->set_style('font-weight:bold; font-size:18px; color:#093E56');

	$pie = new pie();
	$pie->set_alpha(0.6);
	$pie->set_start_angle(27);
	$pie->add_animation(new pie_fade());
	$pie->set_tooltip("#percent# of 100%");
	$pie->set_colours(array('#0000CC','#FF6600','#CC0000','#00CC00','#4B0082'));
	$pie->set_values(array(
		new pie_value((int)$msie, "IE"),
		new pie_value((int)$firefox, "Firefox"),
		new pie_value((int)$opera, "Opera"),
		new pie_value((int)$chrome, "Chrome"),
		new pie_value((int)$other, "Other")));

	$chart = new open_flash_chart();
	$chart->set_title($title);
	$chart->add_element($pie);
	$chart->set_bg_colour("#f5f4ef");
	$chart->x_axis = null;

	echo $chart->toPrettyString();

	die();
}		

function _chikuncount_report_totalhits($type) {
	global $wpdb;

	$table = $wpdb->prefix . 'chikuncounter';

	// Build our sql based on what our type is
	switch($type) {
		case 'day':
			$sql = "SELECT COUNT(ip), DATE(time) FROM $table GROUP BY DATE(time);";
			$file = 'total-hits-by-day';
			break;
		case 'week':
			$sql = "SELECT COUNT(ip), WEEK(time) FROM $table GROUP BY WEEK(time);";
			$file = 'total-hits-by-week';
			break;
		case 'month':
			$sql = "SELECT COUNT(ip), MONTH(time) FROM $table GROUP BY MONTH(time);";
			$file = 'total-hits-by-month';
			break;
		case 'year':
			$sql = "SELECT COUNT(ip), YEAR(time) FROM $table GROUP BY YEAR(time);";
			$file = 'total-hits-by-year';
			break;
	}

	$output = '';

	$result = $wpdb->get_results($sql, ARRAY_N);

	foreach($result as $row) {
		$output .= $row[1] . ',' . $row[0] . "\r\n";
	}

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$file.csv\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".strlen($output));

	echo $output;

	die();
}
?>
