# SHARK: Shopify app rapid-development kit

![Tests](https://github.com/niveshsaharan/shark/workflows/Tests/badge.svg)
[![Shark](https://img.shields.io/endpoint?url=https://dashboard.cypress.io/badge/count/47ezsk/master&style=flat&logo=cypress)](https://dashboard.cypress.io/projects/cm138z/runs)


I am building this as starting point for all my future Shopify apps

## Installation

You can clone the repository:

```bash
git clone https://github.com/niveshsaharan/shark.git
```

Or [Use this template](https://github.com/niveshsaharan/shark/generate) to generate a project directly from this template.

## Setup
1. Clone/Use this template
1. Run `composer install`
1. Run `npm install`
1. Run `npm run dev`
1. Run `php artisan migrate`


## Admin
Laravel Nova is used to build the admin panel so if you need to use it, you must have a valid licence for Laravel Nova. If you  don't have it, you can get it by visiting https://nova.laravel.com

Once you have the licence, you can run following command to install it:

```bash
php artisan shark:admin:install
```

Create an admin user by running following command:

```bash
php artisan shark:admin:user
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hey@nive.sh instead of using the issue tracker.

## Credits

- [Nivesh Saharan](https://github.com/niveshsaharan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
