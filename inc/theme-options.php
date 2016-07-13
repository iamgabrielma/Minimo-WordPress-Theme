<?php
/* DISPLAY AND DRAW THE OPTIONS AS ALSO BASIC FUNCTIONALITY */
$shortname = 'awp';
$themename = 'minimo';
$options = array(
	
	array("name" => "Custom Google Analytics Tracking Code",
		"desc" => "Enter your tracking code here for Google Analytics",
		"id" => $shortname."_custom_analytics_code",
		"type" => "textarea",
		"parent" => "analytics-setup",
		"std" => ""
	),
	array(
		"name" => 'Fonts',
		"desc" => "Use the form below to change fonts of your theme.",
		"id" => $shortname."_custom_fonts_code",
		"type" => "select"
	),
	/* ANADO AQUI TAMBIEN EL SUBMENU DE HOOKS A TRAVES DE UN SWITCH Y COGIENDO LOS DATOS DESDE EL GLOBAL OPTIONS */
	array(
		"name" => 'Executed below the opening <body> tag',
		"desc" => 'Header hook',
		"id"	=> $shortname."_custom_hook_header",
		"type"	=> "textarea2"
	),
	array(
		"name" => 'Executed before the opening #header DIV tag',
		"desc" => 'Body hook',
		"id"	=> $shortname."_custom_hook_header_before_opening_header",
		"type"	=> "textarea2"
	),
    $fonts_two = array(
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
    )

);
// new approach
add_option('options', $options );

function create_section_for_textarea_on_custom_hooks($value){
	
	echo '<textarea name="'.$value['id'].'" type="textarea" cols="" rows="">'."\n";
	if ( get_option( $value['id'] ) != "") {
		echo get_option( $value['id'] );
	}		
	else {
		echo $value['std'];
	}		echo '</textarea>';

}

function create_opening_tag($value){
	echo '<div class="">';
	if (isset($value['name'])) {
		echo "<h3>" . $value['name'] . "</h3>\n";
	}
	if (isset($value['desc'])) {
		echo $value['desc'] . "<br>";
	}
}
function create_closing_tag($value){
	echo '</div>';
}

function create_section_for_textarea($value){
	//create_opening_tag($value);
	echo '<textarea name="'.$value['id'].'" type="textarea" cols="" rows="">'."\n";
	if ( get_option( $value['id'] ) != "") {
		echo get_option( $value['id'] );
	}		
	else {
		echo $value['std'];
	}		echo '</textarea>';
	//create_closing_tag($value);
}
function create_section_for_select($value){

	$fonts = get_fonts();
	$current = 'lato';

	if (isset($options['body-font'])) {
		$current = $options['body-font'];
	}

	// approach HTML first
	?>
	<!--<select name="fonts">-->
	<select name="fonts[body-font]">
	<?php foreach( $fonts as $key => $font ): ?>
		<option value="<?php echo $key;?>" 
		<?php
		if ($key == $current) {
			echo 'selected';
		}
		?>
		>	
		<?php echo $font['name']; ?>
		</option>
	<?php endforeach; ?>
	</select>
	<?php

	// WORKS, approach PHP first
	//echo '<select name="fonts[body-font]">';
	// foreach ($fonts as $key => $font) {
	// 	echo '<option>' . $font['name'] . '</option>';
	// }
	// echo '</select>';
	

}

/* draws everything into the options page */
function awp_minimo_theme_options_page($options){
	global $options;
	echo "<h1>MINIMO THEME SETTINGS</h1>\n";
	echo '<h2 class="nav-tab-wrapper">';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp_minimo_add_theme_options_page" class="nav-tab nav-tab-active">Settings</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-hooks-manager" class="nav-tab">Hooks</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-layout-manager" class="nav-tab ">Layouts</a>';


	// starts form
	echo "<form id='awp_options_form' name='awp_options_form' method='post'>";

	foreach ($options as $value) {
		switch ($value['type']) {
			case 'textarea':
				create_opening_tag($value);
				create_section_for_textarea($value);
				create_closing_tag($value);
				break;

			case 'select':
				create_opening_tag($value);
				create_section_for_select($value);
				echo '<p style="color:red;">FRONT-END BROKEN, WORKS HERE THO</p>';
				create_closing_tag($value);
				break;

		}
	}
	echo "<input class='button button-primary' name='save' type='submit' value='Save' class='button'/></input>";
	echo "</form>";
	echo '<h2>';

}

if (isset($_POST['save'])) {
		
		/* ANALYTICS */
		if (!empty($_POST['awp_custom_analytics_code'])) {
			$options = get_option( 'options' );
			//$options[0]['std'] = 'wut' ;
			$options[0]['std'] = $_POST['awp_custom_analytics_code'] ;
			update_option( 'options', $options );
			
			echo "<div id='message' class='updated'>
					DEBUG: analytics updated!
				</div>";			
		} else {
			echo "<div id='message' class='error'>
					DEBUG: nothing to update in analytics!
				</div>";
		}

		/* FONTS */

		if (isset($_POST['fonts'])) {
			echo "<div id='message' class='updated'>
					DEBUG: fonts set!	
				</div>";
		} else{
			echo "<div id='message' class='error'>
					DEBUG: fonts not set!
				</div>";
		}
		var_dump($_POST['fonts']);
		//$the_var = $_POST['fonts'];
		//font_head($the_var);
		




}
function awp_minimo_theme_hooks_page($options){
	global $options;
	echo "<h1>MINIMO THEME SETTINGS: HOOKS</h1>\n";
	echo '<h2 class="nav-tab-wrapper">';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp_minimo_add_theme_options_page" class="nav-tab">Settings</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-hooks-manager" class="nav-tab nav-tab-active">Hooks</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-layout-manager" class="nav-tab ">Layouts</a>';

	$awp_custom_hooks_available = array('header', 'navigation', 'main', 'post', 'page', 'sidebars', 'footer', 'wordpress');

	// $args = array(
	// 	'base'               => '%_%',
	// 	'format'             => '?paged=%#%',
	// 	'total'              => 1,
	// 	'current'            => 0,
	// 	'show_all'           => false,
	// 	'end_size'           => 1,
	// 	'mid_size'           => 2,
	// 	'prev_next'          => true,
	// 	'prev_text'          => __('« Previous'),
	// 	'next_text'          => __('Next »'),
	// 	'type'               => 'plain',
	// 	'add_args'           => false,
	// 	'add_fragment'       => '',
	// 	'before_page_number' => '',
	// 	'after_page_number'  => ''
	// ); 

	// echo paginate_links( $args );
	//echo '<ul>';
	foreach ($awp_custom_hooks_available as $key) {
		
		echo '<a href="#">' . $key . '</a> | ';
	}
	//echo '</ul>';

	foreach ($options as $value) {
		
		switch ($value["desc"]) {

			case 'Header hook':
				
				create_opening_tag($value);
				create_section_for_textarea_on_custom_hooks($value);
				create_closing_tag($value);
				
				break;

			case 'Body hook';
				
				create_opening_tag($value);
				create_section_for_textarea_on_custom_hooks($value);
				create_closing_tag($value);
				
				break;
			
		}
	}
	// echo '<ul>

	// <li>Header</li>
	// <li>Navigation</li>
	// <li>Option 3</li>
	// <li>Option 4</li>
	// </ul>';
}

function awp_minimo_theme_layout_page($options){
	global $options;
	echo "<h1>MINIMO THEME SETTINGS: LAYOUT</h1>\n";
	echo '<h2 class="nav-tab-wrapper">';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp_minimo_add_theme_options_page" class="nav-tab">Settings</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-hooks-manager" class="nav-tab ">Hooks</a>';
	echo '<a href="http://localhost/__nsfw/wp-admin/admin.php?page=awp-layout-manager" class="nav-tab nav-tab-active">Layouts</a>';

}

?>