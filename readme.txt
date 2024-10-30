=== Jannes & Mannes Google Analytics ===
Contributors: jannesmannes
Tags: google-analytics
Requires at least: 3.0.1
Tested up to: 4.9.6
Stable tag: 4.9.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds Google Analytics code to your website only if you are in production based on the Bedrock WP_ENV constant.

== Description ==

This plugin adds Google Analytics code to your website only if you are in production based on the Bedrock WP_ENV constant.

== Installation ==

1. Activate the plugin
2. Copy the Google Analytics UA code from your Google Analytics account
3. Go to the Google Analytics section in your dashboard, paste the UA code in the form field and save the settings page
4. You are done

== Frequently Asked Questions ==

= What is Bedrock? =

You can read all about Bedrock here: https://roots.io/bedrock/

= Why doesn the Google Analytics code show up in my source on my local environment? =

Make sure that you are using Bedrock and you have set the environment to "debug". The code shows only when the constant WP_ENV is defined and is set to "production".

== Changelog ==

= 1.3.0 =
Added option to disable pageview tracking

= 1.2.1 =
Cookie consent fix

= 1.2.0 =
Cookie consent fix

= 1.1.0 =
Cookie consent support

= 1.0.0 =
Feature: add Google Tag Manager integration

= 0.6 =
Set anonomize IP to true to comply to cookie laws

= 0.5 =
Google Optimize snippet implementation

= 0.4 =
We now use the alternative async tracking script provided by Google for modern browsers: https://developers.google.com/analytics/devguides/collection/analyticsjs/#alternative_async_tracking_snippet

= 0.3 =
Tested up to 4.7

= 0.2 =
Do not show tracking code if the current user can edit posts, e.g. the user is a website editor

= 0.1 =
This is the first version of the plugin.