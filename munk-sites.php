<?php
/**
 * Do not go gentle into that good night,
 * Old age should burn and rave at close of day;
 * Rage, rage against the dying of the light.
 * 
 * Though wise men at their end know dark is right,
 * Because their words had forked no lightning they
 * Do not go gentle into that good night.
 *  
 * Dylan Thomas, 1914 - 1953
 *  
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA 
 *
 * Plugin Name:       Munk Sites
 * Description:       Import ready to use instant sites for your WP Munk Theme.
 * Version:           1.0.0
 * Author:            MetricThemes
 * Author URI:        https://metricthemes.com
 * License:           GPL-2.0+ 
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       munk-sites
 * Domain Path:       /languages
 */


define( 'MUNK_SITES_URL', untrailingslashit( plugins_url(  '', __FILE__ ) ) );
define( 'MUNK_SITES_PATH',dirname( __FILE__ ) );

if ( ! class_exists( 'WP_Importer' ) ) {
	defined( 'WP_LOAD_IMPORTERS' ) || define( 'WP_LOAD_IMPORTERS', true );
	require ABSPATH . '/wp-admin/includes/class-wp-importer.php';
}

require dirname( __FILE__ ) . '/classess/class-placeholder.php';
require dirname( __FILE__ ) . '/importer/class-logger.php';
require dirname( __FILE__ ) . '/importer/class-logger-serversentevents.php';
require dirname( __FILE__ ) . '/importer/class-wxr-importer.php';
require dirname( __FILE__ ) . '/importer/class-wxr-import-info.php';
require dirname( __FILE__ ) . '/importer/class-wxr-import-ui.php';

require dirname( __FILE__ ) . '/classess/class-tgm.php';
require dirname( __FILE__ ) . '/classess/class-plugin.php';
require dirname( __FILE__ ) . '/classess/class-sites.php';
require dirname( __FILE__ ) . '/classess/class-ajax.php';


Munk_Sites::get_instance();
new Munk_Sites_Ajax();

/**
 * Redirect to import page
 *
 * @param $plugin
 * @param bool|false $network_wide
 */
function munk_sites_plugin_activate( $plugin, $network_wide = false ) {
    if ( ! $network_wide &&  $plugin == plugin_basename( __FILE__ ) ) {

        $url = add_query_arg(
            array(			
                'page' => 'munk-sites'
            ),
            admin_url('themes.php')
        );

        wp_redirect($url);
        die();

    }
}
add_action( 'activated_plugin', 'munk_sites_plugin_activate', 90, 2 );