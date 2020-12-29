#!/usr/bin/env bash

set -e
set -o pipefail

docker run \
  --rm \
  -ti \
  -e PAOKU17_MYSQL_HOST \
  -e PAOKU17_MYSQL_USER \
  -e PAOKU17_MYSQL_PASS \
  -v /data/17paoku.com/center/data:/webroot/center/data \
  -v /data/17paoku.com/home/data:/webroot/home/data \
  -v /data/17paoku.com/home/attachment:/webroot/home/attachment \
  -v /data/17paoku.com/wiki/data:/webroot/wiki/data \
  -v /data/17paoku.com/wiki/uploads:/webroot/wiki/uploads \
  -p 8080:80 \
  -e VIRTUAL_HOST=17paoku.zixia.net,*.17paoku.zixia.net \
  -e LETSENCRYPT_HOST=17paoku.zixia.net, \
  -e HTTPS_METHOD=noredirect \
  --entrypoint bash \
  17paoku.com

  #ghcr.io/zixia/17paoku.com
