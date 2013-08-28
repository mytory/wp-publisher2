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

    // .cover-preview가 클릭됐을 때 클릭된 위치에 .js-remove-cover가 있다면 함수를 실행한다.
    $('.cover-preview').on('click', '.js-remove-cover', function(e){

        // 클릭된 놈의 기본 기능을 막는다. (여기서는, 링크 이동을 막게 된다.)
        e.preventDefault();

        // input을 비우고 프리뷰 내용도 비운다.
        $('#cover-id').val('');
        $('.cover-preview').html('');
    });

});
