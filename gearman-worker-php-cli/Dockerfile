FROM php:5.6.40-cli-alpine3.8

# 添加 PDO MySql Driver 实现
COPY pdo_mysql.ini /usr/local/etc/php/conf.d/pdo_mysql.ini
COPY pdo_mysql.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/pdo_mysql.so

# 添加 PHPUNIT
COPY phpunit-5.7.phar /usr/local/sbin/phpunit

# 添加代码规范检查工具 phpcs
COPY phpcs-3.4.2.phar /usr/local/sbin/phpcs
# 添加自动化代码修正工具 phpcbf
COPY phpcbf-3.4.2.phar /usr/local/sbin/phpcbf

COPY gearmand/gearmand-1.1.17.tar.gz /tmp/
COPY gearmand/patches/libhashkit-common.h.patch /tmp/
COPY gearmand/patches/libtest-cmdline.cc.patch /tmp/

RUN apk update  \
 && apk add --no-cache --virtual .build-deps \
        wget \
        tar \
        ca-certificates \
        file \
        alpine-sdk \
        gperf \
        boost-dev \
        libevent-dev \
        util-linux-dev \
        hiredis-dev \
        libressl-dev \
        autoconf \
        re2c \
  # Redis PECL
  && printf "\n" | pecl install redis-4.3.0 \
  && docker-php-ext-enable redis \
  # Gearmand and libgearman
  && cd /tmp  \
  && tar xfz gearmand-1.1.17.tar.gz  \
  && cd gearmand-1.1.17 \
  && patch -p1 < /tmp/libhashkit-common.h.patch  \
  && patch -p1 < /tmp/libtest-cmdline.cc.patch  \
  && ./configure \
      --sysconfdir=/etc \
      --localstatedir=/var \
      --with-mysql=no \
      --with-postgresql=no \
      --disable-libpq \
      --disable-libtokyocabinet \
      --disable-libdrizzle \
      --disable-libmemcached \
      --enable-ssl \
      --disable-hiredis \
      --enable-jobserver=no \
  && make \
  && make install \
  && cd /tmp \
  && rm -f gearmand-1.1.17.tar.gz  \
  && rm -f libhashkit-common.h.patch \
  && rm -f libtest-cmdline.cc.patch \
  && rm -rf gearmand-1.1.17 \
  # gearman pecl
  && pecl install gearman-1.1.2 \
  && docker-php-ext-enable gearman \
  && rm -rf /tmp/pear/download/* \
  && apk del .build-deps \
  && apk add --no-cache boost-program_options \
          libevent \
          libuuid \
          libstdc++ \
          make


# IV. 工作目录
RUN mkdir -p /data/worker \
  && mkdir -p /data/log \
  && chown -R www-data:www-data /data \
  && chmod -R 777 /data
