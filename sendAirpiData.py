#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
Authors:
Michalis Tsiolkas
Lucian Nikolaos Xaxiris
Marios Balamatsias
Vasileios Karavasilis
Gerasimos Chamalis
Savvopoylos Petros
Krommydas Konstantinos
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
  a = u'Ώρα:', dataDict['Date and time'];
  print ''.join(a).encode('utf-8');
  a = u'Θερμοκρασία (BMP):', dataDict['Temperature-BMP'];
  print ''.join(a).encode('utf-8');
  a = u'Πίεση:', dataDict['Pressure'];
  print ''.join(a).encode('utf-8');
  a = u'Υγρασία:', dataDict['Relative_Humidity'];
  print ''.join(a).encode('utf-8');
  a = u'Θερμοκρασία (DHT):', dataDict['Temperature-DHT'];
  print ''.join(a).encode('utf-8');
  a = u'Επίπεδο Φωτός:', dataDict['Light_Level'];
  print ''.join(a).encode('utf-8');
  a = u'Μονοξείδιο του Άνθρακα:', dataDict['Carbon_Monoxide'];
  print ''.join(a).encode('utf-8');
  a = u'Θόρυβος:', dataDict['Volume'];
  print ''.join(a).encode('utf-8');
  a = "";
  print ''.join(a).encode('utf-8');
  

def sendData(dataDict, rasId, rasPass):
  # rpiid = sys.argv[2];

  urlstr = 'http://met-ioamaellak.rhcloud.com/insert.php?id=' + rasId + \
           '&pass=' + rasPass + '&when=' + \
            dataDict['Date and time'].replace (" ", "T") + '&temp-bmp=' + \
            dataDict['Temperature-BMP'] + '&pressure=' + \
            dataDict['Pressure'] +'&humidity=' + \
            dataDict['Relative_Humidity'] +'&temp-dht=' + \
            dataDict['Temperature-DHT'] + '&light=' + \
            dataDict['Light_Level'] +'&CO=' + dataDict['Carbon_Monoxide'] + \
            '&volume=' + dataDict['Volume'];
  
  print urlstr;

  try:
    urllib2.urlopen(urlstr).read();
  except: 
    pass
  
#Get the name of the file with the json output.
def main(fileName, rasId, rasPass):
  #Open the file and read every line.
  file = open(fileName, 'r');
  for line in file:
    jl = json.loads(line);
    printData(jl);
    sendData(jl, rasId, rasPass);
  #Sleep and try to read more lines.
  while True:
    line = file.readline();
    if not line:
      time.sleep(0.5);
      continue;
    jl = json.loads(line);
    printData(jl);
    sendData(jl, rasId, rasPass);
  file.close();


if __name__ == "__main__":
  # Print usage and exit if less or more than 4 arguments are given.
  if len(sys.argv) != 4:
    print 'Usage: ', sys.argv[0], '<file_with_json>', '<AirPi ID>', '<Pass>';
    sys.exit(1);

  main(sys.argv[1], sys.argv[2], sys.argv[3])
