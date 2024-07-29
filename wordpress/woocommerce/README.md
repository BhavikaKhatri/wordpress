Title: Custom Sorting for WooCommerce Products by Parent Variable Product's Stock Quantity

Description:

This code snippet customizes the WooCommerce product query to sort products based on the stock quantity of their parent variable product. It modifies the main query globally to ensure consistent sorting across all WooCommerce product listings, including shop pages, product categories, and tags.

Usage:

Add to Theme or Plugin:

Copy the code and paste it into your theme's functions.php file.
Alternatively, you can create a custom plugin and add the code to the plugin's main file.
Functionality:

The code hooks into the pre_get_posts action to modify the WooCommerce product query.
It adds a custom SQL JOIN to include the parent product's stock quantity.
It then modifies the ORDER BY clause to sort products by the parent product's stock quantity in descending order.
Details:

Hook: pre_get_posts

Used to modify the main query before it is executed.
Custom Join:

Adds a JOIN clause to include the parent product's \_stock meta value.
Custom Orderby:

Sorts products based on the parent product's stock quantity, converting the meta value to an unsigned integer for proper numerical sorting.
Notes:

Ensure this code is compatible with your theme and other customizations.
Test the sorting functionality thoroughly on your WooCommerce site.
This implementation affects product sorting on all product archives (shop page, product categories, and tags).
Feel free to adjust the documentation as needed to fit your specific use case or repository structure.
