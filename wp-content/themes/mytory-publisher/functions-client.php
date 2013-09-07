<?
/**
 * 제목에서 소제목과 제목을 분리해서 리턴
 * @return array title과 subtitle을 가진 배열
 */
function mpub_get_the_title(){
    $post_title = get_the_title();
    
    echo var_dump($post_title);

    // &#8211;는 -의 htmlentity
    $post_title = str_replace('-', '&#8211;', $post_title);    
    
    $delimiter = '&#8211;';

    $temp = explode($delimiter, $post_title);

    foreach ($temp as $key => $str) {
        $temp[$key] = trim($str);
    }
    echo var_dump($temp);

    $titles = array(
        'title' => $temp[0],
        'subtitle' => '',
    );

    if(count($temp) == 2){
        $titles['title'] = $temp[1];
        $titles['subtitle'] = $temp[0];
    }else if(count($temp) > 2){
        $titles['subtitle'] = array_shift($temp);
        $titles['title'] = implode(" $delimiter ", $temp);
    }

    echo var_dump($titles);

    return $titles;
}