# 4. Application Arduino
## Romain Cayre
Programme Arduino, contenant la logique de la bombe : commande de l'écran tactile de la bombe et scripts de communication python RPi / Arduino.
Ce composant logiciel est nécessaire à l'étape *3. Compréhension du Protocole*.

## Bugs rencontrés :
* La carte arduino reset une fois atteinte la valeur de compteur ~ 26:00 <**SEMBLE REGLÉ**>
=> *Problème de saturation de la RAM* : ajout d'un `free` dans la procédure `displayTime()` et d'un `Serial.flush()` après le `delay(1000)`.
* le script *listen.py* doit être lancé en background au préalable, sinon l'utilisation de *write.py* provoque un reset du compteur (problématique connue de la communication série de l'Arduino)


## Liste des fichiers disponibles
* __bomb.ino__ : code source du programme Arduino, gère l'affichage du compteur sur l'écran LCD, la gestion des commandes en serial
* __listen.py__ : script python de lecture de la liaison série (vers Arduino)
* __write.py__ : script python d'écriture sur la liaison série (vers Arduino)
* __libs__ : librairies nécessaires au bon fonctionnement de l'écran tactile

## Documentation associée
La documentation complète de l'étape utilisant ce composant logiciel est disponible dans le fichier *docs/protocole.html*.
