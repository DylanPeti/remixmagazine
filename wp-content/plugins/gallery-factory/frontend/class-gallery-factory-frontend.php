<?php
/**
 * @package   Gallery_Factory
 * @author    Vilyon Studio <vilyonstudio@gmail.com>
 * @link      http://galleryfactory.vilyon.net
 * @copyright 2015 Vilyon Studio
 *
 * Class contains frontend-related functionality.
 */

if ( ! class_exists( "VLS_Gallery_Factory_Frontend" ) ) {
	/**
	 * Class VLS_Gallery_Factory_Frontend
	 */
	class VLS_Gallery_Factory_Frontend {

		private static $_instance = null;

		/**
		 * Constructor of the class. Registering hooks here.
		 */
		private function __construct() {

			// register shortcodes
			add_shortcode( 'vls_gf_album', array( $this, 'shortcode_handler_vls_gf_album' ) );

			// enqueue_scripts hook
			add_action( 'wp_enqueue_scripts', array( $this, 'load_stylesheets' ) );

			// print footer script includes
			add_action( 'wp_footer', array( $this, 'print_footer' ) );

		}


		/**
		 * Cloning instances of this class is forbidden.
		 */
		private function __clone() {
		}

		/**
		 * Deserialisation of this class is forbidden.
		 */
		private function __wakeup() {
		}

		/**
		 * Static method for getting class instance
		 * @return null|VLS_Gallery_Factory_Frontend
		 */
		public static function instance() {
			if ( self::$_instance == null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Loads front-end scripts
		 */
		public function load_scripts() {
			//No general scripts needed for now. Layout-related scripts are loaded on shortcode rendering
		}

		/**
		 * Loads stylesheets
		 */
		public function load_stylesheets() {
			wp_enqueue_style( 'vls-gf-style', VLS_GF_PLUGIN_URL . 'frontend/css/style.css' );

			if ( file_exists( VLS_GF_PLUGIN_DIR . 'frontend/css/custom.css' ) ) {
				wp_enqueue_style( 'vls-gf-style-custom', VLS_GF_PLUGIN_URL . 'frontend/css/custom.css' );
			}

		}

		public function print_footer() {
			//pinterest button support
			//echo '<script type="text/javascript" defer="defer" src="//assets.pinterest.com/js/pinit.js" data-pin-build="parsePins"></script>';
		}

		###############################################################
		## shortcode handlers ##
		###############################################################

		/**
		 * Processes [vls_gf_album] shortcode
		 *
		 * @param $atts : attributes specified in the shortcode
		 *
		 * @return string
		 */
		public function shortcode_handler_vls_gf_album( $atts ) {

			//getting and sanitizing shortcode attributes
			$atts     = shortcode_atts(
				array(
					'id' => 0
				),
				$atts
			);
			$album_id = intval( $atts['id'] );

			// getting html content for the first pages
			// TODO: maybe add page count for loading to settings
			$html = $this->get_page_html( $album_id, 1, 3, true );

			// attaching lightboxes according to the setup
			$lightbox = get_option( 'vls_gf_lightbox' );

			if ( $lightbox == 'imagelightbox' ) {
				wp_register_script( 'vls-gf-imagelightbox', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/imagelightbox/imagelightbox.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'vls-gf-imagelightbox-init', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/imagelightbox/imagelightbox-init.js', array(
					'jquery',
					'vls-gf-imagelightbox'
				), false, true );
				wp_enqueue_style( 'vls-gf-imagelightbox-style', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/imagelightbox/imagelightbox.css' );
			} else if ( $lightbox == 'colorbox' ) {
				wp_register_script( 'vls-gf-colorbox', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/colorbox/jquery.colorbox.js', array( 'jquery' ), false, true );
				wp_enqueue_script( 'vls-gf-colorbox-init', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/colorbox/colorbox-init.js', array(
					'jquery',
					'vls-gf-colorbox'
				), false, true );
				wp_enqueue_style( 'vls-gf-colorbox-style', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/colorbox/style2/colorbox.css' );
			} else if ( $lightbox == 'lightbox2' ) {
				wp_enqueue_script( 'vls-gf-lightbox', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/lightbox2/js/lightbox.min.js', array( 'jquery' ), false, true );
				wp_enqueue_style( 'vls-gf-lightbox-style', VLS_GF_PLUGIN_URL . 'frontend/lightboxes/lightbox2/css/lightbox.css' );
			}

			$use_lazy_loading = get_option( 'vls_gf_use_lazy_loading' );

			$dependency_array = array( 'jquery' );
			if ( $use_lazy_loading ) {
				wp_register_script( 'vls-gf-jquery-lazyload', VLS_GF_PLUGIN_URL . 'lib/jquery-lazyload/jquery.lazyload' . ( WP_DEBUG ? '' : '.min' ) . '.js', array( 'jquery' ), VLS_GF_VERSION, true );
				array_push( $dependency_array, 'vls-gf-jquery-lazyload' );
			}

			wp_enqueue_script(
				'vls-gf-frontend-script',
				VLS_GF_PLUGIN_URL . 'frontend/js/script' . ( WP_DEBUG ? '' : '.min' ) . '.js',
				$dependency_array,
				VLS_GF_VERSION, true );

			// Localize the script
			$localization_array = array(
				'ajaxurl'         => admin_url( 'admin-ajax.php' ),
				'btnTextLoadMore' => __( 'Load more', VLS_GF_TEXTDOMAIN )
			);
			wp_localize_script( 'vls-gf-frontend-script', 'vls_gf_script_l10n', $localization_array );

			return $html;

		}

		/**
		 *  Returns album html for a page or page range
		 */
		public function get_page_html( $album_id, $start_page_no, $end_page_no, $standalone ) {

			$view = $this->get_album_view( $album_id );

			if ( array_key_exists('result',  $view) && $view['result'] == 'error' ) {
				return '<div style="color: red; text-align: center; font-weight: bold;" >' .
				       __( 'Gallery Factory error: ', VLS_GF_TEXTDOMAIN ) .
				       $view['message'] .
				       '</div>';
			}

			if ( $end_page_no > $view['total_page_count'] ) {
				$end_page_no = $view['total_page_count'];
			}

			$html = $standalone ? $view['container_open'] : '';

			for ( $page_no = $start_page_no; $page_no <= $end_page_no; $page_no ++ ) {
				$html .= $view['pages'][ $page_no - 1 ];
			}
			$html .= $standalone ? $view['container_close'] : '';

			return $html;

		}


		/**
		 * The function first tries to get html from cached value, if failed calls html generation
		 *
		 * @param $album_id
		 *
		 * @return array
		 */
		function get_album_view( $album_id ) {

			// trying to retrieve the pre-generated view
			$view = get_post_meta( $album_id, '_vls_gf_album_view', true );

			// if no view found, then render it and save to the meta
			if ( empty( $view ) ) {

				$view = $this->render_album( $album_id );

				if ( array_key_exists('result',  $view) && $view['result'] == 'error' ) {
					return $view;
				}

				if ( $view ) {
					add_post_meta( $album_id, '_vls_gf_album_view', $view, true );
				}

			}

			return $view;

		}


		/**
		 * Renders album html
		 */

		public function render_album( $album_id ) {

			global $wpdb;

			if ( $album_id <= 0 ) {
				return array(
					'result' => 'error',
					'message' => __( 'album ID is not set' )
				);
			}

			$album = get_post( $album_id );

			//if an album is not found, display the error message
			if ( $album === null ) {

				return array(
					'result' => 'error',
					'message' => sprintf( __( 'album with ID "%1$s" not found', VLS_GF_TEXTDOMAIN ), $album_id )
				);
			}

			$album_layout_meta = get_post_meta( $album_id, '_vls_gf_layout_meta', true );

			if ( empty( $album_layout_meta ) ) {
				return array(
					'result' => 'error',
					'message' => sprintf( __( 'the layout data for the album (ID %1$s) is not found, update the layout', VLS_GF_TEXTDOMAIN ), $album_id )
				);
			}

			$album_item_meta = get_post_meta( $album_id, '_vls_gf_item_meta', true );

			//getting display options, globals with album-specific overrides if provided

			$album->lightbox = get_option( 'vls_gf_lightbox' );

			$album->display_image_info_on_hover = (
				empty( $album_item_meta ) || ! array_key_exists( 'display_image_info_on_hover', $album_item_meta ) || (
					array_key_exists( 'display_image_info_on_hover', $album_item_meta )
					&& $album_item_meta['display_image_info_on_hover'] == 'global'
				) ) ? get_option( 'vls_gf_display_image_info_on_hover' ) : $album_item_meta['display_image_info_on_hover'];

			$album->pagination_type = (
				empty( $album_item_meta ) || ! array_key_exists( 'pagination_type', $album_item_meta ) || (
					array_key_exists( 'pagination_type', $album_item_meta )
					&& $album_item_meta['pagination_type'] == 'global'
				) ) ? get_option( 'vls_gf_pagination_type' ) : $album_item_meta['pagination_type'];


			if ( $album->pagination_type === 'none' ) {
				$album->pagination_page_size = 99999999; //value large enough to put all images in one page
			} else {
				if ( empty( $album_item_meta ) || ! array_key_exists( 'pagination_page_size', $album_item_meta ) || (
						array_key_exists( 'pagination_page_size', $album_item_meta )
						&& $album_item_meta['pagination_page_size'] <= 0 )
				) {
					$col_count                   = intval( $album_layout_meta['column_count'] );
					$album->pagination_page_size = intval( floor( $col_count * floatval( get_option( 'vls_gf_pagination_page_size' ) ) ) );
					if ( $album->pagination_page_size <= 0 ) {
						$album->pagination_page_size = 1;
					}
				} else {
					$album->pagination_page_size = absint( $album_item_meta['pagination_page_size'] );
				}
			}

			$album->pagination_style = (
				empty( $album_item_meta ) || ! array_key_exists( 'pagination_style', $album_item_meta ) || (
					array_key_exists( 'pagination_style', $album_item_meta )
					&& $album_item_meta['pagination_style'] == 'global'
				) ) ? get_option( 'vls_gf_pagination_style' ) : $album_item_meta['pagination_style'];


			//Pagination
			$album->pagination_class = '';
			if ( $album->pagination_type == 'paged-numbers' ) {
				$album->pagination_class = 'vls-gf-paginated-paged-numbers ';
			} else if ( $album->pagination_type == 'paged-bullets' ) {
				$album->pagination_class = 'vls-gf-paginated-paged-bullets ';
			} else if ( $album->pagination_type == 'load-more' ) {
				$album->pagination_class = 'vls-gf-paginated-load-more ';
			} else if ( $album->pagination_type == 'load-scroll' ) {
				$album->pagination_class = 'vls-gf-paginated-load-scroll ';
			}

			if ( $album->pagination_class != '' ) {
				if ( $album->pagination_style == 'dark' ) {
					$album->pagination_class .= 'vls-gf-style-dark ';
				} else if ( $album->pagination_style == 'custom' ) {
					$album->pagination_class .= 'vls-gf-style-custom ';
				} else {
					$album->pagination_class .= 'vls-gf-style-light ';
				}
			}

			// Class for info display
			$album->info_display_class = 'vls-gf-album-info-none';
			if ( $album->display_image_info_on_hover == 'caption' ) {
				$album->info_display_class = 'vls-gf-album-info-caption';
			} else if ( $album->display_image_info_on_hover == 'all' ) {
				$album->info_display_class = 'vls-gf-album-info-all';
			}


			//getting album images
			$images = $wpdb->get_results(
				$wpdb->prepare( "
                    SELECT
                      link.ID as link_id, image.ID as image_id, IFNULL(url_meta.meta_value, link.guid) as url,
                      image.post_excerpt as caption, image.post_content as description
                    FROM $wpdb->posts link
                    INNER JOIN $wpdb->posts image
                    ON
                      link.post_type=%s
                      AND image.post_type=%s
                      AND CAST(link.post_name AS UNSIGNED) = image.ID
                      AND link.post_parent = %d
                    LEFT OUTER JOIN $wpdb->postmeta url_meta
                    ON url_meta.post_id = image.ID AND url_meta.meta_key = %s
                    ORDER BY link.menu_order ASC",
					VLS_GF_POST_TYPE_ALBUM_IMAGE,
					VLS_GF_POST_TYPE_IMAGE,
					$album_id,
					'_vls_gf_url'
				)
			);

			//preparing image data
			foreach ( $images as $image ) {

				$image->url_preview_m = VLS_Gallery_Factory::_get_image_url( $image->url, 'preview-m' );
				//stripping timestamp from the url
				preg_match( '~(.*)\?[^?]+$~', $image->url, $preg_result );
				if ( count( $preg_result ) > 1 ) {
					$image->url = $preg_result[1];
				}

				$image->alt_text = get_post_meta( $image->image_id, '_vls_gf_image_alt_text', true );

				$image_post_meta = get_post_meta( $image->image_id, '_vls_gf_image_meta', true );

				$image->width  = isset( $image_post_meta['preview_width'] ) ? $image_post_meta['preview_width'] : $image_post_meta['width'];
				$image->height = isset( $image_post_meta['preview_height'] ) ? $image_post_meta['preview_height'] : $image_post_meta['height'];

				$image_layout_meta = get_post_meta( $image->link_id, '_vls_gf_layout_meta', true );
				$image->col        = isset( $image_layout_meta['col'] ) ? $image_layout_meta['col'] : 0;
				$image->row        = isset( $image_layout_meta['row'] ) ? $image_layout_meta['row'] : 0;
				$image->metro_w    = isset( $image_layout_meta['metro_w'] ) ? $image_layout_meta['metro_w'] : 1;
				$image->metro_h    = isset( $image_layout_meta['metro_h'] ) ? $image_layout_meta['metro_h'] : 1;

				//album-specific image meta (for custom URL link)
				$link_image_meta    = get_post_meta( $image->link_id, '_vls_gf_image_meta', true );
				$image->link_target = '';
				if ( ! empty( $link_image_meta ) && array_key_exists( 'click_action', $link_image_meta ) ) {
					if ( $link_image_meta['click_action'] == 'lightbox' && array_key_exists( 'link_url', $link_image_meta ) && ! empty( $link_image_meta['link_url'] ) ) {
						$image->url = $link_image_meta['link_url'];
					} else if ( $link_image_meta['click_action'] == 'redirect' ) {
						if ( ! empty( $link_image_meta ) && array_key_exists( 'link_url', $link_image_meta ) ) {
							$image->url = $link_image_meta['link_url'];
						}
						if ( ! empty( $link_image_meta ) && array_key_exists( 'link_target', $link_image_meta ) ) {
							$image->link_target = $link_image_meta['link_target'];
						}
					} else if ( $link_image_meta['click_action'] == 'page' ) {
						$image->url = get_permalink( $image->image_id );
						if ( ! empty( $link_image_meta ) && array_key_exists( 'link_target', $link_image_meta ) ) {
							$image->link_target = $link_image_meta['link_target'];
						}
					} else if ( $link_image_meta['click_action'] == 'none' ) {
						$image->url = '';
					}
				}

				//replace [url] BB code for url link with the <a> tag
				$image->lightbox_caption     = preg_replace( '@\[url=([^]]*)\]([^[]*)\[/url\]@', '<a href=&quot;$1\&quot;>$2</a>', $image->caption );
				$image->lightbox_description = preg_replace( '@\[url=([^]]*)\]([^[]*)\[/url\]@', '<a href=&quot;$1\&quot;>$2</a>', $image->description );

				//replace [link_open] BB code for url link with the <a> tag
				$image->lightbox_caption     = preg_replace( '@\[link_open=([^]]*)\]([^[]*)\[/link_open\]@', '<a href=&quot;$1\&quot; onclick=&quot;window.open(this.href); return false;&quot;>$2</a>', $image->lightbox_caption );
				$image->lightbox_description = preg_replace( '@\[link_open=([^]]*)\]([^[]*)\[/link_open\]@', '<a href=&quot;$1\&quot; onclick=&quot;window.open(this.href); return false;&quot;>$2</a>', $image->lightbox_description );


				//strip bb-code from the caption
				$image->caption     = preg_replace( '@\[url=([^]]*)\]([^[]*)\[/url\]@', '$2', $image->caption );
				$image->description = preg_replace( '@\[url=([^]]*)\]([^[]*)\[/url\]@', '$2', $image->description );
				$image->caption     = preg_replace( '@\[link_open=([^]]*)\]([^[]*)\[/link_open\]@', '$2', $image->caption );
				$image->description = preg_replace( '@\[link_open=([^]]*)\]([^[]*)\[/link_open\]@', '$2', $image->description );

			}


			if ( $album_layout_meta['layout_type'] === 'grid' ) {
				return $this->render_album_grid( $album, $album_layout_meta, $images );
			} else if ( $album_layout_meta['layout_type'] === 'metro' ) {
				return $this->render_album_metro( $album, $album_layout_meta, $images );
			}

			return false;


		}

		###############################################################
		## album layouts render functions                            ##
		###############################################################

		/**
		 * Renders Grid-type layout
		 *
		 * @param $album : album data
		 * @param $album_layout_meta : layout meta
		 * @param $images : image data
		 *
		 * @return string
		 */
		private function render_album_grid( $album, $album_layout_meta, $images ) {

			//prepare data structure for the template


			$view_pages         = array();
			$data               = array();
			$page_data          = array();
			$row_data           = array();
			$page               = 1;
			$row                = 1;
			$col                = 0;
			$col_count          = intval( $album_layout_meta['column_count'] );
			$aspect             = $album_layout_meta['aspect_ratio'];
			$vertical_spacing   = $album_layout_meta['vertical_spacing'];
			$horizontal_spacing = $album_layout_meta['horizontal_spacing'];

			//just a guess about which row should be above the fold or a bit lower
			if ( get_option( 'vls_gf_use_lazy_loading' ) ) {
				$rows_above_fold = $col_count;
			} else { //no lazy loading, load really a lot of rows
				$rows_above_fold = 99999999;
			}


			foreach ( $images as $image ) {

				$col += 1;

				if ( $col > $col_count ) {
					array_push( $page_data, $row_data );
					$row_data = array();
					$col      = 1;
					$row += 1;
				}

				if ( $row > $page * $album->pagination_page_size ) {
					array_push( $data, $page_data );
					$page_data = array();
					$page += 1;
				}

				//TODO: move it to the common style
				$image->a_style        = 'padding-top:' . strval( round( 100 / $aspect, 4 ) ) . '%';
				$image->spacings_style = '';

				//spacings
				if ( $horizontal_spacing > 0 ) {
					$image->spacings_style .= 'margin-right:' . $horizontal_spacing . 'px; ';
				}
				if ( $vertical_spacing > 0 ) {
					$image->spacings_style .= 'margin-bottom:' . $vertical_spacing . 'px; ';
				}

				//determining class for proper image sizing
				$image_aspect     = $image->width / $image->height;
				$image->img_class = ( $aspect > $image_aspect ) ? 'vls-gf-tall' : 'vls-gf-wide';

				//if an image is above the fold, load with the page - else enable lazy loading
				$image->lazy_load = ( $row > $rows_above_fold );

				array_push( $row_data, $image );

			}

			//insert last row data
			array_push( $page_data, $row_data );

			//insert last page data
			array_push( $data, $page_data );

			//rendering
			$page = 0;
			foreach ( $data as $page_data ) {
				$page ++;
				ob_start();
				require( VLS_GF_PLUGIN_DIR . 'frontend/templates/tmpl-album-grid.php' );
				array_push( $view_pages, preg_replace( '/>\s+</m', '><', ob_get_clean() ) );
			}

			$total_pages = count( $view_pages );

			$view['container_open'] = '<div class="vls-gf-album vls-gf-album-grid '
			                          . $album->pagination_class . $album->info_display_class
			                          . '" data-vls-gf-album-id="' . $album->ID
			                          . '" data-vls-gf-total-pages="' . $total_pages
			                          . '" style="margin-right:-' . $horizontal_spacing . 'px;"><div class="vls-gf-thumbnail-container">';

			$view['total_page_count'] = $total_pages;

			$view['pages'] = $view_pages;

			$view['container_close'] = '</div><div class="vls-gf-clear"></div></div>';

			return $view;

		}

		/**
		 * Renders Mentro-type layout
		 *
		 * @param $album : album data
		 * @param $album_layout_meta : layout meta
		 * @param $images : image data
		 *
		 * @return string
		 */
		private function render_album_metro( $album, $album_layout_meta, $images ) {

			$view_pages = array();
			$view       = array();
			$data       = array();
			$page_data  = array();
			$page       = 1;

			//preparing album data
			$album->aspect_ratio       = $album_layout_meta['aspect_ratio'];
			$album->horizontal_spacing = $album_layout_meta['horizontal_spacing'];
			$album->vertical_spacing   = $album_layout_meta['vertical_spacing'];
			$album->column_count       = $album_layout_meta['column_count'];

			//just a guess about which row should be above the fold or a bit lower
			if ( get_option( 'vls_gf_use_lazy_loading' ) ) {
				$rows_above_fold = $album->column_count;
			} else { //no lazy loading, load really a lot of rows
				$rows_above_fold = 99999999;
			}

			//preparing image data
			foreach ( $images as $image ) {

				if ( ( $image->row + 1 ) > $page * $album->pagination_page_size ) {
					array_push( $data, $page_data );
					$page_data = array();
					$page += 1;
				}

				//item aspect will be more precisely recalculated on the client
				$item_aspect         = $album->aspect_ratio * $image->metro_w / $image->metro_h;
				$image->image_aspect = $image->width / $image->height;
				$image->img_class    = ( $item_aspect > $image->image_aspect ) ? 'vls-gf-tall' : 'vls-gf-wide';

				//if an image is above the fold, load with the page - else enable lazy loading
				$image->lazy_load = ( $image->row > $rows_above_fold );

				array_push( $page_data, $image );

			}

			//insert last page data
			array_push( $data, $page_data );

			//rendering
			$page = 0;
			foreach ( $data as $page_data ) {
				$page ++;
				ob_start();
				require( VLS_GF_PLUGIN_DIR . 'frontend/templates/tmpl-album-metro.php' );
				array_push( $view_pages, preg_replace( '/>\s+</m', '><', ob_get_clean() ) );
			}


			$total_pages = count( $view_pages );

			$view['container_open'] = '<div class="vls-gf-album vls-gf-album-metro no-js '
			                          . $album->pagination_class . $album->info_display_class
			                          . '" data-vls-gf-album-id="' . $album->ID
			                          . '" data-vls-gf-total-pages="' . $total_pages
			                          . '" data-vls-gf-aspect-ratio="' . $album->aspect_ratio
			                          . '" data-vls-gf-horizontal-spacing="' . $album->horizontal_spacing
			                          . '" data-vls-gf-vertical-spacing="' . $album->vertical_spacing
			                          . '" data-vls-gf-column-count="' . $album->column_count
			                          . '"><div class="vls-gf-thumbnail-container">';


			$view['total_page_count'] = $total_pages;

			$view['pages'] = $view_pages;

			$view['container_close'] = '</div></div>';

			return $view;

		}
	}
}

return VLS_Gallery_Factory_Frontend::instance();
