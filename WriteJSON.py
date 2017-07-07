# -*- coding: utf-8 -*-

import json
import serial
import time

def establishConnection(s):
    s.write('1')
    while 1:
        if s.inWaiting() > 0:
            break
    s.read()
    print '接続確立'


def main():
    values = {}
    index = 1

    s = serial.Serial('/dev/ttyACM0', 9600)
    time.sleep(2)

    establishConnection(s)
    
    while index <= 100:
        c = ''
        str = ''

        while c != '\n':
            str = str + c
            c = s.read()

        print str
        values[index] = int(str)
        index = index + 1
        s.write('1')

    s.close()
    f = open('data.json', 'w')
    json.dump(values, f, indent=4, sort_keys=True)
    f.close()

if __name__ == "__main__":
    main()
