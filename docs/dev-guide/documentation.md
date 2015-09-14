# Contributing to the documentation

One of the essential principle of incipio is that __Documetation is as important as code__. Incipio should be easy to use, to learn and to contribute.

* You sould considere that Incipio is written using [markdown synthax](https://confluence.atlassian.com/stash/markdown-syntax-guide-312740094.html)
* Incipio documentation is hosted on [GitHub](https://github.com/in6pio/Incipio/tree/master)
* Incipo documentation used [Mkdocs](http://www.mkdocs.org/) to generate the static web site
* Incipio documentation is published under a specific branch ``gh-pages`` as a GitHub hosted website


## Install and use Mkdocs

### Install Mkdocs

MkDocs need Python installed on yours system and ``pip (Python package manager)`` 

* Install Mkdocs
```
pip install mkdocs
```

* Run Mkdocs
```
mkdocs serve
```

Open up [http://127.0.0.1:8000/]() in your browser, and you'll see the index page being displayed

### Adding pages

* Create your ``*.md`` in the ``docs/user-guide`` or ``docs/dev-guide`` folder
* Edit ``docs/index.md`` to add your documantation to the table of content
* Edit ``mkdocs.yml`` if you want to include your page to the navigation header


## Documention workflow

Documentation contribution is based on github. See [Git workflow](git-workflow.md).
It's great if your push code and documentation together.

This is a small reminder :

* forked the official repository
* Clone the forked [Incipio/master](https://github.com/in6pio/Incipio/tree/master) repository to your local machine 
```
git clone https://github.com/<YOUR GITHUB USERNAME>/Incipio/master.git
```
* Create a dedicated new branch for your changes.
````
git checkout -b improve_doc
````
* Contribute to the documentation (and code).
* Push the changes to your forked repository.
````
git add .
git commit -m "<YOUR MESSAGE>"
git push origin improve_doc
````
* Now, initiate a pull request
````
Go to your forked repository and click on the Pull Requests link
````