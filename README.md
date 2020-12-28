# Add reviews to the Park Right Platform

This packages adds functionality to the Park Right booking engine to allow Products to be reviewed.

## Installation

This is a private repository so you need to add this to your composer.json:

```git
repositories: [
  {
    "type": "vcs",
    "url": "https://github.com/parkright/reviews"
   }
]
```

You can install the package via composer:

```bash
composer require parkright/reviews
```

You must publish the migrations:

```bash
php artisan vendor:publish --provider="Parkright\Reviews\ReviewServiceProvider" --tag="review-migrations"
```

Optionally publish the configuration file:

```bash
php artisan vendor:publish --provder="Parkright\Reviews\ReviewServiceProvider" --tag="review-config"
```

## Usage

This package can actually be used to add the review logic to any model by adding the trait:

``` php
use Reviewable;
```

You can then add a review like so:

``` php
$model->addReview()
```

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mike@skyparkingservices.co.uk instead of using the issue tracker.

## Credits

- [Michael O'Connor](https://github.com/parkright)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
