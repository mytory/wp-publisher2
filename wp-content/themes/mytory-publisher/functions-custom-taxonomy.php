<?
function mpub_custom_taxonomy(){
    register_taxonomy('author', 'book');
}
add_action('init', 'mpub_custom_taxonomy');