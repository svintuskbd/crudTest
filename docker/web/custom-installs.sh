#!/usr/bin/env bash

apt-get update
apt-get install -y apt-utils gnupg2

apt-key add /tmp/postgresql_pubkey.asc
echo "deb http://apt.postgresql.org/pub/repos/apt/ stretch-pgdg main" > /etc/apt/sources.list.d/pgdg.list

apt-get update
apt-get install -y postgresql-client-10 \
  libicu-dev libpq-dev zlib1g-dev \
  git nano \
  --no-install-recommends

apt-get clean

rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
