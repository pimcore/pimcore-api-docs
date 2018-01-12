# Pimcore API Docs Configuration

Configuration to build Pimcore API docs with [Sami](https://github.com/FriendsOfPHP/Sami).


## Usage

With the default config it expects a clone of the `pimcore/pimcore` repository in `tmp/pimcore` and will build the API docs
to `build/static/pimcore`. You can change those paths via env variables (see [config/pimcore.php](./config/pimcore.php)).

```shell
# run setup to clone/update the pimcore/pimcore repository and to download the Sami PHAR
$ scripts/setup.sh

# run build to actually build the api docs
$ scripts/build.sh
```


## Releasing a new version

There is a [RMT](https://github.com/liip/RMT) [config file](./.rmt.yml) which allows you to release a new version quickly.
Please note that the API docs build process relies on the latest annotated tag version, so releasing a version as annotated
tag is mandatory. RMT takes care of that for you:

```bash
$ RMT release

# or release a specific type
$ RMT release --type minor
```
