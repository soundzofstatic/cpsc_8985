FROM nginx:1.10

RUN apt-get update && \
    apt-get dist-upgrade -y && \
    apt-get install --no-install-recommends -y apache2-utils

ARG USER1=noone
ARG PASS1=nothing
ARG USER2=noone
ARG PASS2=nothing
ARG USER3=noone
ARG PASS3=nothing
ARG USER4=noone
ARG PASS4=nothing
ARG USER5=noone
ARG PASS5=nothing

RUN htpasswd -cb  /etc/nginx/.htpasswd $USER1 $PASS1
RUN htpasswd -b  /etc/nginx/.htpasswd $USER2 $PASS2
RUN htpasswd -b  /etc/nginx/.htpasswd $USER3 $PASS3
RUN htpasswd -b  /etc/nginx/.htpasswd $USER4 $PASS4
RUN htpasswd -b  /etc/nginx/.htpasswd $USER5 $PASS5

ADD vhost.conf /etc/nginx/conf.d/default.conf
