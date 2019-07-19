#!/usr/bin/env sh

## run this script at the same host of the gearmand
gearman -w -f wc -- wc - l
