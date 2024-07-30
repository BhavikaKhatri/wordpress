<?php
/**
 * Custom Sorting for WooCommerce Products by Parent Variable Product's Stock Quantity
 *
 * This code snippet modifies the WooCommerce product query to sort products based on the stock quantity
 * of their parent variable product. This sorting is applied globally across the WooCommerce site.
 *
 * To use this code, add it to your theme's `functions.php` file or a custom plugin.
 *
 * @package WooCommerce
 * @since 1.0.0
 */

add_action( 'pre_get_posts', 'custom_sort_by_parent_stock' );

/**
 * Custom sorting function to sort products by parent variable product's stock quantity globally.
 *
 * This function hooks into the `pre_get_posts` action to modify the main query for WooCommerce product listings
 * so that products are sorted by their parent variable product's stock quantity.
 *
 * @param WP_Query $query The WooCommerce main query.
 */
function custom_sort_by_parent_stock( $query ) {
    // Ensure we are on the front-end and dealing with the main query for product archives.
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'product' ) && ! is_tax( array( 'product_cat', 'product_tag' ) ) ) {
        return;
    }

    // Add custom SQL JOIN to include parent product's stock quantity.
    add_filter( 'posts_join', 'custom_sort_posts_join' );
    // Add custom ORDER BY to sort by parent product's stock quantity.
    add_filter( 'posts_orderby', 'custom_sort_posts_orderby' );
}

/**
 * Custom SQL JOIN to add parent product's stock quantity to the query.
 *
 * This function adds a JOIN clause to the main query to include the stock quantity of the parent product,
 * which is used for sorting.
 *
 * @param string $join The current SQL JOIN clause.
 * @return string Modified SQL JOIN clause.
 */
function custom_sort_posts_join( $join ) {
    global $wpdb;

    // Join the postmeta table to get the stock quantity of the parent product.
    $join .= " LEFT JOIN $wpdb->postmeta AS parent_meta ON ($wpdb->posts.ID = parent_meta.post_id AND parent_meta.meta_key='_stock')";
    
    return $join;
}

/**
 * Custom SQL ORDER BY to sort products by parent product's stock quantity.
 *
 * This function modifies the ORDER BY clause to sort products based on the stock quantity of their parent
 * variable product in descending order.
 *
 * @param string $orderby The current SQL ORDER BY clause.
 * @return string Modified SQL ORDER BY clause.
 */
function custom_sort_posts_orderby( $orderby ) {
    global $wpdb;

    // Order by the parent product's stock quantity in descending order.
    $orderby = "CAST(parent_meta.meta_value AS UNSIGNED) DESC";

    // Remove the custom filters after they are applied to prevent affecting other queries.
    remove_filter( 'posts_join', 'custom_sort_posts_join' );
    remove_filter( 'posts_orderby', 'custom_sort_posts_orderby' );

    return $orderby;
}
