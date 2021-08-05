[![Latest Stable Version][latest stable version]][1]
 [![GitHub stars][github stars]][1]
 [![Total Downloads][total downloads]][1]
 [![GitHub Workflow Status][github workflow status]][2]
 [![Scrutinizer code quality][code quality]][3]
 [![Type Coverage][type coverage]][4]
 [![Code Coverage][code coverage]][3]
 [![License][license]][1]

# WOPI Lib

## Description

## Installation

```composer require champs-libres/wopi-lib```

## Usage

## Documentation

Links:

* [https://wopi.readthedocs.io/en/latest/](https://wopi.readthedocs.io/en/latest/)

## Code quality, tests, benchmarks

Every time changes are introduced into the library, [Github][2] runs the
tests.

The library has tests written with [PHPSpec][35].
Feel free to check them out in the `spec` directory. Run `composer phpspec` to
trigger the tests.

Before each commit, some inspections are executed with [GrumPHP][36]; run
`composer grumphp` to check manually.

The quality of the tests is tested with [Infection][37] a PHP Mutation testing
framework, run `composer infection` to try it.

Static analyzers are also controlling the code. [PHPStan][38] and
[PSalm][39] are enabled to their maximum level.

## Contributing

## Changelog

See [CHANGELOG.md][43] for a changelog based on [git commits][44].

For more detailed changelogs, please check [the release changelogs][45].

[1]: https://packagist.org/packages/champs-libres/wopi-lib
[latest stable version]: https://img.shields.io/packagist/v/champs-libres/wopi-lib.svg?style=flat-square
[github stars]: https://img.shields.io/github/stars/champs-libres/wopi-lib.svg?style=flat-square
[total downloads]: https://img.shields.io/packagist/dt/champs-libres/wopi-lib.svg?style=flat-square
[github workflow status]: https://img.shields.io/github/workflow/status/champs-libres/wopi-lib/Unit%20tests?style=flat-square
[code quality]: https://img.shields.io/scrutinizer/quality/g/champs-libres/wopi-lib/master.svg?style=flat-square
[3]: https://scrutinizer-ci.com/g/champs-libres/wopi-lib/?branch=master
[type coverage]: https://img.shields.io/badge/dynamic/json?style=flat-square&color=color&label=Type%20coverage&query=message&url=https%3A%2F%2Fshepherd.dev%2Fgithub%2Fchamps-libres%2Fwopi-lib%2Fcoverage
[4]: https://shepherd.dev/github/champs-libres/wopi-lib
[code coverage]: https://img.shields.io/scrutinizer/coverage/g/champs-libres/wopi-lib/master.svg?style=flat-square
[license]: https://img.shields.io/packagist/l/champs-libres/wopi-lib.svg?style=flat-square
[34]: https://github.com/champs-libres/wopi-lib/issues
[2]: https://github.com/champs-libres/wopi-lib/actions
[35]: http://www.phpspec.net/
[36]: https://github.com/phpro/grumphp
[37]: https://github.com/infection/infection
[38]: https://github.com/phpstan/phpstan
[39]: https://github.com/vimeo/psalm
[43]: https://github.com/champs-libres/wopi-lib/blob/master/CHANGELOG.md
[44]: https://github.com/champs-libres/wopi-lib/commits/master
[45]: https://github.com/champs-libres/wopi-lib/releases
