<?php //tiny_mce関係の関数

//ビジュアルエディターとテーマ表示のスタイルを合わせる
add_editor_style(get_template_directory_uri().'/tiny_mce/editor-style.css');

//tiny_mceフォーマット
function override_mce_options( $init_array ) {
  global $allowedposttags;
  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  $init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
  $init_array['indent']                  = true;
  $init_array['wpautop']                 = false;
  $init_array['force_p_newlines']        = false;
  return $init_array;
}
add_filter( 'tiny_mce_before_init', 'override_mce_options' );

//テキストエディタにクイックタグボタン追加
if ( !function_exists( 'add_quicktags_to_text_editor' ) ):
function add_quicktags_to_text_editor() {
  //スクリプトキューにquicktagsが保存されているかチェック
  if (wp_script_is('quicktags')){?>
    <script>
      QTags.addButton('qt-p','p','<p>','</p>');
      QTags.addButton('qt-br','改行','<br>');
      QTags.addButton('qt-red','赤字','<span class="red">','</span>');
      QTags.addButton('qt-bold-red','太い赤字','<span class="bold-red">','</span>');
      QTags.addButton('qt-red-under','赤アンダーライン','<span class="red-under">','</span>');
      QTags.addButton('qt-marker','黄色マーカー','<span class="marker">','</span>');
      QTags.addButton('qt-marker-under','黄色アンダーラインマーカー','<span class="marker-under">','</span>');
      QTags.addButton('qt-strike','打ち消し線','<span class="strike">','</span>');
      QTags.addButton('qt-ref','バッジ','<span class="ref">','</span>');
      QTags.addButton('qt-keyboard-key','キーボード','<span class="keyboard-key">','</span>');
      QTags.addButton('qt-muted-txt','文字グレー','<span class="text-muted">','</span>');
      QTags.addButton('qt-primary-txt','文字青','<span class="text-primary">','</span>');
      QTags.addButton('qt-success-txt','文字グリーン','<span class="text-success">','</span>');
      QTags.addButton('qt-info-txt','文字薄青','<span class="text-info">','</span>');
      QTags.addButton('qt-warning-txt','文字黄','<span class="text-warning">','</span>');
      QTags.addButton('qt-danger-txt','文字赤','<span class="text-danger">','</span>');
      QTags.addButton('qt-primary-bg','背景青','<span class="bg-primary">','</span>');
      QTags.addButton('qt-success-bg','背景グリーン','<span class="bg-success">','</span>');
      QTags.addButton('qt-info-bg','背景薄青','<span class="bg-info">','</span>');
      QTags.addButton('qt-warning-bg','背景黄','<span class="bg-warning">','</span>');
      QTags.addButton('qt-danger-bg','背景赤','<span class="bg-danger">','</span>');
      QTags.addButton('qt-black-bg','背景黒','<span class="bg-black">','</span>');
      QTags.addButton('qt-center','テキスト中央寄せ','<p class="text-center">','</p>');
      QTags.addButton('qt-right','テキスト右寄せ','<p class="text-right">','</p>');
      QTags.addButton('qt-left','テキスト左寄せ','<p class="text-left">','</p>');
      QTags.addButton('qt-max','最大幅','<div class="max">','</div>');
      QTags.addButton('qt-bold','大','<span class="bold">','</span>');
      QTags.addButton('qt-small','小','<span class="small">','</span>');
    </script>
  <?php
  }
}
endif;
add_action( 'admin_print_footer_scripts', 'add_quicktags_to_text_editor' );

//エディタのクイックタグのスタイルシートをカスタマイズ
function my_admin_style(){
    wp_enqueue_style( 'wp-qtags-admin', get_template_directory_uri().'/tiny_mce/wp-qtags-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );

//TinyMCE追加用のスタイルを初期化
//http://com4tis.net/tinymce-advanced-post-custom/
if ( !function_exists( 'initialize_tinymce_styles' ) ):
function initialize_tinymce_styles($init_array) {
  //MCEのフォーマット
  $init_array['preview_styles'] = 'background background-color background-image border border-bottom border-radius box-shadow color font-size font-family font-weight text-decoration text-transform';
  //追加するスタイルの配列を作成
  $style_formats = array(
    array(
      'title' => '赤字',
      'inline' => 'span',
      'classes' => 'red',

    ),
    array(
      'title' => '太い赤字',
      'inline' => 'span',
      'classes' => 'bold-red'
    ),
    array(
      'title' => '赤アンダーライン',
      'inline' => 'span',
      'classes' => 'red-under'
    ),
    array(
      'title' => '黄色マーカー',
      'inline' => 'span',
      'classes' => 'marker'
    ),
    array(
      'title' => '黄色アンダーラインマーカー',
      'inline' => 'span',
      'classes' => 'marker-under'
    ),
    array(
      'title' => '打ち消し線',
      'inline' => 'span',
      'classes' => 'strike'
    ),
    array(
      'title' => 'バッジ',
      'inline' => 'span',
      'classes' => 'ref'
    ),
    array(
      'title' => 'キーボード',
      'inline' => 'span',
      'classes' => 'keyboard-key'
    ),
    array(
      'title' => '文字グレー',
      'inline' => 'span',
      'classes' => 'text-muted'
    ),
    array(
      'title' => '文字青',
      'inline' => 'span',
      'classes' => 'text-primary'
    ),
    array(
      'title' => '文字グリーン',
      'inline' => 'span',
      'classes' => 'text-success'
    ),
    array(
      'title' => '文字薄青',
      'inline' => 'span',
      'classes' => 'text-info'
    ),
    array(
      'title' => '文字黄',
      'inline' => 'span',
      'classes' => 'text-warning'
    ),
    array(
      'title' => '文字赤',
      'inline' => 'span',
      'classes' => 'text-danger'
    ),
    array(
      'title' => '背景青',
      'inline' => 'span',
      'classes' => 'bg-primary'
    ),
    array(
      'title' => '背景グリーン',
      'inline' => 'span',
      'classes' => 'bg-success'
    ),
    array(
      'title' => '背景薄青',
      'inline' => 'span',
      'classes' => 'bg-info'
    ),
    array(
      'title' => '背景黄',
      'inline' => 'span',
      'classes' => 'bg-warning'
    ),
    array(
      'title' => '背景赤',
      'inline' => 'span',
      'classes' => 'bg-danger'
    ),
    array(
      'title' => '背景黒',
      'inline' => 'span',
      'classes' => 'bg-black'
    ),
    array(
      'title' => 'テキスト中央寄せ',
      'block' => 'p',
      'classes' => 'text-center'
    ),
    array(
      'title' => 'テキスト右寄せ',
      'block' => 'p',
      'classes' => 'text-right'
    ),
    array(
      'title' => 'テキスト左寄せ',
      'block' => 'p',
      'classes' => 'text-left'
    ),
    array(
      'title' => '最大幅',
      'block' => 'div',
      'classes' => 'max'
    ),
    array(
      'title' => '大',
      'inline' => 'span',
      'classes' => 'bold'
    ),
    array(
      'title' => '小',
      'inline' => 'span',
      'classes' => 'small'
    ),
  );
  //JSONに変換
  $init_array['style_formats'] = json_encode($style_formats);

  //ビジュアルエディターのフォントサイズ変更機能の文字サイズ指定
  $init_array['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';
  return $init_array;
}
endif;
add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);

//Wordpressビジュアルエディターに文字サイズの変更機能を追加
if ( !function_exists( 'add_ilc_mce_buttons_to_bar' ) ):
function add_ilc_mce_buttons_to_bar($buttons){
  array_push($buttons, 'backcolor', 'fontsizeselect', 'cleanup');
  return $buttons;
}
endif;
add_filter('mce_buttons', 'add_ilc_mce_buttons_to_bar');

//TinyMCEにスタイルセレクトボックスを追加
//https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
if ( !function_exists( 'add_styles_to_tinymce_buttons' ) ):
function add_styles_to_tinymce_buttons($buttons) {
  //見出しなどが入っているセレクトボックスを取り出す
  $temp = array_shift($buttons);
  //先頭にスタイルセレクトボックスを追加
  array_unshift($buttons, 'styleselect');
  //先頭に見出しのセレクトボックスを追加
  array_unshift($buttons, $temp);
  return $buttons;
}
endif;
add_filter('mce_buttons_2','add_styles_to_tinymce_buttons');

function custom_editor_settings( $initArray ){
 $initArray['block_formats'] = "ブロックdiv=div; 段落p=p; 見出しh4=h4; 見出しh5=h5; 整形済みテキストpre=pre;";
 return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );