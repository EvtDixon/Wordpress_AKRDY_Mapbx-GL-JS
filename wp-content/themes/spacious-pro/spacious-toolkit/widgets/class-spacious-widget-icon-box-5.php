<?php
/**
 * Spacious_Toolkit Elementor Icon box 5 Element
 *
 * @author   ThemeGrill
 * @category Elements
 * @package  Spacious_Toolkit/Elements
 * @version  1.0.0
 */

namespace Elementor;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class SPT_ICON_BOX_5 extends Widget_Base {

	/**
	 * Retrieve SPT_ICON_BOX_5 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-ICON_BOX-5';
	}

	/**
	 * Retrieve SPT_ICON_BOX_5 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Icon Box 5', 'spacious' );
	}

	/**
	 * Retrieve SPT_ICON_BOX_5 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'spacious-econs-icon-box-5';
	}

	/**
	 * Retrieve the list of categories the SPT_ICON_BOX_5 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-toolkit-icon-box-widgets' );
	}

	/**
	 * Register SPT_ICON_BOX_5 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->add_inline_editing_attributes( 'icon-box-caption' );
		$this->add_inline_editing_attributes( 'icon-box-title' );
		$this->add_inline_editing_attributes( 'icon-box-content' );

		spacious_get_controls_template( 'content-widget-icon-box-5.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_ICON_BOX_5 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-icon-box-5.php', $args = array( 'instance' => $this ) );
	}

}
