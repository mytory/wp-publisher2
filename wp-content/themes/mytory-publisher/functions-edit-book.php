<?
// 책 수정 페이지에 추가 메타 박스 등록
add_action( 'add_meta_boxes', 'mpub_meta_box' );

/**
 * 책 메타 박스 정보를 등록
 */
function mpub_meta_box() {
  add_meta_box(
    'book-detail',
    '책 상세 정보',
    'mpub_book_meta_box_inner',
    'book'
  );
}

/**
 * 책 상세 정보 메타 박스 내용 출력
 * @param  Object $post
 */
function mpub_book_meta_box_inner($post) {

  // action쪽 스팸/해킹 방지용 input hidden field
  wp_nonce_field( 'save_book_action', 'book_detail_nonce' );
  ?>
  <table class="form-table">
    <tr>
      <th scope="row">
        <label for="표지">표지</label>
      </th>
      <td>
        <a href="#" class="button js-mpub-open-media" id="표지">표지 설정</a>
        <div class="cover-preview"></div>
        <input type="text" name="cover_id" id="cover-id">
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="가격">가격</label>
      </th>
      <td>
        <input type="number" id="가격" class="regular-text" name="가격"
            value="<?=get_post_meta($post->ID, '가격', true)?>"> 원
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="isbn">ISBN</label>
      </th>
      <td>
        <input type="text" id="isbn" class="regular-text" name="isbn"
            value="<?=get_post_meta($post->ID, 'isbn', true)?>">
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="출간일">출간일</label>
      </th>
      <td>
        <input type="date" id="출간일" class="regular-text" name="출간일"
            value="<?=get_post_meta($post->ID, '출간일', true)?>">
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="페이지수">페이지수</label>
      </th>
      <td>
        <input type="number" id="페이지수" class="small-text" name="페이지수"
            value="<?=get_post_meta($post->ID, '페이지수', true)?>"> 페이지
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="출력순서">출력순서</label>
      </th>
      <td>
        <input type="number" id="출력순서" class="small-text" name="출력순서"
            value="<?=get_post_meta($post->ID, '출력순서', true)?>">
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="책_소개">책 소개</label>
      </th>
      <td>
        <? wp_editor(get_post_meta($post->ID, '책_소개', true), '책_소개') ?>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="목차">목차</label>
      </th>
      <td>
        <? wp_editor(get_post_meta($post->ID, '목차', true), '목차') ?>
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="저자_소개">저자 소개</label>
      </th>
      <td>
        <? wp_editor(get_post_meta($post->ID, '저자_소개', true), '저자_소개') ?>
      </td>
    </tr>
    <?
    $args = array(
      'nopaging' => TRUE,
      'post_type' => 'book',
      'post__not_in' => array($post->ID),
      'post_status' => 'publish',
    );

    // 아래 두 줄은 $books = get_posts($args); 와 같다.
    $the_query = new WP_Query($args);
    $books = $the_query->posts;
    ?>
    <tr>
      <th>함께 읽을 책</th>
      <td>
        <? 
        $read_together_books = get_post_meta($post->ID, '함께_읽을_책');
        foreach ($books as $key => $book) { ?>
          <div class="read-together">
            <input <? if_checked($book->ID, $read_together_books) ?> value="<?=$book->ID?>" type="checkbox" name="함께_읽을_책[]" id="함께_읽을_책_<?=$key?>">
            <label for="함께_읽을_책_<?=$key?>"><?=$book->post_title?></label>
          </div>
        <? } ?>
      </td>
    </tr>
  </table>
  <?
}

// 데이터 저장
add_action('save_post', 'mpub_save_bookdata');

/**
 * 책 편집 후 사용자 데이터를 저장한다.
 * @param  int $post_id
 */
function mpub_save_bookdata($post_id){

  if($_POST['post_type'] != 'book'){
    return;
  }
  if ( ! current_user_can('edit_post', $post_id)){
    return;
  }

  // nonce 필드 검사
  if ( ! isset( $_POST['book_detail_nonce'] ) || ! wp_verify_nonce($_POST['book_detail_nonce'], 'save_book_action')){
    return;
  }

  // 데이터 저장
  update_post_meta($post_id, '가격', $_POST['가격']);
  update_post_meta($post_id, 'isbn', $_POST['isbn']);
  update_post_meta($post_id, '출간일', $_POST['출간일']);
  update_post_meta($post_id, '페이지수', $_POST['페이지수']);
  update_post_meta($post_id, '출력순서', $_POST['출력순서']);
  update_post_meta($post_id, '책_소개', $_POST['책_소개']);
  update_post_meta($post_id, '목차', $_POST['목차']);
  update_post_meta($post_id, '저자_소개', $_POST['저자_소개']);

  delete_post_meta($post_id, '함께_읽을_책');
  if(isset($_POST['함께_읽을_책'])){
    foreach ($_POST['함께_읽을_책'] as $book_id) {
      add_post_meta($post_id, '함께_읽을_책', $book_id);
    }
  }
}

add_action('wp_ajax_mpub_print_cover_preview', 'mpub_print_cover_preview');
add_action('wp_ajax_nopriv_mpub_print_cover_preview', 'mpub_exit');

function mpub_print_cover_preview($attachment_id = NULL){
  if(empty($attachment_id)){
    $attachment_id = $_REQUEST['attachment_id'];
  }
  $preview_img = wp_get_attachment_image_src( $attachment_id, 'medium');
  $edit_link_url = get_edit_post_link($attachment_id);
  $original_img_src = wp_get_attachment_url($attachment_id);
  ?>
  <img src="<?=$preview_img[0]?>" alt="" class="cover-preview__img">
  <a href="<?=$edit_link_url?>" target="_blank" class="cover-preview__edit-link">편집</a>
  |
  <a href="<?=$original_img_src?>" target="_blank" class="cover-preview__original-link">원본</a>
  <?
  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    die();
  }
}

function mpub_exit(){
  exit;
}

