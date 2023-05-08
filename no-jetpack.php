<?php
/**
 * Plugin Name:  No Jetpack
 * Description:  Provides post types functionality from Jetpack plugin without using Jetpack plugin.
 * License:      GNU General Public License v3
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Requires PHP: 7.0
 *
 * This code is adapted from Jetpack code in GitHub repository:
 * @link  https://github.com/Automattic/jetpack/tree/trunk/projects/plugins/jetpack
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Jetpack' ) ) {

	class Jetpack {

		public static function is_active() {
			return true;
		}

		public static function init() {
			add_action( 'init', __CLASS__ . '::register_post_type_portfolio' );
			add_action( 'init', __CLASS__ . '::register_post_type_testimonial' );
		}

		/**
		 * Code adapted from:
		 * @link  https://github.com/Automattic/jetpack/blob/trunk/projects/plugins/jetpack/modules/custom-post-types/portfolios.php
		 */
		public static function register_post_type_portfolio() {

			$post_type = 'jetpack-portfolio';
			$tax_type  = 'jetpack-portfolio-type';
			$tax_tag   = 'jetpack-portfolio-tag';

			if ( post_type_exists( $post_type ) ) {
				return;
			}

			register_post_type(
				$post_type,
				array(
					'labels'          => array(
						'name'                  => esc_html__( 'Projects', 'jetpack' ),
						'singular_name'         => esc_html__( 'Project', 'jetpack' ),
						'menu_name'             => esc_html__( 'Portfolio', 'jetpack' ),
						'all_items'             => esc_html__( 'All Projects', 'jetpack' ),
						'add_new'               => esc_html__( 'Add New', 'jetpack' ),
						'add_new_item'          => esc_html__( 'Add New Project', 'jetpack' ),
						'edit_item'             => esc_html__( 'Edit Project', 'jetpack' ),
						'new_item'              => esc_html__( 'New Project', 'jetpack' ),
						'view_item'             => esc_html__( 'View Project', 'jetpack' ),
						'search_items'          => esc_html__( 'Search Projects', 'jetpack' ),
						'not_found'             => esc_html__( 'No Projects found', 'jetpack' ),
						'not_found_in_trash'    => esc_html__( 'No Projects found in Trash', 'jetpack' ),
						'filter_items_list'     => esc_html__( 'Filter projects list', 'jetpack' ),
						'items_list_navigation' => esc_html__( 'Project list navigation', 'jetpack' ),
						'items_list'            => esc_html__( 'Projects list', 'jetpack' ),
					),
					'supports'        => array(
						'title',
						'editor',
						'thumbnail',
						'author',
						'post-formats',
						'comments',
						'publicize',
						'wpcom-markdown',
						'revisions',
						'excerpt',
						'custom-fields',
						'newspack_blocks',
					),
					'rewrite'         => array(
						'slug'       => 'portfolio',
						'with_front' => false,
						'feeds'      => true,
						'pages'      => true,
					),
					'public'          => true,
					'show_ui'         => true,
					'menu_position'   => 20,
					'menu_icon'       => 'dashicons-portfolio',
					'capability_type' => 'page',
					'map_meta_cap'    => true,
					'taxonomies'      => array( $tax_type, $tax_tag ),
					'has_archive'     => true,
					'query_var'       => 'portfolio',
					'show_in_rest'    => true,
				)
			);

			register_taxonomy(
				$tax_type,
				$post_type,
				array(
					'hierarchical'      => true,
					'labels'            => array(
						'name'                  => esc_html__( 'Project Types', 'jetpack' ),
						'singular_name'         => esc_html__( 'Project Type', 'jetpack' ),
						'menu_name'             => esc_html__( 'Project Types', 'jetpack' ),
						'all_items'             => esc_html__( 'All Project Types', 'jetpack' ),
						'edit_item'             => esc_html__( 'Edit Project Type', 'jetpack' ),
						'view_item'             => esc_html__( 'View Project Type', 'jetpack' ),
						'update_item'           => esc_html__( 'Update Project Type', 'jetpack' ),
						'add_new_item'          => esc_html__( 'Add New Project Type', 'jetpack' ),
						'new_item_name'         => esc_html__( 'New Project Type Name', 'jetpack' ),
						'parent_item'           => esc_html__( 'Parent Project Type', 'jetpack' ),
						'parent_item_colon'     => esc_html__( 'Parent Project Type:', 'jetpack' ),
						'search_items'          => esc_html__( 'Search Project Types', 'jetpack' ),
						'items_list_navigation' => esc_html__( 'Project type list navigation', 'jetpack' ),
						'items_list'            => esc_html__( 'Project type list', 'jetpack' ),
					),
					'public'            => true,
					'show_ui'           => true,
					'show_in_nav_menus' => true,
					'show_in_rest'      => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => 'project-type' ),
				)
			);

			register_taxonomy(
				$tax_tag,
				$post_type,
				array(
					'hierarchical'      => false,
					'labels'            => array(
						'name'                       => esc_html__( 'Project Tags', 'jetpack' ),
						'singular_name'              => esc_html__( 'Project Tag', 'jetpack' ),
						'menu_name'                  => esc_html__( 'Project Tags', 'jetpack' ),
						'all_items'                  => esc_html__( 'All Project Tags', 'jetpack' ),
						'edit_item'                  => esc_html__( 'Edit Project Tag', 'jetpack' ),
						'view_item'                  => esc_html__( 'View Project Tag', 'jetpack' ),
						'update_item'                => esc_html__( 'Update Project Tag', 'jetpack' ),
						'add_new_item'               => esc_html__( 'Add New Project Tag', 'jetpack' ),
						'new_item_name'              => esc_html__( 'New Project Tag Name', 'jetpack' ),
						'search_items'               => esc_html__( 'Search Project Tags', 'jetpack' ),
						'popular_items'              => esc_html__( 'Popular Project Tags', 'jetpack' ),
						'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'jetpack' ),
						'add_or_remove_items'        => esc_html__( 'Add or remove tags', 'jetpack' ),
						'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', 'jetpack' ),
						'not_found'                  => esc_html__( 'No tags found.', 'jetpack' ),
						'items_list_navigation'      => esc_html__( 'Project tag list navigation', 'jetpack' ),
						'items_list'                 => esc_html__( 'Project tag list', 'jetpack' ),
					),
					'public'            => true,
					'show_ui'           => true,
					'show_in_nav_menus' => true,
					'show_in_rest'      => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => 'project-tag' ),
				)
			);

			register_taxonomy_for_object_type( 'post_format', $post_type );
		}

		/**
		 * Code adapted from:
		 * @link  https://github.com/Automattic/jetpack/blob/trunk/projects/plugins/jetpack/modules/custom-post-types/testimonial.php
		 */
		public static function register_post_type_testimonial() {

			$post_type = 'jetpack-testimonial';

			if ( post_type_exists( $post_type ) ) {
				return;
			}

			register_post_type(
				$post_type,
				array(
					'description'     => __( 'Customer Testimonials', 'jetpack' ),
					'labels'          => array(
						'name'                  => esc_html__( 'Testimonials', 'jetpack' ),
						'singular_name'         => esc_html__( 'Testimonial', 'jetpack' ),
						'menu_name'             => esc_html__( 'Testimonials', 'jetpack' ),
						'all_items'             => esc_html__( 'All Testimonials', 'jetpack' ),
						'add_new'               => esc_html__( 'Add New', 'jetpack' ),
						'add_new_item'          => esc_html__( 'Add New Testimonial', 'jetpack' ),
						'edit_item'             => esc_html__( 'Edit Testimonial', 'jetpack' ),
						'new_item'              => esc_html__( 'New Testimonial', 'jetpack' ),
						'view_item'             => esc_html__( 'View Testimonial', 'jetpack' ),
						'search_items'          => esc_html__( 'Search Testimonials', 'jetpack' ),
						'not_found'             => esc_html__( 'No Testimonials found', 'jetpack' ),
						'not_found_in_trash'    => esc_html__( 'No Testimonials found in Trash', 'jetpack' ),
						'filter_items_list'     => esc_html__( 'Filter Testimonials list', 'jetpack' ),
						'items_list_navigation' => esc_html__( 'Testimonial list navigation', 'jetpack' ),
						'items_list'            => esc_html__( 'Testimonials list', 'jetpack' ),
					),
					'supports'        => array(
						'title',
						'editor',
						'thumbnail',
						'page-attributes',
						'revisions',
						'excerpt',
						'newspack_blocks',
					),
					'rewrite'         => array(
						'slug'       => 'testimonial',
						'with_front' => false,
						'feeds'      => false,
						'pages'      => true,
					),
					'public'          => true,
					'show_ui'         => true,
					'menu_position'   => 20, // below Pages
					'menu_icon'       => 'dashicons-testimonial',
					'capability_type' => 'page',
					'map_meta_cap'    => true,
					'has_archive'     => true,
					'query_var'       => 'testimonial',
					'show_in_rest'    => true,
				)
			);
		}
	}

	Jetpack::init();

	require_once plugin_dir_path( __FILE__ ) . 'class-status.php';
}
