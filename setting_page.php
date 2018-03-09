<?php
// create custom plugin settings menu
add_action('admin_menu', 'rlic_tareqanwar_setting_menu');

function rlic_tareqanwar_setting_menu() {

	//create new sub-menu under setting page
	add_submenu_page('options-general.php','Related Links Inside Content Settings', 'RLIC Settings', 'administrator', "rlic-settings", 'rlic_tareqanwar_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_rlic_tareqanwar_settings' );
}


function register_rlic_tareqanwar_settings() {
	//register our settings
	register_setting( 'rlic-tareqanwar-settings-group', 'rlic-tareqanwar-releted-story-text' );
}

function rlic_tareqanwar_settings_page() {
?>
<div class="wrap">
<h1>Related Links Inside Content</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'rlic-tareqanwar-settings-group' ); ?>
    <?php do_settings_sections( 'rlic-tareqanwar-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Text to replace "Related Story"</th>
        <td><input type="text" name="rlic-tareqanwar-releted-story-text" value="<?php echo esc_attr( get_option('rlic-tareqanwar-releted-story-text') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
