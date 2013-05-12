<?
//===== book custom post type =====

function mpub_custom_post_type() {
  $args = array(
    'label' => "책",
    'public' => true,
    'has_archive' => true,
  );

  register_post_type( 'book', $args );
}
add_action( 'init', 'mpub_custom_post_type' );