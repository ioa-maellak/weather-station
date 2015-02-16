#!/bin/bash
#Authors:
#Loykianos-Nikolaos Xaxiris
#Vasileios Karavasilis
#Tsiolkas Michalis

JSON_FILENAME=~/airpi-jsonfile.json
#Remove old prosesses.
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
#Start airpi
cd ~/airpi/AirPi
/usr/bin/sudo /usr/bin/python airpi.py 2>&1 >> ~/log/airpi.log &
#Start send service.
cd ~/airpi/weather-station
/usr/bin/python sendAirpiData.py $JSON_FILENAME $PIID $PIPASS 2>&1 >> ~/log/sendAirpiData.log &
