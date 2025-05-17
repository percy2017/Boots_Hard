<?php
/**
 * Custom Walker for Bootstrap 5 Navwalker
 *
 * @package Boots_Hard
 */

if ( ! class_exists( 'Boots_Hard_Bootstrap_Navwalker' ) ) {
	/**
	 * Bootstrap 5 Navwalker
	 *
	 * @see https://github.com/wp-bootstrap/wp-bootstrap-navwalker
	 */
	class Boots_Hard_Bootstrap_Navwalker extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			// Default class to add to the file.
			$classes = array( 'dropdown-menu' );
			// Add Bootstrap's dropdown-menu-end class.
			if ( $this->is_dropdown_menu_end( $args ) ) {
				$classes[] = 'dropdown-menu-end';
			}
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$output     .= "{$n}{$indent}<ul class=\"{$class_names}\">{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @see Walker_Nav_Menu::start_el()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param WP_Post $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			// Add Bootstrap's nav-item class.
			$classes[] = 'nav-item';

			// Add active class to the current menu item.
			if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) || in_array( 'current-menu-ancestor', $classes, true ) ) {
				$classes[] = 'active';
			}

			// Add Bootstrap's dropdown class to the top-level parent.
			if ( $args->walker->has_children ) {
				$classes[] = 'dropdown';
			}

			// Add Bootstrap's disabled class.
			if ( in_array( 'disabled', $classes, true ) ) {
				$classes[] = 'disabled';
			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts             = array();
			$atts['title']    = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target']   = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']      = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']     = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-haspopup'] = $args->walker->has_children ? 'true' : '';
			$atts['aria-expanded'] = 'false';

			// Add Bootstrap's nav-link class.
			$atts['class'] = 'nav-link';

			// Add Bootstrap's active class to the current menu item.
			if ( in_array( 'active', $classes, true ) ) {
				$atts['class'] .= ' active';
			}

			// Add Bootstrap's disabled class.
			if ( in_array( 'disabled', $classes, true ) ) {
				$atts['class'] .= ' disabled';
			}

			// Add Bootstrap's dropdown-toggle class to the top-level parent.
			if ( $args->walker->has_children ) {
				$atts['class'] .= ' dropdown-toggle';
				$atts['role']   = 'button';
				$atts['data-bs-toggle'] = 'dropdown';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_elements', $item_output, $item, $depth, $args, $id );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @since 3.0.0
		 * @see Walker_Nav_Menu::end_el()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param WP_Post $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu().
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$n = '';
			} else {
				$n = "\n";
			}
			$output .= "</li>{$n}";
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element is valid.
		 *
		 * @see Walker::display_element()
		 * @since 3.0.0
		 *
		 * @param WP_Post $element           Data object.
		 * @param array   $children_elements List of elements to continue traversing.
		 * @param int     $max_depth         Max depth to traverse.
		 * @param int     $depth             Depth of current element.
		 * @param array   $args              An array of arguments. @see wp_nav_menu().
		 * @param string  $output            Used to append additional content (passed by reference).
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return;
			}

			$id_field = $this->db_fields['id'];
			$id       = $element->$id_field;

			// Display this element.
			$this->has_children = ! empty( $children_elements[ $id ] );
			if ( isset( $args[0] ) && is_array( $args[0] ) ) {
				$args[0]['has_children'] = $this->has_children; // Backwards compatibility.
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 *
		 * If the menu doesn't exists, Bootstrap will show a dummy menu.
		 *
		 * @param array $args arguments.
		 * @return string
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				// Translators: %s: Link to create a new menu.
				$link = sprintf( esc_html__( 'Add a menu', 'boots-hard' ), esc_url( admin_url( 'nav-menus.php' ) ) );
				$args['after'] = '<li class="nav-item"><a class="nav-link" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $link . '</a></li>';
			}
		}

		/**
		 * Check if the dropdown menu should be aligned to the end.
		 *
		 * @param array $args An array of arguments. @see wp_nav_menu().
		 * @return bool
		 */
		private function is_dropdown_menu_end( $args ) {
			if ( ! empty( $args->dropdown_menu_end ) ) {
				return true;
			}

			return false;
		}
	}
}