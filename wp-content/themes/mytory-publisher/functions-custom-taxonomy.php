<?
//===== custom taxonomy =====

function mpub_custom_taxonomy(){

  $labels_author = array(
    'name' => '저자',
    'singular_name' => '저자',
    'search_items' => '저자 검색',
    'popular_items' => '많이 쓴 저자',
    'all_items' => '저자 목록',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => '저자 수정', 
    'view_item' => '저자 보기',
    'update_item' => '저장',
    'add_new_item' => '저자 추가',
    'new_item_name' => '새 저자 이름',
    'separate_items_with_commas' => '여러 명 입력하려면 쉽표(,)로 구분하세요',
    'add_or_remove_items' => '저자 추가 혹은 삭제',
    'choose_from_most_used' => '많이 쓴 저자 중 선택',
    'not_found' => '저자가 없습니다',
    'menu_name' => '저자',
  );

  $args = array('labels'=>$labels_author);

  register_taxonomy('author', 'book', $args);
}
add_action('init', 'mpub_custom_taxonomy');