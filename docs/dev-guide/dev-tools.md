TODO:

* phpStorm for Symfony
* pre-commit hook
* configuration de git
* alias Git
* bash autocomplete
* aliases
* symfony command autocomplete
* PHPCS
* PHPMD

## PHP-CS Fixer

[PHP-CS Fixer](http://cs.sensiolabs.org/) follow the PHP coding standards as defined in the [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) documents. It fixes all the issues of your code to comply to those standards.

To use it, simply run: `composer php-cs-fixer` or `composer phpcsf`.

## Postman

To test the API, there is no better tool than [Postman](https://chrome.google.com/webstore/detail/postman-rest-client-packa/fhbjgbiflinjbdggehcddcbncdddomop). It is a simple application allowing you to easily request the API.

To help you with Postman, a configuration has been exported with all the documentation! Once you have installed Postman, import the collection `postman_collection` and the environment `postman_environment`. The Postman collection show you all the available requests and the environment allow you to configure the variable `host`.