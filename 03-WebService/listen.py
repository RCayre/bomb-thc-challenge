import serial,time
ser = serial.Serial('/dev/ttyACM0', 9600)

# Chaque seconde, lire le temps revoie par andruino pour la synchornisation
while True:
	text_file = open('compteur','w+')
	text_file.write(ser.readline())
	text_file.close()
	time.sleep(1)
	print "write"
