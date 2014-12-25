#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
Authors:
Michalis Tsiolkas
Lucian Nikolaos Xaxiris
Marios Balamatsias
Vasileios Karavasilis

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
"""

### Can combined with the airpi program provided by
### https://github.com/haydnw/AirPi
### It reads the output json file, prints the lines
### and send to a server.

import sys
import json
import time
import urllib2

def printData(dataDict):
  print u'Ώρα:', dataDict['Date and time'];
  print u'Θερμοκρασία (BMP):', dataDict['Temperature-BMP'];
  print u'Πίεση:', dataDict['Pressure'];
  print u'Υγρασία:', dataDict['Relative_Humidity'];
  print u'Θερμοκρασία (DHT):', dataDict['Temperature-DHT'];
  print u'Επίπεδο Φωτός:', dataDict['Light_Level'];
  print u'Μονοξείδιο του Άνθρακα:', dataDict['Carbon_Monoxide'];
  print u'Θόρυβος:', dataDict['Volume'];
  print "";
  

def sendData(dataDict):
  rpiid = sys.argv[2];

  urlstr = 'http://weatherstation-mbalamat.rhcloud.com/insert.php?' \
  + 'rpiid=' + rpiid \
  + '&temp=' + dataDict['Temperature-BMP'] \
  + '&hum=' + dataDict['Relative_Humidity'];
  
  urllib2.urlopen(urlstr).read();

  
#Get the name of the file with the json output.
def main(fileName):
  #Open the file and read every line.
  file = open(fileName, 'r');
  for line in file:
    jl = json.loads(line);
    printData(jl);
    sendData(jl);
  #Sleep and try to read more lines.
  while True:
    line = file.readline();
    if not line:
      time.sleep(0.5);
      continue;
    jl = json.loads(line);
    printData(jl);
    sendData(jl);
  file.close();


if __name__ == "__main__":
  # Print usage and exit if less or more than three arguments are given.
  if len(sys.argv) != 3:
    print 'Usage: ', sys.argv[0], '<file_with_json>', '<AirPi ID>';
    sys.exit(1);

  main(sys.argv[1])
