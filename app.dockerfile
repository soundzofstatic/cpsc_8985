FROM php:7.3.22-fpm

RUN apt-get update && apt-get install --no-install-recommends -y \
        less

ARG WITH_XDEBUG=false
ARG XDEBUG_TRIGGER_PROFILER=false
ARG XDEBUG_PROFILER_DIR=/var/xdebug

RUN if [ ${WITH_XDEBUG} = "true" ] ; then \
        pecl install xdebug; \
        docker-php-ext-enable xdebug; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        if [ ${XDEBUG_TRIGGER_PROFILER} = "true" ] ; then \
            echo xdebug.profiler_enable_trigger=1 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
            echo xdebug.profiler_output_dir=${XDEBUG_PROFILER_DIR} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        fi ; \
    fi ;

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    default-mysql-client \
    libmagickwand-dev \
    ghostscript --no-install-recommends \
    imagemagick \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install zip

ENV TIMEZONE=America/Chicago
ENV TZ=America/Chicago

RUN touch /usr/local/etc/php/conf.d/dates.ini \
    && echo "date.timezone = $TZ;" >> /usr/local/etc/php/conf.d/dates.ini

RUN touch /usr/local/etc/php/conf.d/docker-php-memlimit.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN touch /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "post_max_size = 512M" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini \
    && echo "upload_max_filesize = 256M" >> /usr/local/etc/php/conf.d/docker-php-upload-settings.ini

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y
RUN chown -R www-data:www-data /var/www
