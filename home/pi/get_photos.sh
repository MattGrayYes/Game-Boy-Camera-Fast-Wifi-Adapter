#!/bin/bash
# The pi can't keep time while it's off
# but the photo saving app uses datetime to name its directories
# so this first section increments the date by one day

originaldate=$(date +"%s")
secondsinday=86400
fakedate=$((originaldate+secondsinday))
echo $originaldate
echo $fakedate
echo $(date)
date +%s -s @"$fakedate"
echo $(date)


cd /var/www/html/photos
/home/pi/bin/gbcamera_saver
