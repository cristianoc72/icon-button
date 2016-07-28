# Icon-button #
[![Build Status](https://travis-ci.org/cristianoc72/icon-button.svg?branch=master)](https://travis-ci.org/cristianoc72/icon-button)

Icon-button is an extension for Symfony Form button and submit types.
You can easily add an icon to your buttons, after or before the label.

By now, only [Bootstrap Glyphicons](http://getbootstrap.com/components) are supported. 
  
## Installation ##
 
 Install this package via [composer](http://getcomposer.org):
 
 ```
 composer require cristianoc72/icon-button
 ```
 
### Working with Silex ###
 
Be sure you've enabled `TwigServiceProvider` and `FormServiceProvider` and all its dependencies. See http://silex.sensiolabs.org/doc/providers/form.html.
 
Then register the extension in your Application:
 
```php
 <?php
 
 //Tell Twig where icon-button theme is
 $app->register(new \Silex\Provider\TwigServiceProvider(), [
     'twig.path' => [__DIR__ . '/your/application/templates', __DIR__ . '/../vendor/cristianoc72/icon-button/resources/template'],
     'twig.form.templates' => ['your_application_form_layout.html.twig', 'icon_button.html.twig']
 ]);
 
 //then register the extension
 $app->extend('form.type.extensions',  function ($extensions) use ($app) {
        $extensions[] = new cristianoc72\IconButton\IconButtonTypeExtension();

        return $extensions;
    })
 );
```
and tell Twig about the icon-button template;
 
### Working with Symfony ###
 
Register the extension as a service:
 
```yaml
# app/config/config.yml

services:
    .....
       
    app.icon_button_type_extension:
        class: cristianoc72\IconButton\IconButtonTypeExtension
        tags:
          - { name: form.type_extension, extended_type: 
          Symfony\Component\Form\Extension\Core\Type\ButtonType }		

twig:
    ...
    
    paths:
        "%kernel.root_dir%/../vendor/cristianoc72/icon-button/resource/template"

    form_themes:
        - ........
        
        - icon_button.html.twig
```
 
## Usage ##

Icon-button extension adds two new properties to Symfony button type: `icon` and `icon_position`.
`icon` property is a string containing the glyphicon css selector for the icon.

You can display your icon before or after the button label, by setting `icon-position` property.
`icon_position` accepts one of the following values: `after`, `before`, 0, 1 (0 means 'before' and 1 means 'after'):

```php
<?php

    $form->add('save', 'submit', ['icon' => 'glyphicon-floppy-save', 'icon_position' => 'after']);
```
And this is the result:

![Save button with icon after the label](https://dl.dropboxusercontent.com/u/20811829/Save_after.png)

If you prefer the icon before the label:

```php
<?php

    $form->add('save', 'submit', ['icon' => 'glyphicon-floppy-save', 'icon_position' => 'before']);
```
And the result is the following:

![Save button with icon before the label](https://dl.dropboxusercontent.com/u/20811829/Save_before.png)

When you're working on a multi step form wizard, you always define a *previous step* button and a *next step* button.
When you add a button named `previous_step` or `next_step` to your form, this extension automatically adds an icon as follow:

- ** previous_step **: `icon` is set to `glyphicon-step-backward` and `icon_position` is set to `before`
- ** next_step **: `icon` is set to `glyphicon-step-forward` and `icon_position` is set to `after`

So that, if you're satisfied of the default icons, you can simply write:

```php
<?php

    $form->add('previous_step', 'submit');
    $form->add('next_step', 'submit');
```

And this is the resulting buttons:

![Previous and next buttons](https://dl.dropboxusercontent.com/u/20811829/prev_next.png)

If you need a `reset` button too, it's put between previous and next buttons:

```php
<?php

    $form->add('previous_step', 'submit');
    $form->add('next_step', 'submit');
    $form->add('reset', 'reset');
```

And here it is:

![Previous, next and reset buttons](https://dl.dropboxusercontent.com/u/20811829/triple.png)

## Tests ##

This library uses [PhpUnit](http://www.phpunit.de) for testing. To run the test suite, from your project root directory, do:

```bash
 vendor/bin/phpunit
```

## Contribution ##

Each contribution is wellcome! A typo (expecially about my awful English), a bug fix, an addiction, a suggestion, everything is important.

If you want to contribute, simply fork this repository and submit a pull request.

Of course, there are a few little conventions to follow, before submitting a pull request:

- This project follows PSR-1 and PSR-2 coding standards. If you add or modify the code, we recommend to run `php-cs-fixer.phar`. See http://cs.sensiolabs.org.
- When you modify the existent code, run the test suite and enjoy everything is green.
- When you add a new feature, write a test which proves that your code works fine.

## License ##

This library is released under the MIT license. See LICENSE file for details.
