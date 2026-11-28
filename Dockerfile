FROM php:8.3-cli

RUN apt update
RUN apt install -y libpq-dev && docker-php-ext-install pdo_pgsql

RUN pecl install redis && docker-php-ext-enable redis

RUN apt install -y libz-dev libmemcached-dev && pecl install memcached && docker-php-ext-enable memcached

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN apt-get install -y build-essential ninja-build git cmake pkg-config libuv1-dev libgmp-dev libssl-dev zlib1g-dev \
    && docker-php-ext-install gmp \
    && cd /tmp \
    && git clone --depth 1 https://github.com/scylladb/cpp-driver.git scyladb-driver \
    && cd scyladb-driver \
    && mkdir build \
    && cd build \
    && cmake -DCASS_CPP_STANDARD=17 -DCASS_BUILD_STATIC=ON -DCASS_BUILD_SHARED=ON -DCASS_USE_STD_ATOMIC=ON -DCASS_USE_TIMERFD=ON -DCASS_USE_LIBSSH2=ON -DCASS_USE_ZLIB=ON -DCMAKE_C_FLAGS="-fPIC" -DCMAKE_CXX_FLAGS="-fPIC -Wno-error=redundant-move" -DCMAKE_BUILD_TYPE="RelWithInfo" -G Ninja .. \
    && ninja install \
    && ldconfig

RUN cd /tmp \
    && git clone --recursive https://github.com/he4rt/scylladb-php-driver.git \
    && cd scylladb-php-driver \
    && export PKG_CONFIG_PATH=/usr/local/lib/x86_64-linux-gnu/pkgconfig \
    && cmake --preset ReleasePHP8.3NTS \
    && cmake --build out/ReleasePHP8.3NTS \
    && find out/ReleasePHP8.3NTS -name cassandra.so -exec cp {} "$(php-config --extension-dir)/" \; \
    && cp cassandra.ini /usr/local/etc/php/conf.d/z-cassandra.ini
