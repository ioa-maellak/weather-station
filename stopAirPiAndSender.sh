#!/bin/bash
#Authors:
#Loykianos-Nikolaos Xaxiris
#Vasileios Karavasilis

JSON_FILENAME=~/airpi-jsonfile.json

pid=/bin/ps -aAf | /bin/grep python | /bin/grep airpi.py |
    /usr/bin/awk '{print $2}'

if [ $pid="" ]; then
    echo "There isn't such a process!"
else
    /usr/bin/sudo /bin/kill -9 $pid    
fi

pid=/bin/ps -aAf | /bin/grep python | /bin/grep sendAirpiData.py |
    /usr/bin/awk '{print $2}'

if [ $pid="" ]; then
    echo "There isn't such a process!"
else
    /usr/bin/sudo /bin/kill -9 $pid    
fi


#Remove the old file and create an empty one.
rm -f $JSON_FILENAME
touch $JSON_FILENAME

