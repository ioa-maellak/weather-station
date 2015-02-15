#!/bin/bash
#Authors:
#Loykianos-Nikolaos Xaxiris
#Vasileios Karavasilis

JSON_FILENAME=~/airpi-jsonfile.json
#Remove old prosesses.
/bin/ps -aAf | /bin/grep python | /bin/grep airpi.py | /usr/bin/awk '{print $2}' | /usr/bin/xargs /usr/bin/sudo /bin/kill -9
/bin/ps -aAf | /bin/grep python | /bin/grep sendAirpiData.py | /usr/bin/awk '{print $2}' | /usr/bin/xargs /usr/bin/sudo /bin/kill -9
#Remove the old file and create an empty one.
rm -f $JSON_FILENAME
touch $JSON_FILENAME

