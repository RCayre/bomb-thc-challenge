# Challenge Tuto : Dr Horrible's Bomb Challenge
Ce dépôt contient l'intégralité des fichiers nécessaires au fonctionnement du Challenge Tuto de sécurité pour la convention THC 2018, réalisé par Tran et Cayre, ainsi que la documentation associée.

## Matériel nécessaire
La mise en place de ce challenge nécessite un certain nombre de composants matériels :
* Arduino Uno
* Ecran TFT LCD 2.8" (sous la forme d'un Shield, édité par Adafruit)
* Raspberry Pi
* Dongle Wifi
* Téléphone Android
* Connectiques

## Structure du dépôt
Le challenge est composé de trois étapes, à réaliser successivement : une étape supplémentaire a également été développée mais non intégrée au challenge (en raison des contraintes temporelles de l'atelier où sera présenté le challenge).
Notre dépôt est structuré en fonction des différents environnements logiciels. Les codes sources, ressources et binaires développés sont intégrés dans chacun des dossiers suivants :
*  	01-AndroidGestureForensic (contient les ressources nécessaires à l'étape 1. Android Forensic)
*  	02-AndroidApp (contient l'application Android, nécessaire à l'étape 3. Compréhension du Protocole)
*  	03-WebService (contient l'application Web, nécessaire aux étapes 2. Exploitation Web et 3. Compréhension du Protocole)
*  	03-WebService-Bis (contient l'application Web alternative, développée pour l'étape non intégrée 4. Authentification par Cookies)
*   04-ArduinoProgram (contient le programme Arduino, nécessaire à l'étape 3. Compréhension du Protocole)
*   05-DeploymentScripts (contient le script d'installation automatisé de l'environnement logiciel du Raspberry Pi)

La documentation, présentée au format HTML, est disponible dans le dossier :
* docs
