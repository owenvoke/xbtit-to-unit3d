# XBTIT to UNIT3D

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-github-actions]][link-github-actions]
[![Style CI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]

An artisan package to import a [XBTIT] database into [UNIT3D].

## Install

Via Composer

```bash
$ composer require pxgamer/xbtit-to-unit3d --dev
```

To install, just:
- Require this package from your [UNIT3D][unit3d] install.
- Add an empty `imports` entry to your database config.

## Usage

For instructions on usage, run:

```bash
php artisan unit3d:from-xbtit --help
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Owen Voke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[unit3d]: https://github.com/unit3d/unit3d
[xbtit]: https://github.com/btiteam/xbtit
[providers]: https://laravel.com/docs/master/providers#registering-providers

[ico-version]: https://img.shields.io/packagist/v/pxgamer/xbtit-to-unit3d.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/workflow/status/HDInnovations/xbtit-to-unit3d/Tests.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/114135662/shield
[ico-downloads]: https://img.shields.io/packagist/dt/pxgamer/xbtit-to-unit3d.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pxgamer/xbtit-to-unit3d
[link-github-actions]: https://github.com/HDInnovations/xbtit-to-unit3d/actions
[link-styleci]: https://styleci.io/repos/114135662
[link-downloads]: https://packagist.org/packages/pxgamer/xbtit-to-unit3d
[link-author]: https://github.com/owenvoke
[link-contributors]: ../../contributors
