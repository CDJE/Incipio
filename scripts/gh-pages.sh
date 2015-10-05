#!/usr/bin/env bash

git clone "${GH_REMOTE}" gh-pages --single-branch --branch=gh-pages
cd gh-pages
git config user.name "${GH_USER_NAME}"
git config user.email "${GH_USER_EMAIL}"
rm -rf reports
mv ../dist/reports .
git add -all
git commit --message --quiet "${GH_COMMIT_MESSAGE}"
git push --force --quiet origin gh-pages
