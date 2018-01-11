# Pimcore API Docs Configuration

Configuration to build Pimcore API docs with [Sami](https://github.com/FriendsOfPHP/Sami).


## Releasing a new version

There is a [RMT](https://github.com/liip/RMT) [config file](./.rmt.yml) which allows you to release a new version quickly.
Please note that the API docs build process relies on the latest annotated tag version, so releasing a version as annotated
tag is mandatory. RMT takes care of that for you:

```bash
$ RMT release

# or release a specific type
$ RMT release --type minor
```
