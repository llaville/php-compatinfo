<!-- markdownlint-disable MD013 -->
# Docker CLI

**IMPORTANT** : Docker image with `latest` tag use the PHP 8.1 runtime !

> Please mount your system temporary folder to `/home/appuser/.cache/bartlett` in the container.
>
> **NOTE**: On most Linux distribution, it should be `/tmp`
>
> Don't forget to also mount your source code to `/app` folder (i.e) in the container and make it as the current working directory

```shell
docker run --rm -it -u "$(id -u):$(id -g)" \
    -v /tmp:/home/appuser/.cache/bartlett \
    -v ${PWD}:/app \
    -w /app \
    ghcr.io/llaville/php-compatinfo:latest
```

Then you can run any commands supported by application : `db:*`, `diagnose`, `about`, `analyser:run`, `rule:list`
