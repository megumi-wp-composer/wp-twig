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

	/**
	 * @test
	 */
	public function apply_filter()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$content = $twig->render( 'Hello {{ name | apply_filters( "my_custom_filter" ) }}', array( 'name' => 'World' ) );
		$this->assertSame( 'Hello World', $content );

		add_filter( 'my_custom_filter', function( $content ){
			return strtoupper( $content );
		} );
		$content = $twig->render( 'Hello {{ name | apply_filters( "my_custom_filter" ) }}', array( 'name' => 'World' ) );
		$this->assertSame( 'Hello WORLD', $content );

		$content = $twig->render( 'Hello {{ name | apply_filters( "my_custom_filter" ) }}', array( 'name' => '<strong>World</strong>' ) );
		$this->assertSame( 'Hello &lt;STRONG&gt;WORLD&lt;/STRONG&gt;', $content ); // should be escaped
	}

	/**
	 * @test
	 */
	public function is_home()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$template = '{% if is_home() %}is_home() is true{% else %}is_home() is false{% endif %}';

		$this->go_to( '/?p=1' ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_home() is false', $content );

		$this->go_to( '/' ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_home() is true', $content );
	}

	/**
	 * @test
	 */
	public function is_front_page()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$template = '{% if is_front_page() %}is_front_page() is true{% else %}is_front_page() is false{% endif %}';

		$this->go_to( '/?p=1' ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_front_page() is false', $content );

		$this->go_to( '/' ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_front_page() is true', $content );
	}

	/**
	 * @test
	 */
	public function is_single()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_id = $this->factory->post->create( array( 'post_type' => 'post' ) );
		$page_id = $this->factory->post->create( array( 'post_type' => 'page' ) );

		$template = "{% if is_single() %}is_single() is true{% else %}is_single() is false{% endif %}";

		$this->go_to( '/?p=' . $post_id ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_single() is true', $content );

		$this->go_to( '/' ); // is_home() should be true
		$content = $twig->render( $template );
		$this->assertSame( 'is_single() is false', $content );
	}

	/**
	 * @test
	 */
	public function constant()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$template = "{{ constant('DB_USER') }}";

		$content = $twig->render( $template );
		$this->assertSame( 'constant() is disabled.', $content );

		$template = "{{ include('DB_USER') }}";
		$content = $twig->render( $template );
		$this->assertSame( 'include() is disabled.', $content );
	}
}
