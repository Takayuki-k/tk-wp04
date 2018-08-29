<?php
//wordpressフォーマット
include 'original_format.php';
//クイックタグ関係の関数
include 'tiny_mce/original_tiny_mce.php';

// メインコンテンツの幅を指定
if ( ! isset( $content_width ) ) $content_width = 1000;

//デフォルトのjQueryを読み込まない
function my_delete_local_jquery() {
    wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

//スタイルシートとスクリプト
function my_script() {
  /* style */
    wp_enqueue_style('normalize', '//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css', null, 'all');
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', null, 'all');
    wp_enqueue_style('gridlex', '//cdnjs.cloudflare.com/ajax/libs/gridlex/2.7.1/gridlex.min.css', null, 'all');
    wp_enqueue_style('qtags', get_template_directory_uri().'/tiny_mce/qtags-style.css', null, 'all');
    wp_enqueue_style('style', get_stylesheet_uri(), null, 'all');
  /* script */
    wp_enqueue_script( 'jquery-2', '//code.jquery.com/jquery-2.2.4.min.js', null);
    wp_enqueue_script( 'smooth', get_template_directory_uri().'/js/smooth.js', null);
}
add_action('wp_enqueue_scripts','my_script');

//プラグインのCSSを削除
function my_delete_plugin_files() {
    wp_dequeue_style('contact-form-7');
}
add_action( 'wp_enqueue_scripts', 'my_delete_plugin_files' );

//カテゴリーメタディスクリプション用の説明文を取得
function get_meta_description_from_category(){
  $cate_desc = trim( strip_tags( category_description() ) );
  if ( $cate_desc ) {//カテゴリ設定に説明がある場合はそれを返す
    return $cate_desc;
  }
  $cate_desc = '「' . single_cat_title('', false) . '」の記事一覧です。' . get_bloginfo('description');
  return $cate_desc;
}

// カスタムメニューを有効化
add_theme_support( 'menus' );

// カスタムメニューの「場所」を設定
register_nav_menus( array(
  'header-navi' => 'ヘッダーのナビゲーション',
) );

// サイドバーウィジットを有効化
register_sidebar( array(
  'name' => 'サイドバーウィジット',
  'id' => 'sidebar',
  'description' => 'サイドバーのウィジットエリアです。',
  'before_widget' => '<div class="widget">',
  'after_widget' => '</div>',
  'before_title' => '<p class="bold">',
  'after_title' => '</p>',
));

// 字数を60文字に指定する
function my_excerpt_mblength($length) {
  return 60;
}
add_filter('excerpt_mblength', 'my_excerpt_mblength');

// 本文からの抜粋末尾の文字列を指定する
function my_auto_excerpt_more($more) {
  return '・・・';
}
add_filter('excerpt_more', 'my_auto_excerpt_more');

// 抜粋末尾に個別投稿ページへのリンクを追加する
function my_custom_excerpt_more($excerpt) {
  return $excerpt . '<a href="' . get_permalink($post->ID) . '" class="to-more">&gt;&gt;&ensp;記事へ移動する</a>';
}
add_filter('get_the_excerpt', 'my_custom_excerpt_more');

//アイキャッチのサイズを固定化
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 150, 80, true );
add_image_size( 'size', 150, 80, true );
add_image_size('small_thumbnail', 60, 60, true );
add_image_size('large_thumbnail', 150, 100, true );
add_image_size('pickup_thumbnail', 620, 100, true );

//アイキャッチ画像
function thumbnail_check( $post_id, $size='post-thumbnail' ) {
  if ( has_post_thumbnail() ){
    $thumb = get_the_post_thumbnail( $post_id, $size );
  } else {
    $thumb = '<img src="'.get_template_directory_uri().'/images/no-img.jpg">';
  }
  echo $thumb;
}

//search.phpにページを除外
function SearchFilter($query) {
  if ( !is_admin() && $query -> is_main_query() && $query-> is_search() ) {
    $query->set( 'post_type', 'post' );
  }
}
add_action( 'pre_get_posts','SearchFilter' );