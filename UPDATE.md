This file is temporary and is meant to be merged in the project wiki later on.

To install front-end dependencies: `npm install`

Using [Gulp](http://gulpjs.com/) as a task runner.

What does it do?

* Compile SASS files to CSS: `gulp sass`
* Compile JS files (for which is used [Browserify](http://browserify.org/) to add the module support): `gulp js`
* Copy fonts

TODO:
* Change `js` gulp task to only compile JS and not run the watcher besides it
* Configure the `watch` gulp task
* Add prod tasks: minify JS, CSS, images
* "Publish" favicons, cf. @theofidry with OrthoERP

# Tests

There is 2 kind of tests:
* Functional tests
* Unit tests: test an isolated component

The tests are done with [PHPUnit](phpunit.de) and [Behat](http://docs.behat.org/en/latest/). Behat is used for functional tests: describing user story and describing specifications. Some functional tests may be done via PHPUnit, but Behat is to be favored for that task.

To run tests:
* `composer test:phpunit`
* `composer test:behat`

# Assets management

Front-end assets can be found in `src/FrontBundle/Resources/assets` and are published in `web/assets`.

## Gulp

[Gulp](http://gulpjs.com/) is a simple task runner which basically allow one to automate tasks. It has been
configured to:
* ... task list

## SASS

### Architecture

```
.
└── src/FrontBundle/Resources/assets/scss
    ├── components
    ├── pages
    ├── _variables.scss
    └── app.scss
```

Files are compiled into: `web/assets/app.js`.

#### app.scss

Main entry files. All the files and libraries used are registered here. Not code declaration is done in it!

#### _variables.scss

Files where all variables are registered. Keep in mind that those variables are loaded *before* third-party libraries
. It means that if a third-party library defines the same variable as you, your variable may be overridden. This
usually do not happens because in SASS, you can define variables to assign a given value only if it does not exists
yet.

#### components

Directory in which all components are defined. A component is an item defined as a whole through the project. For
instance a button: it has a style that will be used globally and **is not** specific to a page.

For style specific to a page check `pages`.

Fore more check [Boostrap components](http://getbootstrap.com/components/).

#### pages

Directory in which all the style specific to one page is defined. By convention, put the style specific to a page in
a file named `_pagename.scss`.

If a rule is really too specific and is more a bugfix to a global style, consider using inline CSS: it's better to
have an inline CSS element rather than a ruleset just for that. Of course that applies only in this specific case. If
 you have a component for which the style completely differ on your page, it should go in the page style and not in
 inline CSS!

### Register

To register a new file, import it in `app.scss`.

### Third-party libraries

Third-party libraries are installed via [npm](https://www.npmjs.com/) in `node_modules`.

### Conventions

You must follow the file architecture defined above.

File names are prefixed by `_`, which is a convention in SASS to tell that this file is not actually compiled to CSS,
 but rather imported by another SASS file which is compiled into
  CSS.

## JavaScript

### Architecture

```
.
└── src/FrontBundle/Resources/assets/js
    ├── modules
    └── app.js
```

Files are compiled into: `web/assets/app.js`.

### Browserify

Thanks to [Browserify](http://browserify.org/), JavaScript files can be defined in modules...
