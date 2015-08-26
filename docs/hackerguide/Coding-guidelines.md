# WIP

## Backend

* [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
* [PSR-2](http://www.php-fig.org/psr/psr-2)
* Entities must implement the [Fluent Interface](http://en.wikipedia.org/wiki/Fluent_interface)
* Use [Yoda conditions](http://en.wikipedia.org/wiki/Yoda_conditions)
* Do not use ``is_null($vars)`` but test the actual value ``null === $vars``
* Do not use ``!`` for the NOT expression in conditional expressions but use ``false`` instead:

```php
// Wrong
if (!$expr) {
    ...
}

// Good
if (false === $expr) {
    ...
}
```
* Symfony conventions
  * [Symfony Conventions](http://symfony.com/doc/2.7/contributing/code/conventions.html)
  * [Coding Standards](http://symfony.com/doc/2.7/contributing/code/standards.html)
  * [Best practices](http://symfony.com/doc/2.7/best_practices/index.html)
* Annotations
* Vocabulary: check [lexicon](https://docs.google.com/spreadsheets/d/1c_1bgr7nWmXdM3OI8iYcvZ8gq7VbWyQn0p-9TZf9v4M/edit?usp=sharing)

## Front-End

* [OOCSS](https://github.com/stubbornella/oocss/wiki)
* [SMACSS](https://smacss.com)