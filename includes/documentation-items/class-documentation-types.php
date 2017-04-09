<?php
/**
 *  Simple Documentation - Documentation Types
 */

namespace SimpleDocumentation\DocumentationItems;

class DocumentationTypes {
	/**
	 * @var DocumentationTypes
	 */
	private static $instance;

	/**
	 * @var DocumentationType[]
	 */
	public         $types = [];


	/**
	 *  Bootstrap
	 */
	public function bootstrap() {
		$this->register_types();
	}


	/**
	 *  Register Types
	 */
	public function register_types() {
		/**
		 *  Type: Note
		 */
		$this->register(
			'note',
			__( 'Note', 'simple-documentation' ),
			'dashicons-format-aside'
		);

		/**
		 *  Type: Video
		 */
		$this->register(
			'video',
			__( 'Video', 'simple-documentation' ),
			'dashicons-video-alt3'
		);

		/**
		 *  Type: Link
		 */
		$this->register(
			'link',
			__( 'Link', 'simple-documentation' ),
			'dashicons-admin-links'
		);

		/**
		 *  Type: File
		 */
		$this->register(
			'file',
			__( 'File', 'simple-documentation' ),
			'dashicons-media-default'
		);

		// @TODO Make sure it works
		do_action( 'simple_documentation_documentation_types_register', $this );
	}


	/**
	 *  Register Type
	 *
	 *  @param  string  $slug
	 *  @param  string  $label
	 *  @param  string  $icon
	 */
	public function register( $slug, $label, $icon = null ) {
		$type = new DocumentationType(
			$slug,
			$label,
			$icon
		);

		$this->types[ $slug ] = $type;
		$type->setup();
	}


	/**
	 *  Get Documentation Type
	 *
	 *  @param  string  $slug
	 *  @return DocumentationType|false
	 */
	public function get( $slug ) {
		if ( isset( $this->types[ $slug ] ) ) {
			return $this->types[ $slug ];
		}

		return false;
	}


	/**
	 *  Get Default Type
	 *
	 *  @return DocumentationType
	 */
	public function get_default() {
		/**
		 *  @TODO add filter to enable users to change the default type
		 */
		return $this->get( 'note' );
	}


	/**
	 *  Get All Types
	 *
	 *  @return DocumentationType[]
	 */
	public function get_all() {
		return array_values( $this->types );
	}


	/**
	 * Get List of Slugs
	 *
	 * @return string[]
	 */
	public function get_slugs() {
		return array_keys( $this->types );
	}


	/**
	 *  Get Instance
	 *
	 *  @return DocumentationTypes
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}
