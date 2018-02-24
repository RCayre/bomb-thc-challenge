import serial,sys,sha
ser = serial.Serial('/dev/ttyACM0', 9600)
ser.write(sha.new(sys.argv[1]).hexdigest())

