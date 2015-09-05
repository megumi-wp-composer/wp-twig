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
			'is_home',
			'is_front_page',
			'is_single',
			'is_sticky',
			'is_page',
			'is_category'
			'is_tag',
			'is_tax',
			'is_author',
			'is_date',
			'is_year',
			'is_month',
			'is_day',
			'is_time',
			'is_new_day',
			'is_archive',
			'is_search',
			'is_404',
			'is_paged',
			'is_attachment',
			'is_singular',
			'is_feed',
			'is_user_logged_in',
			'in_category',
		);

		$functions = array();
		foreach ( $conditional_functions as $function ) {
			$functions[] = new \Twig_SimpleFunction( $function, function( $args = null ) use ( $function ) {
				return call_user_func( $function, $args );
			} );
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
