#!/bin/bash

set -eu

# clone/update pimcore
if [ -d "tmp/pimcore" ]; then
    echo "Updating pimcore in tmp/pimcore"
    (cd tmp/pimcore && git reset --hard && git clean -fd && git fetch origin && git checkout master && git pull origin master)
else
    echo "Cloning pimcore to tmp/pimcore"
    git clone https://github.com/pimcore/pimcore.git tmp/pimcore
fi

if [ ! -f sami.phar ]; then
    # download sami
    echo ""
    echo "Downloading sami from http://get.sensiolabs.org/sami.phar"
    curl -O http://get.sensiolabs.org/sami.phar
fi
