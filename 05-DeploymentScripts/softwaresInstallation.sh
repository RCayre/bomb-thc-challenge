#!/bin/bash

# Mise à jour de raspbian et de la liste des dépôts
sudo apt-get update
sudo apt-get upgrade

# Installation et configuration du point d'accès réseau sans fil
# Installation
sudo apt-get install dnsmasq hostapd
# Désactivation des services pour configuration
sudo systemctl stop dnsmasq
sudo systemctl stop hostapd
# Configuration du serveur DHCP
sudo cp ./dhcpcd.conf /etc/dhcpcd.conf
sudo service dhcpcd restart
# Configuration du serveur DNS
sudo mv /etc/dnsmasq.conf /etc/dnsmasq.conf.orig
sudo cp ./dnsmasq.conf /etc/dnsmasq.conf
# Configuration du point d'accès
sudo cp ./hostapd.conf /etc/hostapd/hostapd.conf
sudo cp ./hostapd /etc/default/hostapd

# Redémarrage des services
sudo systemctl start hostapd
sudo systemctl start dnsmasq

# Configuration du routage
sudo cp ./sysctl.conf /etc/sysctl.conf
sudo iptables -t nat -A  POSTROUTING -o eth0 -j MASQUERADE
sudo sh -c "iptables-save > /etc/iptables.ipv4.nat"
sudo cp ./rc.local /etc/rc.local



# Installation du serveur web Apache et de PHP
sudo apt install apache2 php php-mbstring
# Modification des droits d'écriture du dossier html
sudo chown -R pi:www-data /var/www/html/ 
sudo chmod -R 770 /var/www/html/
# Installation d'un php.ini permissif (allow_url_include On notamment)
sudo cp ./php.ini /etc/php/7.0/apache2/php.ini

# Lancement d'apache au démarrage
sudo update-rc.d apache2 defaults

# Installation de python et de la librairie pour la communication série
sudo apt install python pyserial
sudo usermod -a -G dialout www-data

# Installation de tcpdump et ajout de l'utilisateur www-data (pour permettre de sniffer l'interface après exploitation de la LFI)
sudo apt install tcpdump
sudo groupadd pcap
sudo usermod -a -G pcap www-data
sudo chgrp pcap /usr/sbin/tcpdump
sudo chmod 750 /usr/sbin/tcpdump
sudo setcap cap_net_raw,cap_net_admin=eip /usr/sbin/tcpdump

# Déploiement du site web
sudo cp ../03-WebService/* /var/www/html/*

# Compilation des sources C
cd /var/www/html
gcc onetimepad.c -o onetimepad
rm onetimepad.c

# Redémarrage
sudo reboot
