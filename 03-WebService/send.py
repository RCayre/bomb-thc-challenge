import serial,sys,sha
ser = serial.Serial('/dev/ttyACM0', 9600)
# On envoie le sha1 et non la chaîne xorée directement, car les données sont trop longues pour la liaison Serial
ser.write(sha.new(sys.argv[1]).hexdigest())

