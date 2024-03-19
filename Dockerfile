# syntax=docker/dockerfile:1.4
ARG PHP_VERSION=8.1

FROM php:${PHP_VERSION}-cli-alpine

# https://github.com/opencontainers/image-spec/blob/main/annotations.md

LABEL org.opencontainers.image.title="llaville/php-compatinfo"
LABEL org.opencontainers.image.description="Docker image of bartlett/php-compatinfo Composer package"
LABEL org.opencontainers.image.source="https://github.com/llaville/php-compatinfo"
LABEL org.opencontainers.image.licenses="MIT"
LABEL org.opencontainers.image.authors="llaville"

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Create a group and user
RUN addgroup appgroup && adduser appuser -D -G appgroup

# Tell docker that all future commands should run as the appuser user
USER appuser

# Install Composer v2 binary version
COPY --from=composer/composer:2-bin /composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_PREFER_STABLE 1
RUN composer global require --no-progress bartlett/php-compatinfo 7.x-dev

# Following recommendation at https://docs.github.com/en/actions/creating-actions/dockerfile-support-for-github-actions#workdir

ENTRYPOINT ["/entrypoint.sh"]
