<?php
/**
 * Created by PhpStorm.
 * User: janhenkes
 * Date: 11/10/16
 * Time: 10:42
 */

namespace JmGoogleAnalytics;


class TrackingCode {
    public static function scriptType() {
        return Admin::get_options()['cookie_consent_support'] ? 'text/plain' : 'text/javascript';
    }

    public static function print_code() {
        if ( defined( 'WP_ENV' ) && WP_ENV == 'production' && ! current_user_can( 'edit_post' ) ) {
            if ( Admin::get_options()['google_optimize_key'] ) {
                ?>
                <style>.async-hide {
                        opacity: 0 !important
                    } </style>
                <script type="text/javascript">(function ( a, s, y, n, c, h, i, d, e ) {
                        s.className += ' ' + y;
                        h.start = 1 * new Date;
                        h.end = i = function () {
                            s.className = s.className.replace( RegExp( ' ?' + y ), '' )
                        };
                        (a[ n ] = a[ n ] || []).hide = h;
                        setTimeout( function () {
                            i();
                            h.end = null
                        }, c );
                        h.timeout = c;
                    })( window, document.documentElement, 'async-hide', 'dataLayer', 4000,
                        {<?php echo json_encode( Admin::get_options()['google_optimize_key'] ) ?>:
                    true
                    })
                    ;</script>
                <?php
            }
            if ( Admin::get_options()['tracking_id']) {
                ?>
                <!-- Google Analytics -->
                <script type="text/javascript">
                    window.ga = window.ga || function () {
                        (ga.q = ga.q || []).push( arguments )
                    };
                    ga.l      = +new Date;
                    ga( 'create', '<?php echo Admin::get_options()['tracking_id'] ?>', 'auto' );
                    <?php
                    if (Admin::get_options()['google_optimize_key']) {
                    ?>
                    ga( 'require', <?php echo json_encode( Admin::get_options()['google_optimize_key'] ) ?>);
                    <?php
                    }
                    if ( ! isset( Admin::get_options()['disable_send_page_view'] ) || empty( Admin::get_options()['disable_send_page_view'] ) ) {
                    ?>
                    ga( 'send', 'pageview' );
                    <?php
                    }
                    ?>
                    ga( 'set', 'anonymizeIp', true );
                </script>
                <script type="<?php echo self::scriptType() ?>" async src='https://www.google-analytics.com/analytics.js'></script>
                <!-- End Google Analytics -->
                <?php
            }
            if ( Admin::get_options()['google_tag_manager_key']) {
                ?>
                <!-- Google Tag Manager -->
                <script type="<?php echo self::scriptType() ?>">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                                                                      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                    })(window,document,'script','dataLayer',<?php echo json_encode(Admin::get_options()['google_tag_manager_key']) ?>);</script>
                <!-- End Google Tag Manager -->
                <?php
            }
        }
    }
}