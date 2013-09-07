<?php
/**
 * 모든 함수의 접두어는 mbt을 붙인다. mytory basic theme의 약자다.
 */
function mbt_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main-nav', '메인 내비게이션' );
	
	// 사이드바 세 개
	register_sidebar(array(
			'name' => '좌측',
			'id' => 'sidebar-left',
			'description' => '제일 왼쪽',
			'before_title' => '<h3 class="sidebar-title">',
			'after_title' => '</h3>'
			));
	register_sidebar(array(
			'name' => '가운데',
			'id' => 'sidebar-center',
			'description' => '가운데 위치',
			'before_title' => '<h3 class="sidebar-title">',
			'after_title' => '</h3>'
			));
	register_sidebar(array(
			'name' => '우측',
			'id' => 'sidebar-right',
			'description' => '제일 오른쪽',
			'before_title' => '<h3 class="sidebar-title">',
			'after_title' => '</h3>'
			));
}
add_action( 'after_setup_theme', 'mbt_setup' );

/**
 * initialize style and script
 */
function mbt_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Loads main stylesheet.
	 */
	wp_enqueue_style( 'mbt-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'mbt-ie', get_template_directory_uri() . '/style-ie.css', array( 'mbt-style' ) );
	$wp_styles->add_data( 'mbt-ie', 'conditional', 'lt IE 9' );
	
	/*
	 * common.js
	 */
	wp_enqueue_script('mbt-common', get_template_directory_uri() . '/js/common.js', array('jquery'), '', TRUE);
}
add_action( 'wp_enqueue_scripts', 'mbt_scripts_styles' );

/**
 * 관리자 화면용 CSS와 js
 */
function mpub_admin_scripts_styles(){
  
  // style
  wp_enqueue_style( 'mpub-admin', get_template_directory_uri() . '/admin.css');
  wp_enqueue_style( 'jquery-ui-smoothness', 'http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css');

  // script
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.input-date.js', 
      array(), FALSE, TRUE);
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_script('jquery-ui-datepicker-ko', get_template_directory_uri() . '/js/jquery.ui.datepicker-ko.js', 
      array('jquery-ui-datepicker'), FALSE, TRUE);
  wp_enqueue_script('mpub-admin', get_template_directory_uri() . '/js/admin.js', array('jquery'), 
      FALSE, TRUE);

  global $current_screen;
  if( isset( $current_screen->post_type ) && $current_screen->post_type == 'book'){
      wp_enqueue_script('mpub-media', get_template_directory_uri() . '/js/media.js', array( 'jquery' ), '', true );
  }
}
add_action('admin_enqueue_scripts', 'mpub_admin_scripts_styles');

/**
* 변수의 구성요소를 리턴받는다.
*/
function getPrintr($var, $title = NULL) {
    $dump = '';
    $dump .=  '<div align="left">';
    $dump .=  '<pre style="background-color:#000; color:#00ff00; padding:5px; font-size:14px;">';
    if($title) {
        $dump .=  "<strong style='color:#fff'>{$title} :</strong> \n";
    }
    $dump .= print_r($var, TRUE);
    $dump .=  '</pre>';
    $dump .=  '</div>';
    $dump .=  '<br />';
    return $dump;
}

/**
 * 변수의 구성요소를 출력한다.
 */
function printr($var, $title = NULL) {
    $dump = getPrintr($var, $title);
    echo $dump;
}

/**
 * 변수의 구성요소를 출력하고 멈춘다.
 */
function printr2($var, $title = NULL) {
    printr($var, $title);
    exit;
}

/**
 * input:checkbox, input:radio, select 에서, 현재 값을 표시해 줄 때, 현재 값이 저장된 값과 같은지 
 * 혹은 저장된 값들 중에 포함돼 있는지(checkbox의 경우) 확인하는 함수.
 * HTML 길이를 줄이기 위해 만든 거다.
 * @param  string       $current 현재 input의 value
 * @param  string|array $compare DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function if_equal_or_in($current, $compare){
  if(is_array($compare)){
    return in_array($current, $compare);
  }else{
    return $current == $compare;
  }
}

/**
 * input:checkbox나 input:radio 에서 값을 비교해 checked를 출력.
 * @param  string       $current 현재 input의 value
 * @param  string|array $compare DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function if_checked($current, $compare){
  if(if_equal_or_in($current, $compare)){
    echo 'checked';
  }
}

/**
 * select box 에서 값을 비교해 checked를 출력.
 * @param  string       $current 현재 select > option의 value
 * @param  string|array $compare DB에 저장된 값 혹은 값들의 배열
 * @return boolean
 */
function if_selected($current, $compare){
  if(if_equal_or_in($current, $compare)){
    echo 'selected';
  }
}

include 'functions-custom-post-type.php';
include 'functions-custom-taxonomy.php';
include 'functions-edit-book.php';
include 'functions-client.php';