FROM nginx:alpine

LABEL maintainer="Dieisson <dieisson.martins.santos@gmail.com>"

RUN apk update

COPY default.conf /etc/nginx/conf.d/default.conf
COPY upstream.conf /etc/nginx/conf.d/upstream.conf
