<?php

namespace Megumi\WP;

class Twig_Extension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter( 'esc_html', array( $this, 'esc_html' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'esc_attr', array( $this, 'esc_attr' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'esc_textarea', array( $this, 'esc_textarea' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'esc_url', array( $this, 'esc_url' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'esc_js', array( $this, 'esc_js' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'apply_filters', array( $this, 'apply_filters' ) ),

			new \Twig_SimpleFilter( 'the_permalink', array( $this, 'the_permalink' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'the_post_thumbnail', array( $this, 'the_post_thumbnail' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'the_excerpt', array( $this, 'the_excerpt' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'the_content', array( $this, 'the_content' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'the_author', array( $this, 'the_author' ), array( 'is_safe' => array( 'html' ) ) ),
			new \Twig_SimpleFilter( 'the_date', array( $this, 'the_date' ), array( 'is_safe' => array( 'html' ) ) ),
		);
	}

	/**
	 * Get the date.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @param string $d Optional. PHP date format defaults to the date_format option if not specified.
	 * @return string $date The date.
	 */
	public function the_date( $post, $d = '' )
	{
		$post = get_post( $post );
		$user = get_user_by( 'id', $post->post_author );

 		return get_the_date( $d, $post );
	}

	/**
	 * Get the author.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @return string $author The author.
	 */
	public function the_author( $post )
	{
		$post = get_post( $post );
		$user = get_user_by( 'id', $post->post_author );

 		return apply_filters( 'the_author', $user->data->display_name );
	}

	/**
	 * Get the excerpt.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @return string $content The content.
	 */
	public function the_content( $post )
	{
		$post = get_post( $post );
		return apply_filters( 'the_content', $post->post_content );
	}

	/**
	 * Get the excerpt.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @return string $excerpt The excerpt of the post.
	 */
	public function the_excerpt( $post )
	{
		$post = get_post( $post );
		return apply_filters( 'the_excerpt', $post->post_excerpt );
	}

	/**
	 * Get the permlink.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @return string $permalink The permalink of the post.
	 */
	public function the_permalink( $post )
	{
		return apply_filters( 'the_permalink', get_the_permalink( $post ) );
	}

	/**
	 * Get the post thumbnail.
	 *
	 * @param int|object $post Post's ID or WP_Post object.
	 * @return string $permalink The post thumbnail
	 */
	public function the_post_thumbnail( $post, $size = 'post-thumbnail' )
	{
		if ( is_object( $post ) && 'WP_Post' === get_class( $post ) ) {
			$post_id = $post->ID;
		} elseif ( intval( $post ) ) {
			$post_id = $post;
		} else {
			return;
		}

		if ( has_post_thumbnail( $post_id ) ) {
			return get_the_post_thumbnail( $post_id, $size );
		}
	}

	public function esc_html( $content )
	{
		return esc_html( $content );
	}

	public function esc_attr( $content )
	{
		return esc_attr( $content );
	}

	public function esc_textarea( $content )
	{
		return esc_textarea( $content );
	}

	public function esc_url( $content )
	{
		return esc_url( $content );
	}

	public function esc_js( $content )
	{
		return esc_js( $content );
	}

	public function apply_filters( $content, $filter )
	{
		return apply_filters( $filter, $content );
	}

	public function getName()
	{
		return 'wp';
	}
}
