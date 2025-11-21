building-designer-plugin/
├── assets/
│   ├── css/
│   │   ├── admin.css
│   │   └── frontend.css
│   ├── js/
│   │   ├── admin.js
│   │   └── frontend.js
│   └── images/
│       ├── post-frame.jpg
│       └── ladder-frame.jpg
├── includes/
│   ├── Admin/
│   │   ├── Settings.php
│   │   └── MenuManager.php
│   ├── Core/
│   │   ├── Plugin.php
│   │   ├── Loader.php
│   │   ├── Activator.php
│   │   └── Deactivator.php
│   ├── Frontend/
│   │   ├── FormRenderer.php
│   │   └── ShortcodeHandler.php
│   ├── Models/
│   │   ├── Step.php
│   │   └── Option.php
│   └── Config/
│       ├── Steps.php
│       └── Options.php
├── building-designer-plugin.php
├── composer.json
├── README.txt
└── uninstall.php
















=== Building Designer ===
Contributors: yourname
Tags: building, designer, form, multi-step, construction
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional multi-step building designer form with dynamic image switching and OOP architecture.

== Description ==

Building Designer is a professional WordPress plugin that allows you to create a multi-step building configuration form similar to professional building design tools.

**Features:**

* Multi-step form with progress indicator
* Dynamic image switching based on user selections
* PSR-4 autoloading with OOP structure
* Easy to extend and customize
* AJAX form submission
* Email notifications
* Admin dashboard for viewing submissions
* Fully responsive design
* Clean, modular code structure

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/building-designer-plugin/`
2. Navigate to the plugin directory in terminal
3. Run `composer install` to generate autoloader
4. Activate the plugin through the 'Plugins' screen in WordPress
5. Use the shortcode `[building_designer]` on any page

== Frequently Asked Questions ==

= How do I add the form to a page? =

Simply add the shortcode `[building_designer]` to any page or post.

= How do I add new options? =

Edit the file `includes/Config/Options.php` and add your new options following the existing pattern.

= How do I add new form steps? =

Edit the file `includes/Config/Steps.php` and add your new steps.

= Where do I add images? =

Place your images in the `assets/images/` directory and reference them in the Options configuration.

== Screenshots ==

1. Multi-step form interface
2. Admin dashboard
3. Settings page

== Changelog ==

= 1.0.0 =
* Initial release
* Multi-step form functionality
* Dynamic image switching
* Admin dashboard
* Email notifications

== Upgrade Notice ==

= 1.0.0 =
Initial release.

== Usage ==

After activation, add the shortcode `[building_designer]` to any page where you want the form to appear.

**Customizing Options:**

1. Navigate to `includes/Config/Options.php`
2. Add or modify options in the respective methods
3. Add corresponding images to `assets/images/`

**Customizing Steps:**

1. Navigate to `includes/Config/Steps.php`
2. Add or modify steps in the `get_all_steps()` method

== Support ==

For support, please visit: https://yoursite.com/support

== Development ==

This plugin uses:
* PSR-4 Autoloading via Composer
* Object-Oriented Programming principles
* WordPress Coding Standards
* Modern JavaScript (ES6+)
















Quick Customization Guide
Adding New Options:
Edit includes/Config/Options.php - add to the relevant method:
phpnew Option('your_value', 'Your Label', 'your-image.jpg', 'Description')
Adding New Steps:
Edit includes/Config/Steps.php - add to get_all_steps():
phpnew Step('step_id', 'Step Title', 'Description', Options::get_your_options())
Adding Images:

Place images in assets/images/
Reference them in Options configuration
They'll automatically display when options are selected
