<?php
/**
 * Created by PhpStorm.
 * User: janhenkes
 * Date: 11/10/16
 * Time: 10:35
 */

namespace JmGoogleAnalytics;

class Admin {
    private static $options;
    const option = 'jm_google_analytics';
    const settings_group = 'jm_ga_settings_group';

    public static function add_menu_page() {
        add_menu_page(
            _x( 'Google Analytics', '', Plugin::text_domain ),
            'Google Analytics',
            'manage_options', Plugin::text_domain,
            [ Admin::class, 'auto_publisher_page' ],
            'dashicons-analytics'
        );
    }

    public static function get_options() {
        if ( ! is_null( self::$options ) ) {
            return self::$options;
        }

        return self::$options = get_option( self::option );
    }

    public static function auto_publisher_page() {
        // Set class property
        self::get_options();
        ?>
        <div class="wrap">
            <h1><?php _ex( 'Google Analytics', 'page title', Plugin::text_domain ) ?></h1>

            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( self::settings_group );
                do_settings_sections( self::settings_group );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public static function register_settings() {
        //register our settings
        register_setting( self::settings_group, self::option, [ Admin::class, 'sanitize' ] );

        add_settings_section( 'section_tracking', // ID
            'Tracking', // Title
            [ Admin::class, 'print_section_info' ], // Callback
            self::settings_group // Page
        );

        add_settings_field( 'tracking_id', 'Tracking ID', [
            Admin::class,
            'tracking_id_callback',
        ], self::settings_group, 'section_tracking' );

        add_settings_field( 'google_optimize_key', 'Google Optimize key (optional)', [
            Admin::class,
            'google_optimize_key_callback',
        ], self::settings_group, 'section_tracking' );

        add_settings_field( 'google_tag_manager_key', 'Google Tag Manager key (optional)', [
            Admin::class,
            'google_tag_manager_key_callback',
        ], self::settings_group, 'section_tracking' );

        add_settings_field( 'disable_send_page_view', 'Disable Send Page view', [
            Admin::class,
            'disable_send_page_view_callback',
        ], self::settings_group, 'section_tracking' );

        add_settings_field( 'cookie_consent_support', 'Cookie Consent support (sets &lt;script type="text/plain"&gt; so scripts wont be loaded until the visitor consented)', [
            Admin::class,
            'cookie_consent_support_callback',
        ], self::settings_group, 'section_tracking' );
    }

    /**
     * Print the Section text
     */
    public static function print_section_info() {
        _ex( 'Set your tracking information', 'Admin page', Plugin::text_domain );
    }

    public static function tracking_id_callback() {
        if ( ! isset( self::$options['tracking_id'] ) ) {
            self::$options['tracking_id'] = '';
        }
        printf( '<input type="text" name="%s[tracking_id]" id="tracking_id" value="%s" />', self::option, self::$options['tracking_id'] );
    }

    public static function google_optimize_key_callback() {
        if ( ! isset( self::$options['google_optimize_key'] ) ) {
            self::$options['google_optimize_key'] = '';
        }
        printf( '<input type="text" name="%s[google_optimize_key]" id="google_optimize_key" value="%s" />', self::option, self::$options['google_optimize_key'] );
    }

    public static function google_tag_manager_key_callback() {
        if ( ! isset( self::$options['google_tag_manager_key'] ) ) {
            self::$options['google_tag_manager_key'] = '';
        }
        printf( '<input type="text" name="%s[google_tag_manager_key]" id="google_tag_manager_key" value="%s" />', self::option, self::$options['google_tag_manager_key'] );
    }

    public static function disable_send_page_view_callback() {
        if ( ! isset( self::$options['disable_send_page_view'] ) ) {
            self::$options['disable_send_page_view'] = 0;
        }

        printf( '<input type="checkbox" name="%s[disable_send_page_view]" id="disable_send_page_view" value="1" %s /><label for="disable_send_page_view">%s</label>',
            self::option,
            checked( 1, self::$options['disable_send_page_view'], false ),
            __( 'Disable ‘send page view’ to Analytics. This way you can send your page views manually when using a custom method', Plugin::text_domain )
        );
    }

    public static function cookie_consent_support_callback() {
        if ( ! isset( self::$options['cookie_consent_support'] ) ) {
            self::$options['cookie_consent_support'] = '';
        }
        printf( '<input type="checkbox" name="%s[cookie_consent_support]" id="cookie_consent_support" value="1" %s />', self::option, self::$options['cookie_consent_support'] ? 'checked="checked"' : '' );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     *
     * @return array
     */
    public static function sanitize( $input ) {
        $new_input = [];

        if ( isset( $input['tracking_id'] ) ) {
            $new_input['tracking_id'] = $input['tracking_id'];
        }

        if ( isset( $input['google_optimize_key'] ) ) {
            $new_input['google_optimize_key'] = $input['google_optimize_key'];
        }

        if ( isset( $input['google_tag_manager_key'] ) ) {
            $new_input['google_tag_manager_key'] = $input['google_tag_manager_key'];
        }

        if ( isset( $input['cookie_consent_support'] ) ) {
            $new_input['cookie_consent_support'] = $input['cookie_consent_support'];
        }

        if ( isset( $input['disable_send_page_view'] ) ) {
            $new_input['disable_send_page_view'] = $input['disable_send_page_view'];
        }

        return $new_input;
    }
}