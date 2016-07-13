<?php
/* the easier way to do it is trough jquery and js inside php */
function get_stylesheet_depending_which_time(){
	
	echo 'HELLO THERE FROM PHP AND: ';

	?>

<div id="where-the-message-goes"></div>

	<script>


		jQuery(document).ready(function(){

			/* CHECKS THE BROWSER TIME (USER TIME) AND DISPLAYS IT IN THE FRONT-END */
			var currentTime = new Date().getHours();
				
			console.log('is 6!, appending it to HTML!');
			jQuery("#where-the-message-goes").html("hello from Javascript, it's " + currentTime + "!");

			/* PLAYAROUND WITH CSS AND JS, inject new style (after css scripts call so it can overrride the defaults ) */
			
			function injectStyles(rule){
				var div = 
					jQuery("<div />", 
					{html: '&shy;<style>' + rule + '</style>'}
				).appendTo("body");
			}
			injectStyles('body {color:blue;}');
		
		});

	</script>



	<?php


}
add_action( 'wp_head', 'get_stylesheet_depending_which_time');