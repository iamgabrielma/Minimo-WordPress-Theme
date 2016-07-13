<?php

function awp_minimo_theme_fonts_page($options){
    
//     global $options;

//     function get_fonts_two() {
//         $fonts_two = array(
//             'arial' => array(
//                 'name' => 'Arial',
//                 'font' => '',
//                 'css' => "font-family: Arial, sans-serif;"
//             ),
//             'ubuntu' => array(
//                 'name' => 'Ubuntu',
//                 'font' => '@import url(https://fonts.googleapis.com/css?family=Ubuntu);',
//                 'css' => "font-family: 'Ubuntu', sans-serif;"
//             ),
//             'lobster' => array(
//                 'name' => 'Lobster',
//                 'font' => '@import url(https://fonts.googleapis.com/css?family=Lobster);',
//                 'css' => "font-family: 'Lobster', cursive;"
//             )
//         );
        
//         return apply_filters( 'get_fonts_two', $fonts_two );
//     }

}

function font_head_two() {
    //global $options;
    global $fonts_two;
    //$options = get_option( 'get_fonts_two' );
    //$fonts_two = get_fonts_two();
    echo '//=============== STYLE added! ===============//';
    echo '<style>';   
    if (in_array( 'Arial', $fonts_two)) {
        echo 'arial found';
    } else {
        echo 'arial NOT found';    
    }


    echo '</style>';
    /* esto viene de global $fonts_two, dentro de global $options */
    var_dump($fonts_two);


}
add_action( 'wp_head', 'font_head_two' );