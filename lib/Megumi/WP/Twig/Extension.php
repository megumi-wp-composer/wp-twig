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
		);
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

	public function getName()
	{
		return 'wp';
	}
}
