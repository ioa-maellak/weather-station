#!/bin/bash
#Authors:
#Loykianos-Nikolaos Xaxiris
#Vasileios Karavasilis
#
#This program is free software: you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation, either version 3 of the License, or
#(at your option) any later version.
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program.  If not, see <http://www.gnu.org/licenses/>.

JSON_FILENAME=~/airpi-jsonfile.json
#Remove old prosesses.
/bin/ps -aAf | /bin/grep python | /bin/grep airpi.py | /usr/bin/awk '{print $2}' | /usr/bin/xargs /usr/bin/sudo /bin/kill -9
/bin/ps -aAf | /bin/grep python | /bin/grep sendAirpiData.py | /usr/bin/awk '{print $2}' | /usr/bin/xargs /usr/bin/sudo /bin/kill -9
#Remove the old file and create an empty one.
rm -f $JSON_FILENAME
touch $JSON_FILENAME

