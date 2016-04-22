# SimpleWPPlugin

Very basic WordPress plugin framework

## Guide

This aims to be very basic and pretty much allow you to what you want to do and then hook into Wordpress later on. 

When programming just do the following: 

Anything you want that should be on the wp-admin side code wise put into `admin/admin.php` 

Anything you want that is going to be public facing put into `public/public.php`

Then define how those functions you've created in `admin/admin.php` and `public/public.php` should interact with WordPress in `includes/manager.php`

If for some reason I haven't defined one of the WordPress hooks you need you can easily add it in `includes/loader.php`


### Examples included

I've included some simple examples for instance: 

#### Short code

displayShortCodePage() in `public/public.php` loads `public/partials/display.php` 

That is then hooked to WordPress in `includes/manager.php` in definePublicHooks() 

User uses short code [simple-wp-plugin-shortcode] and the content in `display.php` will show.

#### Admin Settings Page

adminSettingsPage() in `admin/admin.php` loads `admin/partials/settingsManager.php`
adminMenu() in `admin/admin.php` creates a link on the wp-admin menu for the page.

That is then hooked to WordPress in `includes/manager.php` in defineAdminHooks() 

Settings page will then have an option for Simple WP Plugin Settings which will load the content of `settingsManager.php`