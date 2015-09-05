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
		);
	}

	public function getFunctions()
	{
		$conditional_functions = array(
			'is_home' => array( 'allow_args' => false ),
			'is_front_page' => array( 'allow_args' => false ),
			'is_single' => array( 'allow_args' => false ),
			'is_sticky' => array( 'allow_args' => false ),
			'is_page' => array( 'allow_args' => false ),
			'is_category' => array( 'allow_args' => false ),
			'is_tag' => array( 'allow_args' => false ),
			'is_tax' => array( 'allow_args' => false ),
			'is_author' => array( 'allow_args' => false ),
			'is_date' => array( 'allow_args' => false ),
			'is_year' => array( 'allow_args' => false ),
			'is_month' => array( 'allow_args' => false ),
			'is_day' => array( 'allow_args' => false ),
			'is_time' => array( 'allow_args' => false ),
			'is_new_day' => array( 'allow_args' => false ),
			'is_archive' => array( 'allow_args' => false ),
			'is_search' => array( 'allow_args' => false ),
			'is_404' => array( 'allow_args' => false ),
			'is_paged' => array( 'allow_args' => false ),
			'is_attachment' => array( 'allow_args' => false ),
			'is_singular' => array( 'allow_args' => false ),
			'is_feed' => array( 'allow_args' => false ),
			'is_user_logged_in' => array( 'allow_args' => false ),
			'in_category' => array( 'allow_args' => true ),
		);

		$functions = array();
		foreach ( $conditional_functions as $function => $args ) {
			if ( empty( $args['allow_args'] ) ) {
				$functions[] = new \Twig_SimpleFunction( $function, function() use ( $function ) {
					return call_user_func( $function );
				} );
			} else {
				$functions[] = new \Twig_SimpleFunction( $function, function( $args = null ) use ( $function ) {
					return call_user_func( $function, $args );
				} );
			}
		}

		$disabeld_functions = array(
			'constant',
			'include',
			'source',
		);

		foreach ( $disabeld_functions as $function ) {
			$functions[] = new \Twig_SimpleFunction( $function, function() use ( $function ) {
				return $function . '() is disabled.';
			} );
		}

		return $functions;
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
