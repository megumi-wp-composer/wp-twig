<?php

class Twig_Extension_Test extends WP_UnitTestCase
{
	/**
	 * @test
	 */
	public function the_date()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_id = $this->factory->post->create( array( 'post_author' => 1 ) );

		$this->assertSame(
			date( 'F j, Y' ),
			$twig->render( '{{ post | the_date }}', array( 'post' => $post_id ) )
		);

		$this->assertSame(
			date( 'Y-m-d' ),
			$twig->render( '{{ post | the_date( "Y-m-d" ) }}', array( 'post' => $post_id ) )
		);

		$this->assertSame(
			$twig->render( '{{ post | the_date }}', array( 'post' => get_post( $post_id ) ) ),
			$twig->render( '{{ post | the_date }}', array( 'post' => $post_id ) )
		);
	}

	/**
	 * @test
	 */
	public function the_author()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_id = $this->factory->post->create( array( 'post_author' => 1 ) );

		$this->assertSame(
			"admin",
			$twig->render( '{{ post | the_author }}', array( 'post' => $post_id ) )
		);

		$this->assertSame(
			$twig->render( '{{ post | the_author }}', array( 'post' => get_post( $post_id ) ) ),
			$twig->render( '{{ post | the_author }}', array( 'post' => $post_id ) )
		);
	}

	/**
	 * @test
	 */
	public function the_content()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_ids = $this->factory->post->create_many( 10 );

		foreach ( $post_ids as $post_id ) {
			$this->assertRegExp(
				"#<p>Post content [0-9]+</p>#",
				$twig->render( '{{ post | the_content }}', array( 'post' => get_post( $post_id ) ) )
			);
			$this->assertSame(
				$twig->render( '{{ post | the_content }}', array( 'post' => get_post( $post_id ) ) ),
				$twig->render( '{{ post | the_content }}', array( 'post' => $post_id ) )
			);
		}
	}

	/**
	 * @test
	 */
	public function the_excerpt()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_ids = $this->factory->post->create_many( 10 );

		foreach ( $post_ids as $post_id ) {
			$this->assertRegExp(
				"#<p>Post excerpt [0-9]+</p>#",
				$twig->render( '{{ post | the_excerpt }}', array( 'post' => get_post( $post_id ) ) )
			);
			$this->assertSame(
				$twig->render( '{{ post | the_excerpt }}', array( 'post' => get_post( $post_id ) ) ),
				$twig->render( '{{ post | the_excerpt }}', array( 'post' => $post_id ) )
			);
		}
	}

	/**
	 * @test
	 */
	public function the_permalink()
	{
		$twig = new Twig_Environment( new Twig_Loader_String() );
		$twig->addExtension( new Megumi\WP\Twig_Extension() );

		$post_ids = $this->factory->post->create_many( 10 );

		foreach ( $post_ids as $post_id ) {
			$this->assertSame(
				"http://example.org/?p=" . $post_id,
				$twig->render( '{{ post | the_permalink }}', array( 'post' => get_post( $post_id ) ) )
			);
			$this->assertSame(
				$twig->render( '{{ post | the_permalink }}', array( 'post' => get_post( $post_id ) ) ),
				$twig->render( '{{ post | the_permalink }}', array( 'post' => $post_id ) )
			);
		}
	}

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
}
