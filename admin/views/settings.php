<?php

    // No direct access to this file
    defined( 'ABSPATH' ) or die();

?>

<?php if ( isset( $_GET['settings-updated'] ) ) : ?>

    <?php if ( get_option('sitebam_site_id') == '' ): ?>
        <div id="message" class="notice notice-warning is-dismissible">
            <p><strong><?php _e('SiteBam script is disabled.', 'sitebam'); ?></strong></p>
        </div>
    <?php else: ?>
        <div id="message" class="notice notice-success is-dismissible">
                <p><strong><?php echo sprintf( __('SiteBam script installed for SiteBamID %s <a href="%s" target="_blank">Click here to verify your install</a>.', 'sitebam'), get_option('sitebamid'), get_site_url() . '?hjVerifyInstall=' . get_option('sitebamid') ); ?></strong></p>
        </div>
    <?php endif; ?>

<?php endif; ?>


<div id="business-info-wrap" class="wrap">

    <div class="wp-header">
        <img src="<?php echo plugins_url( '../static/sitebam_logo.png', __FILE__ ); ?>" alt="SiteBam" class="sitebam-logo">
    </div>



    <form method="post" action="options.php">
        <?php settings_fields( 'sitebam' );
        do_settings_sections('sitebam'); ?>

        <div id="sitebam-form-area">
            <p><?php
            $url = 'https://admin.sitebam.com';
            $link = sprintf( wp_kses( __( 'Visit your <a href="%s" target="_blank">SiteBam Control Panel</a> and click on \'installation\' in the left hand menu on SiteBam to find your unique SiteBam ID.', 'sitebam'), array(  'a' => array( 'href' => array(), 'target' =>  '_blank' ) ) ), esc_url( $url ) );
            echo $link;
            ?></p>
            <p><?php _e('Input your SiteBam ID into the field below to connect your SiteBam and WordPress accounts.', 'sitebam'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                        <label for="sitebamid"><?php esc_html_e( 'SiteBam ID', 'sitebam'); ?></label>
                        </th>

                        <td>
                        <input type="number" name="sitebamid" id="sitebamid" value="<?php echo esc_attr( get_option('sitebamid') ); ?>" />
                        <p class="description" id="wp_sitebamid_description"><?php esc_html_e( '(Leave blank to disable)', 'sitebam' ); ?></p>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <?php submit_button(); ?>

    </form>
</div>
