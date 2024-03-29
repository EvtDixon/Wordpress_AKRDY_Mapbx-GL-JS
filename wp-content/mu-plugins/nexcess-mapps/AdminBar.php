<?php

namespace Nexcess\MAPPS;

use Nexcess\MAPPS\AdminNotice;
use Nexcess\MAPPS\Plugin;
use WP_Admin_Bar;

use const Nexcess\MAPPS\PLUGIN_URL;
use const Nexcess\MAPPS\PLUGIN_VERSION;

class AdminBar {

	/**
	 * @var array[] All of the registered menus.
	 */
	protected $menus = [];

	/**
	 * @var AdminNotice[] A collection of AdminNotices.
	 */
	protected $notices = [];

	/**
	 * The root-level menu ID for the Nexcess Admin Bar menu.
	 */
	const MENU_ID = 'nexcess-mapps';

	/**
	 * Add an AdminNotice.
	 *
	 * @param \Nexcess\MAPPS\AdminNotice $notice The AdminNotice object.
	 * @param string                     $key    Optional. A key to identify the notice. Default is empty.
	 */
	public function addNotice( AdminNotice $notice, $key = '' ) {
		if ( ! empty( $key ) ) {
			$this->notices[ $key ] = $notice;
		} else {
			$this->notices[ $notice->id ] = $notice;
		}
	}

	/**
	 * Retrieve the registered admin notices.
	 *
	 * @return AdminNotice[]
	 */
	public function getNotices() {
		return $this->notices;
	}

	/**
	 * Activate the admin bar.
	 *
	 * This will hook our AdminBar object into WordPress' rendering of the admin bar.
	 */
	public function register() {
		if ( empty( $this->menus ) ) {
			return;
		}

		add_action( 'admin_bar_menu', [ $this, 'registerMenus' ], 1000 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueStylesheet' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStylesheet' ] );
	}

	/**
	 * Register the menus within the global WP_Admin_Bar object.
	 *
	 * @param \WP_Admin_Bar $admin_bar The global WP_Admin_Bar object.
	 */
	public function registerMenus( WP_Admin_Bar $admin_bar ) {
		array_map( [ $admin_bar, 'add_menu' ], $this->menus );
	}

	/**
	 * Enqueue the admin bar stylesheet.
	 */
	public function enqueueStylesheet() {
		if ( ! is_admin_bar_showing() ) {
			return;
		}

		wp_enqueue_style(
			'nexcess-mapps-admin-bar',
			PLUGIN_URL . '/nexcess-mapps/assets/admin-bar.css',
			[ 'admin-bar' ],
			PLUGIN_VERSION,
			'screen'
		);
	}

	/**
	 * Register a new admin menu node.
	 *
	 * @see WP_Admin_Bar::add_menu()
	 *
	 * @param string  $id    The sub-menu ID. Will receive 'nexcess-mapps-' as a prefix.
	 * @param string  $title The anchor text for the menu.
	 * @param mixed[] $args  Optional. Menu arguments. Default is empty.
	 */
	public function addMenu( $id, $title, $args = [] ) {
		if ( empty( $this->menus ) ) {
			$this->menus[ self::MENU_ID ] = $this->getRootMenu();
		}

		$args = wp_parse_args( $args, [
			'id'     => self::MENU_ID . '-' . (string) $id,
			'parent' => self::MENU_ID,
			'group'  => null,
			'title'  => (string) $title,
			'href'   => null,
			'meta'   => [],
		] );

		$this->menus[ $args['id'] ] = $args;
	}

	/**
	 * Retrieve the currently-registered menus.
	 *
	 * @return array[]
	 */
	public function getMenus() {
		return $this->menus;
	}

	/**
	 * Generate an inline form that contains a single button and the corresponding nonce.
	 *
	 * @param string $action The action, which will serve as both the `value` attribute of the
	 *                       button and the `$action` parameter of wp_nonce_field().
	 * @param string $label  The button label.
	 *
	 * @return string The <form> markup.
	 */
	public static function getActionPostForm( $action, $label ) {
		return sprintf(
			'<form method="post" action="%1$s"><button name="action" type="submit" value="%2$s" class="button">%3$s</button>%4$s</form>',
			is_admin() ? '' : admin_url( 'admin-post.php' ),
			esc_attr( $action ),
			esc_html( $label ),
			wp_nonce_field( $action, 'nonce', true, false )
		);
	}

	/**
	 * Verify the presence and validity of the given action in a request.
	 *
	 * This method assumes that URLs are built according to getActionPostForm().
	 *
	 * @param string $action The action to validate.
	 *
	 * @return bool Whether or not the nonce both present and valid.
	 */
	public static function validateActionNonce( $action ) {
		return isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], $action );
	}

	/**
	 * Definition for the top-level menu.
	 *
	 * @return string[]
	 */
	protected function getRootMenu() {
		$icon = '<span class="ab-icon" style="width: 20px;">' . Plugin::getNexcessIcon() . '</span>';

		return [
			'id'    => self::MENU_ID,
			'title' => $icon . esc_html_x( 'Nexcess', 'admin bar menu title', 'nexcess-mapps' ),
		];
	}
}
