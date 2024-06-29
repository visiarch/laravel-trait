![laravel Trait](https://github.com/visiarch/laravel-trait/blob/main/images/laravel-trait-banner.png)

# laravel-trait

[![Latest Stable Version](http://poser.pugx.org/visiarch/laravel-trait/v)](https://packagist.org/packages/visiarch/laravel-trait)
[![License](http://poser.pugx.org/visiarch/laravel-trait/license)](https://packagist.org/packages/visiarch/laravel-trait)

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/bagussuandana)

> A Simple Package to create traits, using artisan commands in laravel.

This package extends the `make:` commands to help you easily create trait classes in Laravel 9+.

# What is Trait ?

Traits are a mechanism in PHP that allows the use of methods across classes. This allows developers to write functions that can be reused in many classes.

# Install

```bash
composer require visiarch/laravel-trait
```

Once it is installed, you can use any of the commands in your terminal.

# Usage

Traits are used to avoid code duplication and facilitate reuse of the same logic across multiple classes without using inheritance.

```bash
php artisan make:trait {name}
```

# Examples

## Create a php trait

`/app/Traits/Loggable.php`

```bash
$ php artisan make:trait Loggable
```

`/app/Traits/Loggable.php`

```php
<?php

namespace App\Traits;

/**
 * Trait Loggable
 * @package App\Traits
 */

trait Loggable {
    // write your code here
}
```

## Implementation

```php
<?php
trait Loggable {
    public function log($message) {
        return $message;
    }
}

class User {
    use Loggable;
}

class Order {
    use Loggable;
}

$user = new User();
$user->log('User created');

$order = new Order();
$order->log('Order placed');
```

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on any social media? Spread the word!

Thanks!
visiarch

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
