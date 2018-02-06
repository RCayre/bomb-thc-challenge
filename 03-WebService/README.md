# Challenge - Step 3
## Romain Cayre
WebService : exploitation de vulnérabilité web, communication Raspberry Pi / arduino

Bugs rencontrés :
* Pour pouvoir lancer les actionneurs, l'utilisateur du raspberry pi doit être dans le groupe "dialout"
usermod -G -a dialout www-data

