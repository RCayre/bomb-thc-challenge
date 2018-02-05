import logging,serial
logging.basicConfig(filename='bomb.log',level=logging.DEBUG)

ser = serial.Serial('/dev/ttyACM0', 9600)

while True:
	logging.info(ser.readline())
