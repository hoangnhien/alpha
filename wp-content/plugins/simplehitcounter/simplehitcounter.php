<?php
/*
Plugin Name: Simple Hit Counter
Plugin URI: http://jungwirths.com/2009/03/simple-wordpress-hit-counter-plugin/
Description: Prints a count of the number of hits your blog has received, tracked in the database.
Version: 1.0
Author: Paul A Jungwirth
Author URI: http://jungwirths.com/
*/
/*
Copyright 2009  Paul A Jungwirth  (email: once@9stmaryrd.com)

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
global $wpdb, $simplehitcounter_table_name;
if (!function_exists("get_option")) {simplehitcounter_readme();die;}

// Edit this line if you want to use a different MySQL table name:
$simplehitcounter_table_name = $wpdb->prefix . "simplehitcounter_hits";

// Increments the database by one and returns the total number of hits to date.
function simplehitcounter_hit() {
	global $wpdb, $simplehitcounter_table_name;
	$thesite = get_option('siteurl');
	$wpdb->query("UPDATE $simplehitcounter_table_name SET hit_count = hit_count + 1 WHERE site = '$thesite'");
	return $wpdb->get_var("SELECT hit_count FROM $simplehitcounter_table_name WHERE site = '$thesite'");
}

// Prints an error message.
function simplehitcounter_readme() {
	echo '<br><strong>Something is wrong with Simple Hit Counter!</strong><br>';
}

// Installs the plugin.
function simplehitcounter_install() {
	global $wpdb, $simplehitcounter_table_name;
	$thesite = get_option('siteurl');
	if ($wpdb->get_var("SHOW TABLES LIKE '$simplehitcounter_table_name'") != $simplehitcounter_table_name) {
		$wpdb->query("CREATE TABLE $simplehitcounter_table_name (
			site TEXT NOT NULL,
			hit_count INT NOT NULL
		)");
		$wpdb->query("INSERT INTO $simplehitcounter_table_name (site, hit_count) VALUES ('$thesite', 0)");
		add_option("simplehitcounter_db_version", "1.0");
	}
}

register_activation_hook(__FILE__, "simplehitcounter_install");

?>
