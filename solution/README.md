

### Bypass authentication
Tout d'abord, nous pouvons commencer par créer deux comptes **aaaaaaaa** et **aaaaaaaaaaaaaaaa** et comparer le cookie envoyé par l'application

| Username: | aaaaaaaa | aaaaaaaaaaaaaaaa |
|----------|----------|------------------|
| Cookie: | RdrBnAuTHWcEHvbhgcSzgg%3D%3D | RdrBnAuTHWdF2sGcC5MdZwQe9uGBxLOC |

Le signe ``%3D%3D`` signifie ``==`` est un bon indicateur de chaîne codée en base64. Donc nos cookies après url décodé sont:

| Username: | aaaaaaaa | aaaaaaaaaaaaaaaa |
|----------|----------|------------------|
| Cookie: | RdrBnAuTHWcEHvbhgcSzgg== | RdrBnAuTHWdF2sGcC5MdZwQe9uGBxLOC |


Si on décode les deux cookies en base64, nous obtenons les chaînes suivantes:

| Username: | aaaaaaaa | aaaaaaaaaaaaaaaa |
|----------|----------|------------------|
| Cookie: | **E\xda\xc1\x9c\x0b\x93\x1dg**\x04\x1e\xf6\xe1\x81\xc4\xb3\x82 | **E\xda\xc1\x9c\x0b\x93\x1dgE\xda\xc1\x9c\x0b\x93\x1dg**\x04\x1e\xf6\xe1\x81\xc4\xb3\x82 |

On peut voir bien que le bloc `E\xda\xc1\x9c\x0b\x93\x1dg` répète 2 fois pour user `aaaaaaaaaaaaaaaa`
donc on peut bien voir ici la taille d'un bloc est 8 octets.


Un petit remarque : Les cookies terminent par `\x04\x1e\xf6\xe1\x81\xc4\xb3\x82` car le `\0` situe à la fin d'une chaîne de caractères forme un nouveau bloc car la longueur totale devient 9(17) qui doit être ensuite paddé à 16(24)

On peut créer un user `helo` et ça donne `9F\xdbY\xb6\xb5o\x80` car la longueur totale ne dépasse pas 8 octets donc padder à 8 octets. 

#### Exploit
Comme on n'a pas droit de créer user `admin`, on va créer "aaaaaaaaadmin", 8 premières octets pour remplacer le première bloc et 8 octets suivants est le cookie authentication pour user `admin`

![150x125](https://user-images.githubusercontent.com/26149560/36853856-d1b7a01e-1d6f-11e8-8248-742995fb076c.png)

Après avoir crée `aaaaaaaaadmin` on recois ce cookie :

```

> document.cookie

< "auth=RdrBnAuTHWdJB8In%2Bl73Ow%3D%3D"

```

On décode en URL et puis en base64 et recois :

```
python3 -c "print(__import__('urllib.parse').parse.unquote('RdrBnAuTHWdJB8In%2Bl73Ow%3D%3D'))"

> RdrBnAuTHWdJB8In+l73Ow==

python3 -c "print(__import__('base64').b64decode('RdrBnAuTHWdJB8In+l73Ow=='))"

> b"E\xda\xc1\x9c\x0b\x93\x1dgI\x07\xc2'\xfa^\xf7;"

```

On prend 8 dernières octets et reencoder en base64 : 

```

python3 -c "print(__import__('base64').b64encode(b'I\x07\xc2\'\xfa^\xf7;'))"

> b'SQfCJ/pe9zs='


```

le cookie authentication pour "admin" est : `SQfCJ/pe9zs=`

Remarque : Comme le forme hexadécimal du cookie contient `'` donc il faut l'échapper si on fait chaque étape individuellement.
Sinon, le script `authBypass.py`  peut-être utiliser pour automatiser l'exploit. 
