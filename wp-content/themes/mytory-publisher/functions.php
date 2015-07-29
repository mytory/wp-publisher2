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
* 변수의 구성요소를 리턴받는다.
*/
function getPrintr($var, $title = NULL)
{
    $dump = '';
    $dump .=  '<div align="left">';
    $dump .=  '<pre style="background-color:#000; color:#00ff00; padding:5px; font-size:14px;">';
    if( $title )
    {
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
function printr($var, $title = NULL)
{
    $dump = getPrintr($var, $title);
    echo $dump;
}

/**
 * 변수의 구성요소를 출력하고 멈춘다.
 */
function printr2($var, $title = NULL)
{
    printr($var, $title);
    exit;
}

include 'functions-custom-post-type.php';