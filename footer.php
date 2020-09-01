	</div><!--/container-->

	<?php

	// If you're logged in, don't write the Google Analytics code (to help exclude your own traffic)

	if ( current_user_can('edit_pages') ) {
		?><!-- Google Analytics - Skipping since you're signed in to WordPress --><?php
	} else {
		include('includes/ga.php');
	} ?>

<?php /* ----------------------------------------------------------------- */ ?>

<?php wp_footer(); // js scripts are inserted using this function ?>

</body>
</html>