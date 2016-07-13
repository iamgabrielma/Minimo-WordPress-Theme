<?php
//wp.tutsplus.com/tutorials/changing-the-fonts-of-your-wordpress-site-part-2-theme-integration/

// add settings page

function my_fonts() {
    add_theme_page( 'Fonts', 'Fonts', 'edit_theme_options', 'fonts', 'fonts' );
}
add_action( 'admin_menu', 'my_fonts' );

// add the form
function fonts() {
?>
    <div class="wrap">
        <div><br></div>
        <h2>Fonts</h2>
 
        <form method="post" action="options.php">
            <?php wp_nonce_field( 'update-fonts' ); ?>
            <?php settings_fields( 'fonts' ); ?>
            <?php do_settings_sections( 'fonts' ); ?>
            <?php submit_button(); ?>
            </form>
        <img style="float:right; border:0;" src="http://i.imgur.com/1qqJG.png" />
    </div>
<?php
}

/* WP does not have any idea that we have settings_fields, so we need to register those on admin_init to register our settins and initialize the callbacks: font_description, body_font_field, h1_font_field*/
function my_register_admin_settings() {
    register_setting( 'fonts', 'fonts' );
    add_settings_section( 'font_section', 'Font Options', 'font_description', 'fonts' );
    add_settings_field( 'body-font', 'Body Font', 'body_font_field', 'fonts', 'font_section' );
    add_settings_field( 'h1-font', 'Header 1 Font', 'h1_font_field', 'fonts', 'font_section' );
}
add_action( 'admin_init', 'my_register_admin_settings' );


// cb
function font_description() {
    echo 'Use the form below to change fonts of your theme.';
}

// array with data stored and where to grab each font
// If you want to use a custom font that is hosted on your FTP or on Amazon S3, then replace @import with @font-face and change the url to where your font file is hosted.
function get_fonts() {
    $fonts = array(
        'arial' => array(
            'name' => 'Arial',
            'font' => '',
            'css' => "font-family: Arial, sans-serif;"
        ),
        'ubuntu' => array(
            'name' => 'Ubuntu',
            'font' => '@import url(https://fonts.googleapis.com/css?family=Ubuntu);',
            'css' => "font-family: 'Ubuntu', sans-serif;"
        ),
        'lobster' => array(
            'name' => 'Lobster',
            'font' => '@import url(https://fonts.googleapis.com/css?family=Lobster);',
            'css' => "font-family: 'Lobster', cursive;"
        )
    );
 
    return apply_filters( 'get_fonts', $fonts );
}

// cb
function body_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['body-font'] ) )
        $current = $options['body-font'];
    ?>
        <select name="fonts[body-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}

// cb
function h1_font_field() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $current = 'arial';
 
    if ( isset( $options['h1-font'] ) )
        $current = $options['h1-font'];
 
    ?>
        <select name="fonts[h1-font]">
        <?php foreach( $fonts as $key => $font ): ?>
            <option <?php if($key == $current) echo "SELECTED"; ?> value="<?php echo $key; ?>"><?php echo $font['name']; ?></option>
        <?php endforeach; ?>
        </select>
    <?php
}
 
// add styling to our wordpress header
function font_head() {
    $options = (array) get_option( 'fonts' );
    $fonts = get_fonts();
    $body_key = 'arial';
 
    if ( isset( $options['body-font'] ) )
        $body_key = $options['body-font'];
 
    if ( isset( $fonts[ $body_key ] ) ) {
        $body_font = $fonts[ $body_key ];
 
        echo '<style>';
        echo $body_font['font'];
        echo 'body  { ' . $body_font['css'] . ' } ';
        echo '</style>';
    }
 
    $h1_key = 'arial';
 
    if ( isset( $options['h1-font'] ) )
        $h1_key = $options['h1-font'];
 
    if ( isset( $fonts[ $h1_key ] ) ) {
        $h1_key = $fonts[ $h1_key ];
 
        echo '<style>';
        echo $h1_key['font'];
        echo 'h1  { ' . $h1_key['css'] . ' } ';
        echo '</style>';
    }
}
add_action( 'wp_head', 'font_head' );

?>