=== Lock Multisite User Account ===
Contributors: amydin
Tags: multisite, rest api, lock account, wordpress user accounts, lock user, users, block user, disable user
Requires at least: 4.3
Tested up to: 6.3.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Lock Multisite User Account plugin provides functionality to lock WordPress registered user accounts with REST API as well.

Install and activate plugin, go to Users page, select users you want to lock/unlock and then select the action from Bulk Actions drop down.

Take a look at our [github page](https://github.com/amydinsyahira/lock-multisite-user-account/) for the REST API documentation.

= REST API Authentication =

All endpoints require authentication from an existing WordPress user.
We suggest using JWT through something like [simple-jwt-login](https://wordpress.org/plugins/simple-jwt-login/).

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/lock-multisite-user-account` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= Can I add custom error message =
Not yet, will do it coming soon.

= What if I accidentally lock myself =
Logged in user can not lock himself, it will be skipped

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png

== Changelog ==

= 1.0.0 =
Bulk actions to lock / unlock user in multisite with REST API