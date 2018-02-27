#!/usr/bin/env python
#encoding:utf-8
import hashlib
import binascii
import os,time
import sys
from itertools import chain, product

def usage():
	print "Usage : {} {} {} {} {} {} {}\n".format(sys.argv[0],"<alphabet>","<fonction de hashage>","<longueur minimale>","<longueur maximale>","<contraintes>","<valeur à inverser>")
	print "Description : ce script est destiné à retrouver par force brute la valeur d'un antécédent pour une fonction de hashage donnée. Il permet notamment de choisir l'alphabet à utiliser pour générer l'antécédent, un certain nombre de contraintes à respecter (longueur, agencement), ainsi que la fonction de hashage.\n\n"
	print "\n- <alphabet> : les valeurs hexadécimales de l'alphabet de départ, séparées par des virgules"
	print "    Exemple : pour utiliser l'alphabet 'abcd', entrer la chaîne '61,62,63,64'"
	print "\n- <fonction de hashage> : valeur textuelle à choisir entre md4,md5,sha1,sha224,sha256,sha384,sha512"
	print "    Exemple : pour utiliser la fonction de hashage md5, entrer la chaîne md5"
	print "\n- <longueur minimale> : longueur (en nombre de symboles) minimale de l'antécédent"
	print "    Exemple : 3"
	print "\n- <longueur maximale> : longueur (en nombre de symboles) maximale de l'antécédent"
	print "    Exemple : 10"
	print "\n- <contraintes> : chaînes de caractères désignant les contraintes à appliquer à l'antécédent, séparées par des virgules"
	print "    Exemple : 'sym,diff' pour que l'antécédent soit symétrique et composé de symboles tous différents"
	print "	   -> Liste des contraintes :"
	print "		* succ : aucun symbole successif identique dans l'antécédent"
	print "		* diff : tout les symboles de l'antécédent sont différents"
	print "		* sym : l'antécédent est symétrique (palindrome)"
	print "		* asym : l'antécédent est asymétrique"
	print "\n- <valeur à inverser> : valeur de l'empreinte à trouver"
	print "    Exemple : f02368945726d5fc2a14eb576f7276c0"


def hashfunction(hashtype,cleartext):
	if hashtype in hashlib.algorithms_available:
		h = hashlib.new(hashtype)
		h.update(cleartext)
		return h.hexdigest()
	else:
		return None

def bruteforce(alphabet, minlength,maxlength):
    return (''.join(candidate)
        for candidate in chain.from_iterable(product(alphabet, repeat=i)
        for i in range(minlength, maxlength + 1)))

def contrainte_nonsuccessifs(mot):
	for i in range(0,len(mot)-1):
		if mot[i]==mot[i+1]:
			return False
	return True

def contrainte_tousdifferents(mot):
	trouves = []
	for l in mot:
		if l in trouves:
			return False
		else:
			trouves.append(l)
	return True

def contrainte_symetrique(mot):
	i = 0
	while i < len(mot):
		if mot[i] != mot[-i-1]:
			return False
		i+=1
	return True
	
def contrainte_asymetrique(mot):
	return not contrainte_symetrique(mot)

def verifier_contraintes(mot,contraintes):
	examen = True
	if "succ" in contraintes:
		examen = examen and contrainte_nonsuccessifs(mot)
	if "diff" in contraintes:
		examen = examen and contrainte_tousdifferents(mot)
	if "sym" in contraintes:
		examen = examen and contrainte_symetrique(mot)
	if "asym" in contraintes:
		examen = examen and contrainte_asymetrique(mot)
	return examen

if len(sys.argv) == 7:
	alphabetascii = sys.argv[1].split(",")
	hashtype = sys.argv[2]
	lmin = int(sys.argv[3])
	lmax = int(sys.argv[4])
	contraintes = sys.argv[5].split(",")
	valeur = sys.argv[6]
	alphabet = []
	for i in alphabetascii:
		alphabet.append(binascii.unhexlify(i))

	for mot in bruteforce(alphabet,lmin,lmax):
		if (verifier_contraintes(mot,contraintes)):
			motaff = binascii.hexlify(mot)
			hashmot = hashfunction(hashtype,mot)
			print "{} -[{}]-> {}".format(motaff,hashtype,hashmot),
			if hashmot == valeur:
				print "\033[32m V\033[39m"
				print "\033[32mHash inversé : {}\033[39m".format(motaff)
				exit(0)
			else:
				print "\033[31m X\033[39m"

	print "Hash non trouvé !"
	

else:
	usage()

