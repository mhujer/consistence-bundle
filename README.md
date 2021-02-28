# ConsistenceBundle adds translator service, translator twig filter and form type for Consistence Enums 
 
[![Build Status](https://travis-ci.org/mhujer/consistence-bundle.svg?branch=master)](https://travis-ci.org/mhujer/consistence-bundle)  [![Latest Stable Version](https://poser.pugx.org/mhujer/consistence-bundle/version.png)](https://packagist.org/packages/mhujer/consistence-bundle) [![Total Downloads](https://poser.pugx.org/mhujer/consistence-bundle/downloads.png)](https://packagist.org/packages/mhujer/consistence-bundle) [![License](https://poser.pugx.org/mhujer/consistence-bundle/license.svg)](https://packagist.org/packages/mhujer/consistence-bundle) [![Coverage Status](https://coveralls.io/repos/mhujer/consistence-bundle/badge.svg?branch=master)](https://coveralls.io/r/mhujer/consistence-bundle?branch=master)

This Bundle provides translator service, translator twig filter and form type for [consistence/consistence](https://github.com/consistence/consistence) enums.


# Installation

## Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require mhujer/consistence-bundle
```

## Applications that don't use Symfony Flex

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mhujer/consistence-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Mhujer\ConsistenceBundle\MhujerConsistenceBundle::class => ['all' => true],
];
```

# Usage

Examples consider having the following enum:

```php
<?php declare(strict_types = 1);

namespace App\Card;

final class CardColor extends \Consistence\Enum\Enum
{

    public const BLACK = 'black';
    public const RED = 'red';

}
```

## Translation file

The translator automatically converts an instance of enum to a translation key consisting of FQCN of the enum, colon and its value, e.g.:

```
App\Card\CardColor:red
```

Best approach is to create a translation file using the PHP format (`enums.en.php`) which allows you to use the class name:

```php
<?php declare(strict_types = 1);

use App\Card\CardColor;

return [
    CardColor::class . ':' . CardColor::RED => 'red',
    CardColor::class . ':' . CardColor::BLACK => 'black',
];

```

As you might have noticed, the translation domain is set to `enums`.

## Twig

In Twig templates you can use `transEnum` filter to convert an enum to a translated string:

```twig
{{ variableContainingEnum | transEnum }}
```

## Forms

In forms, you can use `EnumType` as a field type. You need to set an option `enum_class` to an enum class:

```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('cardColor', EnumType::class, [
            'enum_class' => CardColor::class,
            'label' => 'Card Color',
        ])
    //...
```

Property in your [request object](https://blog.martinhujer.cz/symfony-forms-with-request-objects/) should look like this (it contains an instance of `CardColor`):

```php
/**
 * @Assert\NotBlank()
 * @var \App\Card\CardColor
 */
public $cardColor;
```


# Requirements
Works with PHP 7.4 or higher and Symfony 4.3 or higher.


# Submitting bugs and feature requests
Bugs and feature request are tracked on [GitHub](https://github.com/mhujer/consistence-bundle/issues)


# Author
[Martin Hujer](https://www.martinhujer.cz) 


# Changelog

## 1.0.2 (2020-01-13)
- Fixed [#3](https://github.com/mhujer/consistence-bundle/issues/3): _Undefined "translator" dependency in services.yaml_ 

## 1.0.1 (2019-11-24)
- Symfony 5 and Twig 3 compatibility

## 1.0.0 (2019-11-06)
- initial release
