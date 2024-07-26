# ACF Option Page Documentation

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)
- [Example](#example)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Introduction

This documentation provides a guide to setting up and using an ACF Option Page in your WordPress site. The ACF Option Page allows you to create custom global settings for your site that can be managed through the WordPress admin panel.

## Installation

To get started, ensure you have the following prerequisites:

1. **WordPress**: Make sure you have WordPress installed and running.
2. **Advanced Custom Fields (ACF) Pro**: Install and activate the ACF Pro plugin.

You can install ACF Pro from your WordPress admin dashboard or via Composer:

```bash
composer require advanced-custom-fields/advanced-custom-fields-pro
Setup
Follow these steps to set up an ACF Option Page:

Add the Option Page Code: Add the following code to your theme's functions.php file or a custom plugin file.
php
Copy code
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}
Create ACF Fields: Go to the WordPress admin panel and navigate to Custom Fields > Add New. Create a new field group and set the location to show on the options page.
Usage
After setting up the ACF Option Page, you can use the fields defined in the options page throughout your theme.

To retrieve a value from the options page, use the following code:

php
Copy code
$value = get_field('your_field_name', 'option');
echo $value;
Replace 'your_field_name' with the actual field name you've defined.

Example
Here’s an example of how to set up and use an ACF Option Page:

Setup Code: Add the following to your functions.php file:
php
Copy code
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}
Create Fields: In the WordPress admin panel, create fields like header_logo and footer_text.

Retrieve Values:

php
Copy code
// In your header.php file
$header_logo = get_field('header_logo', 'option');
echo '<img src="' . $header_logo . '" alt="Header Logo">';

// In your footer.php file
$footer_text = get_field('footer_text', 'option');
echo '<p>' . $footer_text . '</p>';
Troubleshooting
If you encounter issues with the ACF Option Page:

Fields Not Showing: Ensure you've correctly set the location rules for the field group to show on the options page.
Values Not Saving: Check for JavaScript errors in the browser console that might indicate conflicts with other plugins.
Capabilities: Ensure the user role has the correct capabilities to view and edit the options page.
Contributing
Contributions are welcome! Please submit a pull request or open an issue to discuss improvements or fixes.
```
