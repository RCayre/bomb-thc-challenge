# 3. Application Web
## Romain Cayre
Service Web, proposant une page "vitrine" de présentation du compteur, ainsi que les scripts nécessaires au fonctionnement du protocole de communication entre l'Android et l'Arduino.
Ce composant logiciel est nécessaire aux étapes *2. Exploitation Web* et *3. Compréhension du Protocole*.

## Bugs rencontrés :
* Pour pouvoir lancer les actionneurs, l'utilisateur du Raspberry Pi doit être dans le groupe **dialout** :
`usermod -G -a dialout www-data`

## Liste des fichiers disponibles
* __action.php__ : actionneur (PHP) proposant une API de communication vers l'Arduino
* __back.jpg__ : ressource de l'application web
* __compteur__ : fichier tampon contenant la valeur courante du compteur
* __exploit_lfi.py__ : script python solution (exploitation via inclusion de fichiers logs)
* __exploit_lfi_wrapper.py__ :	script python solution (exploitation via inclusion de PHP wrappers)
* __exploit_rfi.py__ : script python solution (exploitation via inclusion de fichier distant)
* __index.html__ : page web "vitrine"
* __init.php__ : script PHP d'initialisation du protocole de communication
* __listen.py__ : script python utilitaire de lecture de la liaison série (vers Arduino)
* __onetimepad__ : binaire ARM du programme de chiffrement OTP
* __onetimepad.c__ : code source C du programme de chiffrement OTP
* __read.php__ : fichier PHP utilitaire (lecture de fichiers)
* __script.js__ : script Javascript utilitaire (rechargement dynamique du compteur / AJAX)
* __send.py__ : script python utilitaire d'écriture sur la liaison série (vers Arduino)
* __style.css__ : feuille de style CSS de la page vitrine
* __video.mp4__ : ressource de l'application web
* __xorcypher.py__ : script solution pour la composante chiffrement du challenge

## Documentation associée
La documentation complète des étapes associées utilisant ce composant logiciel est disponible dans les fichiers *docs/web.html* et *docs/protocole.html*.
