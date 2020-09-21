ARG IMAGE_PHP_VERSION
FROM php:${IMAGE_PHP_VERSION}-fpm-alpine

LABEL maintainer "D.Horiyama"

RUN set -eux

# ----------------------------------------
# install build-dependencies
# ----------------------------------------
RUN apk add --update-cache --no-cache --virtual=.build-dependencies ${PHPIZE_DEPS} tzdata

# ----------------------------------------
# timezone
# ----------------------------------------
ARG TZ
RUN cp /usr/share/zoneinfo/${TZ} /etc/localtime

# ----------------------------------------
# install php extensions
# ----------------------------------------
RUN docker-php-ext-install bcmath pdo_mysql \
    && pecl update-channels \
    && pecl install xdebug

# ----------------------------------------
# install composer
# ----------------------------------------
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer global require hirak/prestissimo

# ----------------------------------------
# install entrykit
# ----------------------------------------
ENV ENTRYKIT_VERSION 0.4.0
RUN wget https://github.com/progrium/entrykit/releases/download/v${ENTRYKIT_VERSION}/entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && tar -xvzf entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && rm entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && mv entrykit /bin/entrykit \
  && chmod +x /bin/entrykit \
  && entrykit --symlink

# ----------------------------------------
# remove build-dependencies
# ----------------------------------------
RUN apk del .build-dependencies


ENTRYPOINT [\
    "docker-php-entrypoint" \
]

WORKDIR /var/www

CMD ["php-fpm"]
