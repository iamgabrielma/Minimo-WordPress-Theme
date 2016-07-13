<?php
$shortname = 'awp_';
$sub_options = array("awp_google_analytics", 'some_other_option', 'option_etc');

$my_new_options = array('ga_enable' => true, 'property_id' => 'UA-XXXXX-X' );
// function create_new_section_for_textarea($value) { 
// 	//create_opening_tag($value);
// 	echo '<textarea name="'.$value['id'].'" type="textarea" cols="" rows="">'."\n";
// 	if ( get_option( $value['id'] ) != "") {
// 		echo get_option( $value['id'] );
// 	}		
// 	else {
// 		echo $value['std'];
// 	}		echo '</textarea>';
	//create_closing_tag($value);
//}

function awp_minimo_dashboard_submenu_callback_settings() {
	register_setting( array(
		'awp_minimo_dashboard_submenu_callback_settings_group', 
		'awp_google_analytics',
		'awp_minimo_dashboard_submenu_callback_settings_group', 
		'some_other_option',
		'awp_minimo_dashboard_submenu_callback_settings_group', 
		'option_etc' )
	);
}

function awp_minimo_dashboard_submenu_callback_function(){
	global $sub_options;
	
?>

<div class="wrap">
<h2>THE SUBMENU -> <span style="color:red">THIS SYSTEM WORKS<span></h2>
<form method="post" action="http://localhost/__nsfw/wp-admin/admin.php?page=awp_minimo_theme_options_subpage">
<table class="form-table">
        <tr valign="top">
        <th scope="row">Tracking Code</th>
        <td>

        <input type="text" name="awp_google_analytics" id="awp_google_analytics" value="<?php echo esc_attr( get_option('awp_google_analytics') ); ?>" /></td>

        <td>
        Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.
         </td>
        </tr>
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>

<?php
	
	foreach ($sub_options as $sub_value) {
		
		if (isset($_POST[$sub_value])) {
			
			$output = var_dump($_POST[$sub_value]);
			echo $output . '<br>';
			
			
		}
	}
	
}


?>
</form>
<div>