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
        <label for="가격">가격</label>
      </th>
      <td>
        <input type="number" id="가격" class="regular-text" name="가격"> 원
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="출간일">출간일</label>
      </th>
      <td>
        <input type="date" id="출간일" class="regular-text" name="출간일">
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="페이지수">페이지수</label>
      </th>
      <td>
        <input type="number" id="페이지수" class="small-text" name="페이지수"> 페이지
      </td>
    </tr>
    <tr>
      <th scope="row">
        <label for="출력순서">출력순서</label>
      </th>
      <td>
        <input type="number" id="출력순서" class="small-text" name="출력순서">
      </td>
    </tr>
  </table>
  <?
}





