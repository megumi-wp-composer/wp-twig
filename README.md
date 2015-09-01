# megumi/wp-twig

[![Build Status](https://travis-ci.org/megumi-wp-composer/wp-twig.svg?branch=master)](https://travis-ci.org/megumi-wp-composer/wp-twig)
[![Latest Stable Version](https://poser.pugx.org/megumi/wp-twig/v/stable.svg)](https://packagist.org/packages/megumi/wp-twig)
[![Total Downloads](https://poser.pugx.org/megumi/wp-twig/downloads.svg)](https://packagist.org/packages/megumi/wp-twig)
[![Latest Unstable Version](https://poser.pugx.org/megumi/wp-twig/v/unstable.svg)](https://packagist.org/packages/megumi/wp-twig)
[![License](https://poser.pugx.org/megumi/wp-twig/license.svg)](https://packagist.org/packages/megumi/wp-twig)

Integrates Twig template engine to WordPress.

## Installation

Create a composer.json in your plugin root or mu-plugins

```
{
    "require": {
        "megumi/wp-twig": "*"
    }
}
```

Place the following code into your plugin.

```
require_once dirname( __FILE__ ) . '/vendor/autoload.php';
```

Then:

```
$ composer install
```

## How to use

```
$twig = new Twig_Environment( new Twig_Loader_String() );
$twig->addExtension( new Megumi\WP\Twig_Extension() );

$content = $twig->render( '{{ name | esc_html }}', array( 'name' => '<strong>' ) );
$this->assertSame( '&lt;strong&gt;', $content );
```

## Twig filter extensions for WordPress

* `esc_html`
* `esc_attr`
* `esc_textarea`
* `esc_url`
* `esc_js`
