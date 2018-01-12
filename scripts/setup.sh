#!/bin/bash

set -eu

# clone/update pimcore
if [ -d "tmp/pimcore" ]; then
    echo "Updating pimcore in tmp/pimcore"
    (cd tmp/pimcore && git reset -q --hard && git clean -qfd && git fetch -q origin && git checkout -q master && git pull -q origin master)
else
    echo "Cloning pimcore into tmp/pimcore"
    git clone -q https://github.com/pimcore/pimcore.git tmp/pimcore
fi

if [ ! -f sami.phar ]; then
    # download sami
    echo ""
    echo "Downloading sami from http://get.sensiolabs.org/sami.phar"
    curl -s -O http://get.sensiolabs.org/sami.phar
fi
