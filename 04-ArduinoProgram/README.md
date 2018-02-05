# Challenge - Step 4
## Romain Cayre
Programme Arduino - commande de l'écran tactile de la bombe, scripts de communication python RPi / Arduino

- Programme arduino : bomb.ino (gère l'affichage du compteur sur l'écran LCD, la gestion des commandes en serial)
- Programme python : listen.py (enregistre la sortie de la communication serial dans un fichier bomb.log - lancer en background)
- Programme python : write.py <cmd> (envoie la commande cmd par la liaison serial)
Note : le script listen.py doit être lancé en background au préalable, sinon l'utilisation de write.py provoque un reset du compteur


# TODO:
* remplacer les commandes en clair par les commandes chiffrées
* commenter les scripts
