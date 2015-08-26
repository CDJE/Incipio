## Table of contents

* [Fork Incipio](/hackerguide/Git-workflow#fork-incipio)
* [Keep your fork up to date](/hackerguide/Git-workflow#keep-your-fork-up-to-date)
* [Develop](/hackerguide/Git-workflow#develop)
* [Submit your work](/hackerguide/Git-workflow#submit-your-work)
* [Fore more](/hackerguide/Git-workflow#for-more)
* [Sources](/hackerguide/Git-workflow#sources)

## Introduction to a triangular workflow

You do not have the rights to directly write on the project. Hence if you wish to push some code, the best thing to do is to **fork** the project. Once done, you will have a copy of the the repository [in6pio/Incipio](https://github.com/in6pio/Incipio) to your own namespace, with write access.

On your fork, you can develop and do changes as you wish. We recommend you to do your modifications in separate branches so that you can keep the original branches up to date with the original repository.

If you are not used to this kind of workflow, do not worry, everything is detailed below!

![Triangular workflow](https://cloud.githubusercontent.com/assets/1319791/8943755/5dcdcae4-354a-11e5-9f82-915914fad4f7.png)

## Fork Incipio

Nothing easier than that: go to https://github.com/in6pio/Incipio and then clic on the **fork** button ;)

For more, check this [GitHub guide: forking projects](https://guides.github.com/activities/forking/).

![Fork GitHub](https://help.github.com/assets/images/site/fork-a-repo.gif)

## Keep your fork up to date

First, clone your fork!

Here it becomes a little bit trickier if you never did it. With your fork, you can do your changes as you like it will not affect the original repository. However, sometimes changes may happen on the original repository and you want to keep your fork up to date so that you can develop with the latest work. To achieve that, you have to configure the **tracked repositories**.

To see which repositories are tracked, use `git remote -v`. The current result should be something like:

```
origin	git@github.com:yourNameSpace/Incipio.git (fetch)
origin	git@github.com:yourNameSpace/Incipio.git (push)
```

Now, add the original repository to tracked repositories: `git remote add upstream git@github.com:in6pio/Incipio.git`. Now if you do `git remote -v` again you should have:

```
origin	git@github.com:yourNameSpace/Incipio.git (fetch)
origin	git@github.com:yourNameSpace/Incipio.git (push)
upstream	git@github.com:in6pio/Incipio.git (fetch)
upstream	git@github.com:in6pio/Incipio.git (push)
```

That's it! Now, if you wish to update your repository, you can do:

* `git fetch upstream`: get the updates from the original repository.
* `git fetch origin`: get the updates of your remote repository (the fork).

Source: [GitHub: syncing a fork](https://help.github.com/articles/syncing-a-fork/)

## Develop

It is highly recommended to use the development environment provided to develop. If you want more information on it, check [this link](https://github.com/in6pio/Incipio/tree/dev-env).

If you wish to properly keep your fork up to date, do not touch the original branches like `master`!

Now let's start. It is assumed that your repository is up to date. Create your branch `featureName` (the branch name has really no importance, you will be the only one to use it) from the `dev` branch:

```
git checkout origin/dev     # You are now on your remote branch `dev`
git checkout -b featureName # You are now on the branch featureName
```

Now you can start to code. Do not forget to follow the [project contributing guidelines](/hackerguide/Hacker-guide)!

## Submit your work

It is assumed that you have your latest work that you wish to submit pushed on the branch `featureName` on your fork. Before submitting your work, first check that your work following the project standards. Then, to clean your work, do not forget to **rebase it first**. Why? To ensure your work integrates the latests commits of the original repository and ease the merge! Never did that? Then do the following:

Go on your branch `featureName`.

Update your local repository:

```
git fetch upstream
git fetch origin
git pull featureName
```

Rebase your work:
```
git rebase upstream/dev
```

Solve the conflicts, and only the conflicts, nothing else! To do so, check the conflicted files. Once this is done, do:

```
git add -A
git rebase --continue
```

And to that until the rebase is successful :)

Now repush your work. You will probably need to do a force push.

Good! Now you can do a **pull request** with the original repository on the `dev` branch (`in6pio:dev`) as a `base` and your fork branch as `HEAD` (`yourNameSpace:featureName`).

## For more

* [Learn Git with pcottle](http://pcottle.github.io/learnGitBranching/?demo)
* [Bien utiliser `git merge` et `git rebase`](http://www.git-attitude.fr/2014/05/04/bien-utiliser-git-merge-et-rebase/)
* [Getting solid at `git rebase` and `git merge`](https://medium.com/@porteneuve/getting-solid-at-git-rebase-vs-merge-4fa1a48c53aa)
* [How to undo almost anything with Git](https://github.com/blog/2019-how-to-undo-almost-anything-with-git)

Last be not the least, if you feel uncomfortable with Git in command lines, checkout:

* [Git GUI clients](http://git-scm.com/downloads/guis)
* [ungit](https://github.com/FredrikNoren/ungit)

Good coding!

## Sources

* [Git Workflows For Successful Deployment](http://bocoup.com/weblog/git-workflows-for-successful-deployment/) - Matt Surabian (*bocoup*) | May 07, 2015
* [Git Best Practices: Workflow Guidelines](https://www.lullabot.com/blog/article/git-best-practices-workflow-guidelines) - Andrew Berry (*Lullabot*) | June 14, 2012
* [GitHub Flow](http://scottchacon.com/2011/08/31/github-flow.html) - Scott Chacon | August 31, 2011
* [A successful Git branching model](http://nvie.com/posts/a-successful-git-branching-model/) - Vincent Driessen | January 05, 2010
* [Practical Git: A Workflow to Preserve Your Sanity](http://www.kdgregory.com/index.php?page=scm.git) - Keith D Gregory
* [Understanding the Git Workflow](https://sandofsky.com/blog/git-workflow.html) - Ben Sandofsky
* [Git Workflows That Work](http://blog.endpoint.com/2014/05/git-workflows-that-work.html) - Spencer Christensen | May 2, 2014 
* [Git branch strategy for small dev team](http://stackoverflow.com/questions/2428722/git-branch-strategy-for-small-dev-team) - Bilal and Olga | March 11, 2010
* [Git Branching - Branching Workflows](http://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows) - Git official doc
* [Comparing Workflows](https://www.atlassian.com/git/tutorials/comparing-workflows/) - *Atlassian*
* [Git Workflow in Invenio](http://invenio-software.org/wiki/Tools/Git/Workflow) - *Invenio*