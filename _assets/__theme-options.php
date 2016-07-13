
<?php

// awp_minimo_theme_options_page


/* COMMON MARKUP */
function create_suf_header_3($value) { echo '<h3 class="suf-header-3">'.$value['name']."</h3>\n"; }

function create_opening_tag($value) { 
		$group_class = "";
		if (isset($value['grouping'])) {
			$group_class = "suf-grouping-rhs";
		}
		echo '<div class="suf-section fix">'."\n";

		if ($group_class != "") {
			echo "<div class='$group_class fix'>\n";
		}
		/* le asigna el nombre del array de opciones */
		if (isset($value['name'])) {
			echo "<h3>" . $value['name'] . "</h3>\n";
		}

		if (isset($value['desc']) && !(isset($value['type']) && $value['type'] == 'checkbox')) {
			echo $value['desc']."<br />";
		}
		if (isset($value['note'])) {
			echo "<span class=\"note\">".$value['note']."</span><br />";
		}
	 }
	function create_closing_tag($value) { 
		if (isset($value['grouping'])) {
			echo "</div>\n";
		}
		//echo "</div><!-- suf-section -->\n";
		echo "</div>\n";
	 }


/* SPECIFIC STYLING */
function create_section_for_textarea($value) { 
		create_opening_tag($value);
	echo '<textarea name="'.$value['id'].'" type="textarea" cols="" rows="">'."\n";
	if ( get_option( $value['id'] ) != "") {
		echo get_option( $value['id'] );
	}		
	else {
		echo $value['std'];
	}		echo '</textarea>';
	create_closing_tag($value);
}
function create_section_for_color_picker($value) { 
		create_opening_tag($value);
		$color_value = "";
		if (get_option($value['id']) === FALSE) {
			$color_value = $value['std'];
		}
		else {
			$color_value = get_option($value['id']);
		}
	 
		echo '<div class="color-picker">'."\n";
		echo '<input type="text" id="'.$value['id'].'" name="'.$value['id'].'" value="'.$color_value.'" class="color" />';
		echo ' « Click to select color<br/>'."\n";
		echo "Default: <font color='".$value['std']."'> ".$value['std']."</font>";
		echo " (You can copy and paste this into the box above)\n";
		echo "</div>\n";
		create_closing_tag($value);
	 }

$shortname = 'awp';
$themename = 'minimo';
$options = array(
	array(	
		"name" => "Header Customization",
		"type" => "sub-section-3",
		"category" => "header-styles",
	),
	array(	
		"name" => "Body Customization",
		"type" => "sub-section-3",
		"category" => "body-styles",
	),
	array(
		"name" => "Body Background Color",
		"desc" => "Set the color of the background on which the page is. ",
		"id" => $shortname."_body_background_color",
		"type" => "color-picker",
		"parent" => "body-styles",
		"std" => "#FFF",
	),
	array("name" => "Custom Google Analytics Tracking Code",
		"desc" => "Enter your tracking code here for Google Analytics",
		"id" => $shortname."_custom_analytics_code",
		"type" => "textarea",
		"parent" => "analytics-setup",
		"std" => ""
	)
);

function awp_minimo_dashboard_callback_function($options){
	global $options;

	echo "<h2>MINIMO THEME SETTINGS</h2>\n";
	echo "<h3 style='color:red'>FAIL, TRYING OUT ON THEME-OPTIONS-SUBPAGE.PHP</h3>\n";
	echo "<form id='options_form' method='post' name='form' >\n";

	foreach ($options as $value) {
		switch ($value['type']) {
			case 'sub-section-3':
				create_suf_header_3($value);
				break;
			case 'color-picker':
				create_section_for_color_picker($value);
				break;
			case 'textarea':
				create_section_for_textarea($value);
				break;
		}
	}
	?>
	<input name="save" type="button" value="Save" class="button"/>
	<input name="reset_all" type="button" value="Reset to default values" class="button"/>
	<input type="hidden" name="formaction" value="default" />

	<script>
	// 	function awp_submit_form(element, form){
	// 		form['formaction'].value = element.name;
	// 		form.submit;
	// 	}
	</script>
<?php
	echo "</form>";

/* Jugar con $_REQUEST tiene sentido ya que es un array asociativo con muchos datos que hay que hacer un submit. */

/* ahora añadimos un hook a las paginas de administracion con esta funcion cb*/

}



?>

</form>
</div>