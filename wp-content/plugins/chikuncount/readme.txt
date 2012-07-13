=== Plugin Name ===
Contributors: LoONeYChIKuN
Tags: hit counter, hits, hitcounter
Requires at least: 2.0.2
Tested up to: 2.8.4
Stable tag: 1.1

Easy to use hit counter that supplies various reporting with CSV files!

== Description ==

ChikunCount provides an easy to use hit counter.  Reporting is made easy with ChikunCount; all reports are export in CSV format, and live statistics are provided via Flash charts!

* Provides hit counter for total hits on your blog!
* Provides hit counter for each blog / page on your site!

Reporting features:
* Total hits on your blog by day, week, month, year
* Unique visitors on your blog by day, week, month, year
* Total hits for each individual blog
* Browsers used to view your site
* Flash charts for live statistics!

Reporting features to come:
* What sites direct people to your site
* And more!

Be sure to visit [TheChikun](http://www.thechikun.com) for upcoming plugins and other random code stuffs!

== Installation ==

1. Unzip `chikuncount.zip` to your `wp-content/plugins` directory
1. Activate via plugin manager

There are two template functions available to you from ChikunCount.

Add `<?php echo chikuncount(); ?>` anywhere in your template to get a formatted number of hits for your site. (`<?php echo chikuncount(false, false) ?>` to remove formatting.)

Add `<?php echo chikuncount(true); ?>` anywhere in your template to get a formatted number of hits on the current page / blog your viewing. (`<?php echo chikuncount(true, false) ?>` to remove formatting.)

== Screenshots ==

1. Reporting section of the admin panel.

== Changelog ==

= 1.3 =
* Removed the basic reporting stats and replaced them with live flash charts.
* Moved the location of ChikunCount reporting from Plugins section to Dashboard section.

= 1.1 =
* Added some basic live reporting on the admin panel
