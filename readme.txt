=== Splash Redirect ===
Contributors: husobj
Tags: home, splash, redirect
Requires at least: 3.2
Tested up to: 3.5.1
Stable tag: 1.0
License: GPLv2 or later

If you really must have a splash page for your website... This plugin uses JavaScript to redirect to a splash page.

== Description ==

If you really must have a splash page for your website...

This plugin uses JavaScript to redirect to a splash page when a user first visits your home page.
Go to the setting page and select a page from your site to act as the splash page.

= How it works =

When a user visits your home page the plugin will check if a cookie is set to indicate that the splash page has been viewed.

If there is no cookie set (and cookies are supported) the user will be redirected to your splash page. On the splash page a cookie will be set to remember that the user has seen the splash page.

You should include a link on your splash page to link to your home page or other page on you site.

The cookie will last for the during of the browsing session. If a user quits their browser and returns to the site they will see the splash page again.

== Installation ==

Install via the plugins section of your WordPress admin or upload to the 'wp-content/plugins' directory using FTP.

== Screenshots ==

1. Settings screen

== Frequently Asked Questions ==

= How can I set the splash page to only be shown once instead of once per session? =

Not currently supported but on the list for future enhancements.

= Can I set pages other than my home page to redirect to the splash page? =

Use the 'splash_redirect_is_redirect_page' filter to return true if viewing the page you want to redirect.

== Changelog ==

= 0.1 =
* Original version

== Upgrade Notice ==

= 0.1 =
Original version