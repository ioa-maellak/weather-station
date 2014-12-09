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
###It reads the output json file, prints the lines
### and send to a server.

import sys
import json
import time

def printData(m):
  print u'Ώρα', m['Date and time'], u'θερμοκρασία', m['Temperature-BMP'], u' Υγρασία:', m['Relative_Humidity'];


#Get the name of the file with the json output.
def main(fileName):
  #Open the file and read every line.
  file = open(fileName, 'r');
  #Print the existing lines.
  for line in file:
    #print line;
    m = json.loads(line);
    #print(m);
    printData(m);
  #Sleep and try to read more lines.
  while True:
    line = file.readline();
    if not line:
      time.sleep(0.5);
      continue;
    m = json.loads(line);
    printData(m);
    
  file.close();

if __name__ == "__main__":
  #Exit if less or more arguments are given.
  if len(sys.argv) != 2:
    print 'Usage: ', sys.argv[0], '<file_with_json>';
    sys.exit(1);

  #print 'Number of arguments:', len(sys.argv), 'arguments.' print 
  #'Argument List:', str(sys.argv)
  print sys.getdefaultencoding()
  main(sys.argv[1])
