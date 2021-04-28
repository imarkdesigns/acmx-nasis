<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

function myplugin_tinymce_buttons( $buttons ){
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'myplugin_tinymce_buttons' );

function my_wpeditor_buttons( $buttons, $editor_id ) {
  if ( 'content' != $editor_id ) {
    return $buttons;
  }

  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'my_wpeditor_buttons', 10, 2 );

function my_wpeditor_formats_options( $settings ) {

  $default_style_formats = [

    [ 'title' => 'Headings',
      'items' => [
        [ 'title' => 'Heading 1', 'format' => 'h1' ],
        [ 'title' => 'Heading 2', 'format' => 'h2' ],
        [ 'title' => 'Heading 3', 'format' => 'h3' ],
        [ 'title' => 'Heading 4', 'format' => 'h4' ],
        [ 'title' => 'Heading 5', 'format' => 'h5' ],
        [ 'title' => 'Heading 6', 'format' => 'h6' ],
      ]
    ], // Headings
    [ 'title' => 'Inline',
      'items' => [
        [ 'title' => 'Bold',        'format' => 'bold',         'icon' => 'bold' ],
        [ 'title' => 'Italic',      'format' => 'italic',       'icon' => 'italic' ],
        [ 'title' => 'Underline',   'format' => 'underline',    'icon' => 'underline' ],
        [ 'title' => 'Superscript', 'format' => 'superscript',  'icon' => 'superscript' ],
        [ 'title' => 'Subscript',   'format' => 'subscript',    'icon' => 'subscript' ],
        [ 'title' => 'Code',        'format' => 'code',         'icon' => 'code' ],
      ]
    ], // Inline
    [ 'title' => 'Blocks',
      'items' => [
        [ 'title' => 'Div',         'format' => 'div' ],
        [ 'title' => 'Paragraph',   'format' => 'p' ],
        [ 'title' => 'Pre',         'format' => 'pre' ],
        [ 'title' => 'Blockquote',  'format' => 'blockquote' ],
      ]
    ], // Blocks
    [ 'title' => 'Alignment',
      'items' => [
        [ 'title' => 'Left',    'selector' => 'hgroup,h1,h2,h3,h4,h5,h6,p,div', 'classes' => 'alignleft',    'icon' => 'alignleft' ],
        [ 'title' => 'Center',  'selector' => 'hgroup,h1,h2,h3,h4,h5,h6,p,div', 'classes' => 'aligncenter',  'icon' => 'aligncenter' ],
        [ 'title' => 'Right',   'selector' => 'hgroup,h1,h2,h3,h4,h5,h6,p,div', 'classes' => 'alignright',   'icon' => 'alignright' ],
        [ 'title' => 'Justify', 'selector' => 'hgroup,h1,h2,h3,h4,h5,h6,p,div', 'classes' => 'alignjustify', 'icon' => 'alignjustify' ],
      ]
    ], // Alignment

  ];
  
  $custom_styles_formats = [

    [ 'title' => 'Header', 'type' => 'group',
      'items' => [
        [ 'title' => 'Headline', 'selector' => 'h1,h2,h3', 'classes' => 'section-headline', 'exact' => '1' ],
        [ 'title' => 'Sub Headline', 'selector' => 'h1,h2,h3', 'inline' => 'small', 'classes' => 'subheadline', 'exact' => '1' ],
        [ 'title' => 'Group Headline', 'block' => 'hgroup', 'wrapper' => true],
      ]
    ], // Content Headers

    [ 'title' => 'Text Styles', 'type' => 'group',
      'items' => [
        [ 'title' => 'Text Small', 'inline' => 'small' ],
        [ 'title' => 'Text Header Highlight', 'inline' => 'span', 'classes' => 'uk-header-highlight' ],
        [ 'title' => 'Text Router Highlight', 'inline' => 'span', 'classes' => 'uk-router-highlight' ],
      ]
    ],
    
  ];

  $new_style_formats = array_merge( $default_style_formats, $custom_styles_formats );
  $settings['style_formats'] = json_encode( $new_style_formats );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'my_wpeditor_formats_options' );