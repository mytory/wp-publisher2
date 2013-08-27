jQuery(document).ready(function($){

    var mpub_media_frame;

    $('.js-mpub-open-media').click(function(e){

        e.preventDefault();

        // 미디어 라이브러리 프레임 객체 생성, wp.media()의 결과를 두 변수에 할당.
        mpub_media_frame = wp.media.frames.mpub_media_frame = wp.media();

        // 미디어 라이브러리 레이어 팝업을 연다
        mpub_media_frame.open();
    });
});