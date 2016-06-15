FROM base/archlinux

MAINTAINER Kai Hendry <hendry@iki.fi>

RUN pacman --noconfirm -Sy archlinux-keyring && \
	pacman -q -Syu --noconfirm nginx \
							   php \
							   php-fpm \
							   supervisor \
							   texlive-bin texlive-core

ADD www /srv/http
ADD nginx.conf /etc/nginx/nginx.conf
ADD php-fpm.ini /etc/supervisor.d/php-fpm.ini
ADD nginx.ini /etc/supervisor.d/nginx.ini

RUN chown -R http:http /srv/http

EXPOSE 80

CMD supervisord -n -c /etc/supervisord.conf
