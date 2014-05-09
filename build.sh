#!/bin/sh
gitbook build doc
rm -Rf gitbook uninstalling
cp -R pages/* ./
rm -Rf pages
rm book.json
mkdir pages
touch pages/.gitempty
git add --all .
git commit -m 'Update gitbook'
