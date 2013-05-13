<?
function mpub_custom_taxonomy(){
    $args = array('label'=>'저자');
    register_taxonomy('author', 'book', $args);
}
add_action('init', 'mpub_custom_taxonomy');