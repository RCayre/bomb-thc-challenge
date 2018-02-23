import serial,sys
ser = serial.Serial('/dev/ttyACM0', 9600)
ser.write(sys.argv[1])

