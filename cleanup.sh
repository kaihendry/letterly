#!/bin/bash
#set -ex

# Delete letters older than a day
# Only if you know the URL of the letter you will be able to view it within the day it was created

LETTERS=/srv/www/letterly.com/l
find $LETTERS -mindepth 1 -maxdepth 1 -type d  -ctime +1 -exec rm -vrf {} \;
