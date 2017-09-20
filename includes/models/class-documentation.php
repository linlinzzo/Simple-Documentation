<?php
/**
 * Documentation Item
 */

namespace SimpleDocumentation\Models;

use SimpleDocumentation\Plugin_Page;

final class Documentation extends Post_Type {
	/**
	 * Post type
	 */
	const POST_TYPE = 'simpledocumentation';

	/**
	 * Highlight meta property name
	 */
	const META_HIGHLIGHT = 'simpledoc_item_highlight';

	/**
	 * Get Documentation Item Edition Screen URL
	 *
	 * @return string
	 */
	public function get_edit_link() {
		return add_query_arg(
			[
				'post' => $this->get_id(),
				'action' => 'edit',
			],
			admin_url( 'post.php' )
		);
	}

	/**
	 * Get the 'single' url for this item.
	 *
	 * @return string
	 */
	public function get_view_link() {
		return Plugin_Page::instance()->get_view_link_for_item( $this );
	}


	/**
	 * Whether the item has attachments attached or not.
	 *
	 * @return bool
	 */
	public function has_attachments() {
		return ! empty( $this->get_attachments() );
	}


	/**
	 * Whether the item has a featured video attached or not.
	 *
	 * @return bool
	 */
	public function has_video() {
		return ! empty( $this->get_video() );
	}

	/**
	 * Whether or not we should display a text-based content in our template or not.
	 *
	 * @return bool
	 */
	public function has_content() {
		return ! empty( $this->get_content() );
	}

	/**
	 * @return array
	 */
	public function get_attachments() {
		/**
		 * @TODO implement get_attachments
		 */
		return [];
	}

	/**
	 * @return bool
	 */
	public function get_video() {
		/**
		 * @TODO implement get_video
		 */
		return false;
	}

	/**
	 * @param Documentation_Type $type
	 */
	public function update_type( $type ) {
		wp_set_object_terms(
			$this->get_id(),
			[ $type->get_id() ],
			Documentation_Type::TAXONOMY,
			false
		);
	}

	/**
	 * @return bool|Documentation_Type
	 */
	public function get_type() {
		$type = Documentation_Type::get_for_post( $this->get_post() );

		if ( ! empty( $type ) ) {
			return $type[0];
		}

		return false;
	}


	/**
	 *  == Static ==
	 */

	/**
	 * Register
	 *
	 * @param array $custom_args
	 *
	 * @return \WP_Error|\WP_Post_Type
	 */
	public static function register( $custom_args = [] ) {
		$labels = array(
			'name' => __( 'Documentation Items', 'simple-documentation' ),
			'singular_name' => __( 'Simple Documentation', 'simple-documentation' ),
			'add_new' => __( 'Add New' , 'simple-documentation' ),
			'add_new_item' => __( 'Add New Item' , 'simple-documentation' ),
			'edit_item' => __( 'Edit Item' , 'simple-documentation' ),
			'new_item' => __( 'New Item' , 'simple-documentation' ),
			'view_item' => __( 'View Item', 'simple-documentation' ),
			'search_items' => __( 'Search Items', 'simple-documentation' ),
			'not_found' => __( 'No Items found', 'simple-documentation' ),
			'not_found_in_trash' => __( 'No Items found in Trash', 'simple-documentation' ),
		);

		return parent::register( wp_parse_args( $custom_args, [
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'rewrite' => false,
			'supports' => [
				'title',
				'editor',
				'revisions',
			],
			'show_in_menu' => false,
		]));
	}
}
