=== Simple Hit Counter ===
Contributors: pjungwir
Tags: counter
Requires at least: 2.7.1
Tested up to: 2.7.1
Stable tag: 1.0

Prints a count of the number of hits your blog has received, tracked in the 
database.

== Description ==

This is the simplest hit counter I could imagine (well, almost). Every time a 
page is requested, it adds one to the count. The display is not an image, just 
text. There is no javascript to hit some third-party server, no tracking, no 
distinction among pages: just an old-fashioned site counter CGI, implemented in 
WordPress. The plugin stores its count in its own MySQL table.

Once the plugin is installed (described below), you can display the count by 
putting code like this somewhere on your page:

    <?= simplehitcounter_hit(); ?>

That will both increment the counter and display its value. There is no method 
for getting the value without incrementing it. I suppose I could write such a 
thing if anyone likes.

There is a minor race condition. First the plugin updates the database by one 
(atomically), then it queries for the current count. Therefore in heavy traffic 
it is possible for two updates to happen before either select. In that case, 
the counter will correctly increment, but the number displayed may be the same 
for each user, representing the total page hits. As far as I can tell, this 
race condition is inevitable without locking the table. It seems trivial 
enough, though I guess you should be warned if you run a contest to give away a 
free car to the 1,000,000th user.

By default the plugin keeps its data in a table called `wp_simplehitcounter_hits`.
You can change this by editing the `simplehitcounter.php` file.

== Installation ==

Installing the plugin is easy and follows the standard steps:

1. Upload `simplehitcounter.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place `<?= simplehitcounter_hit(); ?>` somewhere like the footer or sidebar.

== Frequently Asked Questions ==

= Why did you write such a boring plugin? =

Why do you ask such boring questions?

= Why didn't you use the other plugin x? =

I looked around, but everything seemed too fancy. Besides, I wanted a chance to 
write my own WordPress plugin.

