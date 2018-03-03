#encoding:utf-8
import sha,string

# Conversion d'une chaîne de caractères contenant des caractères non imprimables en hexadécimal
def bin2hex(binn):
	ret = binn.encode('hex')
	return ret

# Conversion d'une chaîne de caractères en hexadécimal en binaire (caractères potentiellement non imprimables)
def hex2bin(hex):
	ret = hex.decode('hex')
	return ret

# Chiffrement de la chaîne data par la clé key par la méthode de chiffrement One Time Pad
def string_xor(data, key): 
    return str(bytearray(a^b for a, b in zip(*map(bytearray, [data, key]))))

# Fonction de hachage sha1
def sha1(clair):
	return sha.new(clair).hexdigest()


message = "STARTZESECRET"
clair1 = sha1(message)
chiffre1 = hex2bin("010e0500050d5355040109575d0350070f525d5d0403060052575b5807505c075d52530e01535602")
cle = string_xor(clair1,chiffre1)
print "Clé : " + cle
clair2 = sha1("STOPZESECRET")
print "Msg:" + bin2hex(string_xor(clair2,cle))
