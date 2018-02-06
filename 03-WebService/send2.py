import serial,sys
print("test");
ser = serial.Serial('/dev/ttyACM0', 9600)
ser.write("STOP")

