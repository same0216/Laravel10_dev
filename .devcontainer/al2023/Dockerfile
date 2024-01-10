FROM amazonlinux:2023

RUN dnf -y update
RUN dnf install -y which zip procps-ng systemd glibc-langpack-ja vim-minimal tar

# Nginxインストール
RUN dnf install -y nginx

# PHP82をインストール
RUN dnf install -y php8.2
RUN dnf install -y php8.2-gd php8.2-bcmath php8.2-soap php8.2-intl php8.2-mysqlnd

# Postfixインストール
RUN dnf install -y postfix

# Composerインストール
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# NodeJSインストール
RUN dnf install -y nodejs

CMD ["/sbin/init"]

# 日本語・タイムゾーン設定
ENV LANG ja_JP.utf8
ENV LC_ALL ja_JP.utf8
RUN unlink /etc/localtime
RUN ln -s /usr/share/zoneinfo/Japan /etc/localtime

# 自動起動設定
RUN systemctl enable nginx
RUN systemctl enable php-fpm
RUN systemctl enable postfix

WORKDIR /usr/share/nginx
