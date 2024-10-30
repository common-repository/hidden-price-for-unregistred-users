<?php
/**
 * Admin Controller
 *
 * @author Desperado House - Cvijetin Maletic
 * @contribute desperadohouse <desperadohouse.com>
 */


defined('ABSPATH') or die();

/** REGISTER SITTINGS OPTIONS**/
function register_dhhp_settings() {
	//register admin page settings
	register_setting( 'dhhp-settings-group', 'dhhp_notification_message_option' );
}

function dhhp_settings_page() {
?>

<div class="wrap">
<h1>HIDDEN PRICE FOR UNREGISTRED USERS</h1>
<p> If visitor of website not registered user and loged price will be hidden and shown notification to get registre if wanna see the price.</p>
<form method="post" action="options.php">
    <?php settings_fields( 'dhhp-settings-group' ); ?>
    <?php do_settings_sections( 'dhhp-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Notification Message</th>
        <td><input type="text" name="dhhp_notification_message_option" value="<?php echo esc_attr( get_option('dhhp_notification_message_option') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button();?>
</form>
</div>
<?php } ?>