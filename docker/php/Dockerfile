FROM php:7.4-fpm
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
COPY sources.list .
RUN mv /etc/apt/sources.list /etc/apt/sources.list.bak && mv sources.list /etc/apt/
RUN apt-get update
RUN apt-get install  --allow-downgrades -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g=1:1.2.8.dfsg-5 \
        libz-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql bcmath
#按需安装xdebug redis swoole等扩展
RUN pecl install redis-5.1.1 \
    && pecl install swoole \
    && docker-php-ext-enable redis swoole pdo_mysql opcache
