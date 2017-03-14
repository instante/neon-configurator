# Instante NEON configurator


[![Build Status](https://travis-ci.org/instante/neon-configurator.svg?branch=master)](https://travis-ci.org/instante/neon-configurator)
[![Downloads this Month](https://img.shields.io/packagist/dm/instante/neon-configurator.svg)](https://packagist.org/packages/instante/neon-configurator)
[![Latest stable](https://img.shields.io/packagist/v/instante/neon-configurator.svg)](https://packagist.org/packages/instante/neon-configurator)

Makes updates to `neon` configuration files super easy.

Includes integration as a `Kdyby\Console` command
or running through simple php file included in composer bin.

## Usage:

```
<project root>$ vendor/bin/update-neon path/to/neon-file.neon path.to.key value
<project root>$ vendor/bin/update-neon app/config/local.neon parameters.webmasterEmail john@doe.com
```

## Requirements

- PHP 5.6 or higher
- [NEON](https://github.com/nette/neon) 2.4

## Installation

The best way to install Instante neon-configurator is using  [Composer](http://getcomposer.org/):

```sh
$ composer require instante/neon-configurator
```

## Caveats

* The utility is currently unable to preserve comments and drops all of them.

