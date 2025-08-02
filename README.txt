=== Custom Pet Tag Generator ===
Contributors: michaelrafallo
Tags: customizer, pet tags, generator, engraving, WooCommerce
Requires at least: 5.0
Tested up to: 6.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A customizable pet tag generator for WooCommerce or standalone sites.

== Description ==

Custom Pet Tag Generator is a WordPress plugin that lets users design personalized pet ID tags using an interactive form. It supports live previews, real-time input for pet names and contact details, and export or WooCommerce checkout integration.

Ideal for pet shops, eCommerce sites, and engraving businesses.

**Features:**

* Live pet tag preview
* Name and phone number input fields
* Supports custom fonts and shapes
* WooCommerce product integration (optional)
* Export tag as image
* Mobile-friendly and fast

== Installation ==

1. Upload `custom-pet-tag-generator` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the `[pet_tag]` shortcode in a page or post to display the generator.
4. (Optional) Connect to WooCommerce products by assigning a product ID in the plugin settings.

== Frequently Asked Questions ==

= Can I use this without WooCommerce? =

Yes. The generator can function standalone or with WooCommerce for checkout.

= Can I customize the shapes or fonts? =

Absolutely! You can upload SVG shapes and custom fonts via the plugin settings.

= Is it mobile responsive? =

Yes, the generator scales to fit all screen sizes.

== Screenshots ==

1. Live preview of tag with name and phone number.
2. Backend settings for configuring default fonts and shapes.

== Changelog ==

= 1.0 =
* Initial release.
* form editor with name/phone input.
* WooCommerce integration.

== Upgrade Notice ==

= 1.0 =
First public release. Includes core features and WooCommerce support.

== Arbitrary section ==

**Developer Hooks**

You can hook into the generator output using:

```php
do_action('pet_tag_before_render');
do_action('pet_tag_after_render');
