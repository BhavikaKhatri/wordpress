<?php 
function my_ajax_handler() {
    check_ajax_referer('my_nonce', 'security');
    if (isset($_POST['data'])) {
        $data = sanitize_text_field($_POST['data']);
        echo 'Received: ' . $data;
    } else {
        echo 'No data received';
    }
    wp_die();
}
add_action('wp_ajax_my_action', 'my_ajax_handler');
add_action('wp_ajax_nopriv_my_action', 'my_ajax_handler');
?>