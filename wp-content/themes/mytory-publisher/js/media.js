jQuery(document).ready(function($){

    var mpub_media_frame;

    $('.js-mpub-open-media').click(function(e){

        e.preventDefault();

        var attributes = {
            title: '표지 설정',
            library: {
                type: 'image'
            },
            button: {
                text: '표지로 설정'
            }
        };

        // 미디어 라이브러리 프레임 객체 생성, wp.media()의 결과를 두 변수에 할당.
        mpub_media_frame = wp.media.frames.mpub_media_frame = wp.media(attributes);

        // 이미지 선택시 실행할 js
        mpub_media_frame.on('select', function(){
            var attachment = mpub_media_frame.state().get('selection').first().toJSON();
            $('#cover-id').val(attachment.id);
    
            // ajax로 html을 구성해서 이미지 프리뷰를 넣는다.
            $.get(wp.ajax.settings.url, {
                attachment_id: attachment.id,
                action: 'mpub_print_cover_preview'
            }, function(data){
                $('.cover-preview').html(data);
            });
        });


        // 미디어 라이브러리 레이어 팝업을 연다
        mpub_media_frame.open();
    });
});