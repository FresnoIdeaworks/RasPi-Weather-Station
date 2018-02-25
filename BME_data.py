#coding: utf-8

import datetime
import os
import bme280
import smbus2

port = 1
address = 0x76
bus = smbus2.SMBus(port)
user = os.getenv("USER")
bme280.load_calibration_params(bus, address)

# the sample method will take a single reading and return a
# compensated_reading object
data = bme280.sample(bus, address)

print 'Temp      = {0:0.3f} deg C'.format(data.temperature)
print 'Pressure  = {0:0.2f} hPa'.format(data.pressure)
print 'Humidity  = {0:0.2f} %'.format(data.humidity)

dir_path = '/home/'+user+'/'

now = datetime.datetime.now()
filename = now.strftime('%Y%m%d')
label = now.strftime('%H:%M:%S')

if not os.path.exists('/home/'+user+'/'):
    os.makedirs('/home/'+user+'/')
f = open('/home/'+user+'/'+filename+'.csv','a')
f.write("'"+label+"',"+ str(data.temperature) +","+ str(data.pressure) +","+ str(data.humidity) +"\n")
f.close()
