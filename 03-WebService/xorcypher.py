import sha,string

def bin2hex(binn):
	sonuc = binn.encode('hex')
	return sonuc

def hex2bin(hex):
	sonuc = hex.decode('hex')
	return sonuc

def string_xor(data, key): 
    return str(bytearray(a^b for a, b in zip(*map(bytearray, [data, key]))))

message = "START"
key = "ZEKEY"

hmsg = sha.new(message).hexdigest()
hkey = sha.new(key).hexdigest()
print "Msg:"+hmsg
print "Key:"+hkey

a = bin2hex(string_xor(hmsg,hkey))
print string_xor(hex2bin(a),hmsg)
