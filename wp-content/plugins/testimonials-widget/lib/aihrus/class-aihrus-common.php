<?php
/*
	Copyright 2013 Michael Cannon (email: mc@aihr.us)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if ( ! function_exists( 'af_php_version_check' ) ) {
	function af_php_version_check( $file = __FILE__, $php_min = '5.3.0' ) {
		$check_okay = version_compare( PHP_VERSION, $php_min, '>' );

		if ( ! $check_okay && __FILE__ != $file ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';

			deactivate_plugins( $file );

			if ( ! defined( 'AF_PHP_VERSION_FILE' ) )
				define( 'AF_PHP_VERSION_FILE', $file );

			if ( ! defined( 'AF_PHP_VERSION_MIN' ) )
				define( 'AF_PHP_VERSION_MIN', $php_min );

			add_action( 'admin_notices', 'af_notice_php_version' );
		}

		return $check_okay;
	}


	function af_notice_php_version() {
		$base = basename( dirname( AF_PHP_VERSION_FILE ) );
		$base = str_replace( '-', ' ', $base );
		$base = ucwords( $base );

		$help_url = esc_url( 'https://aihrus.zendesk.com/entries/30678006-Most-Aihrus-Plugins-Require-PHP-5-3-' );

		$php_min = basename( AF_PHP_VERSION_MIN );

		$text = sprintf( __( 'Plugin "%1$s" requires at least PHP %2$s, you\'re running PHP %4$s. See <a href="%3$s">possible solutions</a>. Once fixed, "%1$s" can be activated again.', 'testimonials-widget' ), $base, $php_min, $help_url, PHP_VERSION );

		$content  = '<div class="error"><p>';
		$content .= $text;
		$content .= '</p></div>';

		echo $content;
	}
}

if ( ! af_php_version_check( __FILE__ ) )
	return;

if ( class_exists( 'Aihrus_Common' ) )
	return;

require_once 'interface-aihrus-common.php';


abstract class Aihrus_Common implements Aihrus_Common_Interface {
	public static $donate_button;
	public static $donate_link;


	public function __construct() {
		self::set_notice_key();

		self::$donate_button = <<<EOD
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="WM4F995W9LHXE">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
EOD;

		self::$donate_link = '<a href="http://aihr.us/about-aihrus/donate/"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" alt="PayPal - The safer, easier way to pay online!" /></a>';

		add_action( 'admin_init', array( static::$class, 'check_notices' ), 9999 );
	}


	public static function set_notice( $notice_name, $frequency_limit = false ) {
		$notice_key = self::get_notice_key();

		$frequency_limit = intval( $frequency_limit );
		if ( ! empty( $frequency_limit ) ) {
			$fl_key  = $notice_key . '_' . $notice_name;
			$proceed = get_transient( $fl_key );
			if ( false === $proceed ) {
				delete_transient( $fl_key );
				set_transient( $fl_key, time(), $frequency_limit );
			} else {
				return;
			}
		}

		$notices = get_transient( $notice_key );
		if ( false === $notices )
			$notices = array();

		$notices[] = $notice_name;

		self::delete_notices();
		set_transient( $notice_key, $notices, HOUR_IN_SECONDS );
	}


	public static function delete_notices() {
		$notice_key = self::get_notice_key();

		delete_transient( $notice_key );
	}


	public static function check_notices() {
		$notice_key = self::get_notice_key();

		$notices = get_transient( $notice_key );
		if ( false === $notices )
			return;

		$notices = array_unique( $notices );
		foreach ( $notices as $notice ) {
			if ( ! is_array( $notice ) )
				add_action( 'admin_notices', array( static::$class, $notice ) );
			else
				add_action( 'admin_notices', $notice );
		}

		self::delete_notices();
	}


	public static function get_notice_key() {
		if ( is_null( static::$notice_key ) )
			self::set_notice_key();

		return static::$notice_key;
	}


	public static function set_notice_key() {
		static::$notice_key = static::SLUG . 'notices';
	}


	public static function notice_version( $free_base, $free_name, $free_slug, $free_version, $item_name ) {
		$is_active = is_plugin_active( $free_base );
		if ( $is_active )
			$link = sprintf( __( '<a href="%1$s">update to</a>', 'testimonials-widget' ), self_admin_url( 'update-core.php' ) );
		else {
			$plugins = get_plugins();
			if ( empty( $plugins[ $free_base ] ) ) {
				$install = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $free_slug ), 'install-plugin_' . $free_slug ) );
				$link    = sprintf( __( '<a href="%1$s">install</a>', 'testimonials-widget' ), $install );
			} else {
				$activate = esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $free_base ), 'activate-plugin_' . $free_base ) );
				$link     = sprintf( __( '<a href="%1$s">activate</a>', 'testimonials-widget' ), $activate );
			}
		}

		$text = sprintf( __( 'Plugin %3$s has been deactivated. Please %1$s %4$s version %2$s or newer before activating %3$s.', 'testimonials-widget' ), $link, $free_version, $item_name, $free_name );

		self::notice_error( $text );
	}


	public static function notice_license( $post_type, $settings_id, $free_name, $purchase_url, $item_name ) {
		if ( empty( $post_type ) )
			$link = get_admin_url() . 'options-general.php?page=' . $settings_id;
		else
			$link = get_admin_url() . 'edit.php?post_type=' . $post_type . '&page=' . $settings_id;

		$text = __( '<a href="%1$s">%2$s &gt; Settings</a>, <em>Premium</em> tab, <em>License Key</em> entry', 'testimonials-widget' );

		$settings_link = sprintf( $text, $link, $free_name );

		$link = esc_url( 'https://aihrus.zendesk.com/entries/28745227-Where-s-my-license-key-' );
		$text = __( '<a href="%s">Where\'s my license key?</a>', 'testimonials-widget' );

		$faq_link = sprintf( $text, $link );

		$link = esc_url( $purchase_url );
		$text = __( '<a href="%1$s">%2$s</a>', 'testimonials-widget' );

		$buy_link = sprintf( $text, $link, $item_name );

		$text = sprintf( __( 'Plugin %1$s requires license activation before updating will work. Please activate the license key via %2$s. No license key? See %3$s or purchase %4$s.', 'testimonials-widget' ), $item_name, $settings_link, $faq_link, $buy_link );

		self::notice_error( $text );
	}


	public static function version( $version ) {
		$version .= '-' . static::ID . '-' . static::VERSION;

		return $version;
	}


	/**
	 * flatten an arbitrarily deep multidimensional array
	 * into a list of its scalar values
	 * (may be inefficient for large structures)
	 * (will infinite recurse on self-referential structures)
	 * (could be extended to handle objects)
	 *
	 * @ref http://in1.php.net/manual/en/function.array-values.php#41967
	 */


	public static function array_values_recursive( $ary ) {
		$lst = array();
		foreach ( array_keys( $ary ) as $k ) {
			$v = $ary[$k];
			if ( is_scalar( $v ) ) {
				$lst[] = $v;
			} elseif ( is_array( $v ) ) {
				$lst = array_merge(
					$lst,
					self::array_values_recursive( $v )
				);
			}
		}

		return $lst;
	}


	public static function notice_donate( $disable_donate = null, $item_name = null ) {
		if ( $disable_donate )
			return;

		$text = sprintf( esc_html__( 'Please donate $5 towards ongoing free support and development of the %1$s plugin. %2$s', 'testimonials-widget' ), $item_name, self::$donate_button );

		self::notice_updated( $text );
	}


	public static function notice_error( $text ) {
		self::notice_updated( $text, 'error' );
	}


	public static function notice_updated( $text, $class = 'updated' ) {
		if ( 'updated' == $class )
			$class .= ' fade';

		$content  = '';
		$content .= '<div class="' . $class . '"><p>';
		$content .= $text;
		$content .= '</p></div>';

		echo $content;
	}


	public static function get_scripts() {
		if ( static::$scripts_called )
			return;

		foreach ( static::$scripts as $script )
			echo $script;

		static::$scripts_called = true;
	}


	public static function get_styles() {
		if ( static::$styles_called )
			return;

		foreach ( static::$styles as $style )
			echo $style;

		static::$styles_called = true;
	}


	public static function create_nonce( $action ) {
		$nonce = uniqid();
		$uid   = get_current_user_id();
		$check = $uid . $action;
		set_transient( $nonce, $check, HOUR_IN_SECONDS );

		return $nonce;
	}


	public static function verify_nonce( $nonce, $action ) {
		$active = get_transient( $nonce );
		$uid    = get_current_user_id();
		$check  = $uid . $action;
		$valid  = false;

		if ( $active == $check ) {
			delete_transient( $nonce );
			$valid = true;
		}

		return $valid;
	}


	/**
	 * If incoming link is empty, then get_site_url() is used instead.
	 */
	public static function create_link( $link, $title = null, $target = null, $return_as_tag = true ) {
		if ( empty( $link ) )
			$link = get_site_url();

		if ( preg_match( '#^\d+$#', $link ) ) {
			$permalink = get_permalink( $link );
			$tag_title = get_the_title( $link );
			if ( empty( $title ) )
				$title = $tag_title;

			$tag  = '<a href="';
			$tag .= $permalink;
			$tag .= '" title="';
			$tag .= $tag_title;
			$tag .= '">';
			$tag .= $title;
			$tag .= '</a>';
		} else {
			$orig_link = empty( $title ) ? $link : $title;
			$do_http   = true;

			if ( 0 === strpos( $link, '/' ) )
				$do_http = false;

			if ( $do_http && 0 === preg_match( '#https?://#', $link ) )
				$link = 'http://' . $link;

			$permalink = $link;

			$tag  = '<a href="';
			$tag .= $permalink;
			$tag .= '">';
			$tag .= $orig_link;
			$tag .= '</a>';
		}

		if ( ! empty( $target ) && is_string( $target ) )
			$tag = links_add_target( $tag, $target );

		if ( $return_as_tag )
			return $tag;
		else
			return array(
				'link' => $permalink,
				'tag' => $tag,
			);
	}


	public static function add_media( $post_id, $media_src, $media_name = null, $featured_image = true ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';

		if ( empty( $media_name ) )
			$media_name = basename( $media_src );

		$wp_filetype = wp_check_filetype( $media_name, null );
		$attachment  = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_status' => 'inherit',
			'post_title' => $media_name,
		);

		$file_move = wp_upload_bits( $media_name, null, self::file_get_contents_curl( $media_src ) );
		$file_name = $file_move['file'];

		$image_id = wp_insert_attachment( $attachment, $file_name, $post_id );
		$metadata = wp_generate_attachment_metadata( $image_id, $file_name );
		wp_update_attachment_metadata( $image_id, $metadata );

		if ( $featured_image )
			update_post_meta( $post_id, '_thumbnail_id', $image_id );

		return $image_id;
	}


	/**
	 * Thank you Tobylewis
	 *
	 * file_get_contents support on some shared systems is turned off
	 *
	 * @ref http://wordpress.org/support/topic/plugin-flickr-shortcode-importer-file_get_contents-with-url-isp-does-not-support?replies=2#post-2878241
	 */
	public static function file_get_contents_curl( $url ) {
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

		$data = curl_exec( $ch );
		curl_close( $ch );

		return $data;
	}


	public static function get_image_src( $image ) {
		$doc = new DOMDocument();
		$doc->loadHTML( $image );
		$xpath = new DOMXPath( $doc );
		$src   = $xpath->evaluate( 'string(//img/@src)' );

		return $src;
	}


	public static function clean_string( $string ) {
		if ( ! is_string( $string ) )
			return $string;

		return trim( strip_shortcodes( strip_tags( $string ) ) );
	}


	/**
	 * Truncate HTML, close opened tags. UTF-8 aware, and aware of unpaired tags
	 * (which don't need a matching closing tag)
	 *
	 * @param string  $html
	 * @param int     $max_length      Maximum length of the characters of the string
	 * @param string  $indicator       Suffix to use if string was truncated.
	 * @param boolean $force_indicator Suffix to use if string was truncated.
	 * @return string
	 *
	 * @ref http://pastie.org/3084080
	 */
	public static function truncate( $html, $max_length, $indicator = '&hellip;', $force_indicator = false ) {
		$output_length = 0; // number of counted characters stored so far in $output
		$position      = 0;      // character offset within input string after last tag/entity
		$tag_stack     = array(); // stack of tags we've encountered but not closed
		$output        = '';
		$truncated     = false;

		/**
		 * these tags don't have matching closing elements, in HTML (in XHTML they
		 * theoretically need a closing /> )
		 *
		 * @see http://www.netstrider.com/tutorials/HTMLRef/a_d.html
		 * @see http://www.w3schools.com/tags/default.asp
		 * @see http://stackoverflow.com/questions/3741896/what-do-you-call-tags-that-need-no-ending-tag
		 */
		$unpaired_tags = array(
			'doctype',
			'!doctype',
			'area',
			'base',
			'basefont',
			'bgsound',
			'br',
			'col',
			'embed',
			'frame',
			'hr',
			'img',
			'input',
			'link',
			'meta',
			'param',
			'sound',
			'spacer',
			'wbr',
		);

		$func_strcut = function_exists( 'mb_strcut' ) ? 'mb_strcut' : 'substr';
		$func_strlen = function_exists( 'mb_strlen' ) ? 'mb_strlen' : 'strlen';

		// loop through, splitting at HTML entities or tags
		while ( $output_length < $max_length && preg_match( '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position ) ) {
			list( $tag, $tag_position ) = $match[0];

			// get text leading up to the tag, and store it – up to max_length
			$text = $func_strcut( $html, $position, $tag_position - $position );
			if ( $output_length + $func_strlen( $text ) > $max_length ) {
				$output       .= $func_strcut( $text, 0, $max_length - $output_length );
				$truncated     = true;
				$output_length = $max_length;
				break;
			}

			// store everything, it wasn't too long
			$output        .= $text;
			$output_length += $func_strlen( $text );

			if ( $tag[0] == '&' ) {
				// Handle HTML entity by copying straight through
				$output .= $tag;
				$output_length++; // only counted as one character
			} else {
				// Handle HTML tag
				$tag_inner = $match[1][0];
				if ( $tag[1] == '/' ) {
					// This is a closing tag.
					$output .= $tag;
					// If input tags aren't balanced, we leave the popped tag
					// on the stack so hopefully we're not introducing more
					// problems.

					if ( end( $tag_stack ) == $tag_inner )
						array_pop( $tag_stack );
				} elseif ( $tag[$func_strlen( $tag ) - 2] == '/' || in_array( strtolower( $tag_inner ), $unpaired_tags ) ) {
					// Self-closing or unpaired tag
					$output .= $tag;
				} else {
					// Opening tag.
					$output     .= $tag;
					$tag_stack[] = $tag_inner; // push tag onto the stack
				}
			}

			// Continue after the tag we just found
			$position = $tag_position + $func_strlen( $tag );
		}

		// Print any remaining text after the last tag, if there's room

		if ( $output_length < $max_length && $position < $func_strlen( $html ) )
			$output .= $func_strcut( $html, $position, $max_length - $output_length );

		$truncated = $func_strlen( $html ) - $position > $max_length - $output_length;

		// add terminator if it was truncated in loop or just above here
		if ( $truncated || $force_indicator )
			$output .= $indicator;

		// Close any open tags
		while ( ! empty( $tag_stack ) )
			$output .= '</'.array_pop( $tag_stack ).'>';

		return $output;
	}


}


?>
