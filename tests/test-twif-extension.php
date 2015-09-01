<?php

class Twig_Extension_Test extends WP_UnitTestCase
{
	/**
	 * @test
	 */
	public function esc_html()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( '{{ var | esc_html }}', array( 'var' => '<strong>' ) );
		$this->assertSame( '&lt;strong&gt;', $content );
	}

	/**
	 * @test
	 */
	public function esc_attr()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( '{{ var | esc_attr }}', array( 'var' => '<strong>' ) );
		$this->assertSame( '&lt;strong&gt;', $content );
	}

	/**
	 * @test
	 */
	public function esc_textarea()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( '{{ var | esc_textarea }}', array( 'var' => '<strong>' ) );
		$this->assertSame( '&lt;strong&gt;', $content );
	}

	/**
	 * @test
	 */
	public function esc_url()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( '{{ var | esc_url }}', array( 'var' => 'example.com' ) );
		$this->assertSame( 'http://example.com', $content );
	}

	/**
	 * @test
	 */
	public function esc_js()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( '{{ var | esc_js }}', array( 'var' => '<strong>' ) );
		$this->assertSame( '&lt;strong&gt;', $content );
	}
}
