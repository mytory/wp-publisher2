<?
//===== book custom post type =====

function mpub_custom_post_type() {

  $labels = array(
    'name' => '책',
    'singular_name' => '책',
    'add_new' => '책 추가',
    'add_new_item' => '책 추가',
    'edit_item' => '책 수정',
    'new_item' => '책 추가',
    'all_items' => '책 목록',
    'view_item' => '책 상세 보기',
    'search_items' => '책 검색',
    'not_found' =>  '등록된 책이 없습니다',
    'not_found_in_trash' => '휴지통에 책이 없습니다',
    'parent_item_colon' => '부모 책:',
    'menu_name' => '책',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_position' => 3,
  );

  register_post_type( 'book', $args );
}
add_action( 'init', 'mpub_custom_post_type' );