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

  register_taxonomy('book-author', 'book', $args);


  $labels_translator = array(
    'name' => '번역자',
    'singular_name' => '번역자',
    'search_items' => '번역자 검색',
    'popular_items' => '많이 쓴 번역자',
    'all_items' => '번역자 목록',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => '번역자 수정', 
    'view_item' => '번역자 보기',
    'update_item' => '저장',
    'add_new_item' => '번역자 추가',
    'new_item_name' => '새 번역자 이름',
    'separate_items_with_commas' => '여러 명 입력하려면 쉽표(,)로 구분하세요',
    'add_or_remove_items' => '번역자 추가 혹은 삭제',
    'choose_from_most_used' => '많이 쓴 번역자 중 선택',
    'not_found' => '번역자가 없습니다',
    'menu_name' => '번역자',
  );

  $args = array('labels'=>$labels_translator);

  register_taxonomy('translator', 'book', $args);


  $labels_book_subject = array(
    'name' => '주제 분류',
    'singular_name' => '주제 분류',
    'search_items' => '주제 분류 검색',
    'all_items' => '주제 분류 목록',
    'parent_item' => '부모 주제',
    'parent_item_colon' => '부모 주제:',
    'edit_item' => '주제 분류 수정',
    'view_item' => '주제 분류 보기',
    'update_item' => '저장',
    'add_new_item' => '주제 분류 추가',
    'new_item_name' => '주제 분류명',
    'not_found' => '주제 분류가 없습니다',
    'menu_name' => '주제 분류',
  );

  $args = array(
    'labels' => $labels_book_subject,
    'hierarchical' => TRUE,
  );

  register_taxonomy('book-subject', 'book', $args);


  $args = array(
    'label' => '신간 여부',
    'hierarchical' => TRUE,
  );
  register_taxonomy('new-book', 'book', $args);


  $args = array(
    'label' => '추천 책 여부',
    'hierarchical' => TRUE,
  );
  register_taxonomy('recommend-book', 'book', $args);
  
}
add_action('init', 'mpub_custom_taxonomy');