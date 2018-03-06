# Challenge Tuto : Dr Horrible's Bomb Challenge

Ce dépôt contient l'intégralité des fichiers nécessaires au fonctionnement du Challenge Tuto de sécurité pour la convention THC 2018, réalisé par Tran et Cayre, ainsi que la documentation associée.L'objectif de ce challenge tuto est de vous faire découvrir des domaines variés de la sécurité informatique, au travers d'une série d'épreuves variées et ludiques.

## Synopsis
Une menace terrible pèse sur la THC ! Profitant de la pause café, le maléfique Dr Horrible a réussi à s'introduire dans les locaux pour y déposer un engin explosif... Votre mission, si vous l'acceptez : désactiver la bombe avant la fin du temps imparti ! Pour vous aider dans cette tâche, il vous faudra résoudre une série de trois épreuves. Pour découvrir une épreuve, il vous suffit de cliquer sur l'un des liens proposés dans la documentation associée (dossier *docs*). Pour chaque étape, trois niveaux de difficultés sont possible, en fonction de vos connaissances en sécurité informatique.

## Matériel nécessaire
La mise en place de ce challenge nécessite un certain nombre de composants matériels :
* __Arduino Uno__
* __Ecran TFT LCD 2.8"__ (sous la forme d'un Shield, édité par Adafruit)
* __Raspberry Pi__
* __Dongle Wifi__
* __Téléphone Android__
* __Connectiques__

## Installation & Mise en place
La procédure d'installation du challenge est détaillée dans le fichier de documentation *docs/installation.html*. 

## Structure du dépôt
Le challenge est composé de trois étapes, à réaliser successivement : une étape supplémentaire a également été développée mais non intégrée au challenge (en raison des contraintes temporelles de l'atelier où sera présenté le challenge).
Notre dépôt est structuré en fonction des différents environnements logiciels. Les codes sources, ressources et binaires développés sont intégrés dans chacun des dossiers suivants :
*  	__01-AndroidGestureForensic__ (contient les ressources nécessaires à l'étape *1. Android Forensic*)
*  	__02-AndroidApp__ (contient l'application Android, nécessaire à l'étape *3. Compréhension du Protocole*)
*  	__03-WebService__ (contient l'application Web, nécessaire aux étapes *2. Exploitation Web* et *3. Compréhension du Protocole*)
*  	__03-WebService-Bis__ (contient l'application Web alternative, développée pour l'étape non intégrée *4. Authentification par Cookies*)
*   __04-ArduinoProgram__ (contient le programme Arduino, nécessaire à l'étape *3. Compréhension du Protocole*)
*   __05-DeploymentScripts__ (contient le script d'installation automatisé de l'environnement logiciel du Raspberry Pi)

La documentation, présentée au format HTML, est disponible dans le dossier :
* __docs__
