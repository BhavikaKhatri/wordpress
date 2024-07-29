<?php
// sort products by parent variable product's stock quantity

add_action( 'pre_get_posts', 'custom_sort_by_parent_stock' );
/**
 * Custom sorting function to sort products by parent variable product's stock quantity.
 *
 * @param WP_Query $query The WooCommerce main query.
 */
function custom_sort_by_parent_stock( $query ) {
    // Check if we are not in the admin area and it's the main query.
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'product' ) && ! is_tax( array( 'product_cat', 'product_tag' ) ) ) {
        return;
    }

    // Add custom join to the query to access parent product's stock quantity.
    add_filter( 'posts_join', 'custom_sort_posts_join' );
    // Add custom orderby to sort by parent product's stock quantity.
    add_filter( 'posts_orderby', 'custom_sort_posts_orderby' );
}

/**
 * Custom join function to add parent product's stock quantity to the query.
 *
 * @param string $join The SQL JOIN clause.
 * @return string Modified SQL JOIN clause.
 */
function custom_sort_posts_join( $join ) {
    global $wpdb;

    // Join the postmeta table to get the stock quantity of the parent product.
    $join .= " LEFT JOIN $wpdb->postmeta AS parent_meta ON ($wpdb->posts.ID = parent_meta.post_id AND parent_meta.meta_key='_stock')";
    
    return $join;
}

/**
 * Custom orderby function to sort products by parent product's stock quantity.
 *
 * @param string $orderby The SQL ORDER BY clause.
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
