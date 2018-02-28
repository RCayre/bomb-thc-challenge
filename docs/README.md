"Un titre" + "abstract" + "une description" here ...
# Table of Contents
* [Installation](./README.md/#installation)
* [AndroidGestureForensic](./README.md/#androidGestureForensic)
* [Webserver vulnerability](./README.md/#webserver-vulnerability)
* ....

## Installation

## AndroidGestureForensic

## Webserver vulnerability
In this section, you have to first bypass the authentication by cookie and then exploit the LFI
### Authentication by cookie
Notre site Web utilise le mode ECB pour chiffrer l'username et retourner à l'utilisateur en tant que cookie.

Votre mission est de retrouver un cookie de l'utilisateur "admin" pour avoir accès à la page admin.php.

Nous verrons comment ce comportement peut affecter l'authentification et comment elle peut être exploitée.

#### ECB
ECB (Electronic codebook) est un mode de chiffrement dans lequel le message est divisé en blocs de longueur de X octets et chaque bloc est chiffré séparément à l'aide d'une clé **unique**.

Le schéma suivant (source: [Wikipedia](https://en.wikipedia.org/wiki/Block_cipher_mode_of_operation)) explique cette méthode:

![ecbencrypt](https://user-images.githubusercontent.com/26149560/36741024-5cc2be06-1be4-11e8-96c4-8c0684934230.PNG)

Pendant le déchiffrement, l'opération inverse est utilisée. L'utilisation de la ECB a de multiples implications de sécurité:

* Les blocs provenant d'un message chiffré peuvent être supprimés sans perturber le processus de déchiffrement.
* Les blocs d'un message chiffré peuvent être déplacés sans perturber le processus de déchiffrement.

### Remarque : 

Dans ce challenge, vous n'avez pas besoin d'une password pour enregistrer un utilisateur. 

Vous pouvez appuyer sur le touch F12 d'un navigateur web et choisir le tab Console. Tappez-vous ce commande javascript:
```
document.cookie="keyofcookie=valueofcookie"
```
Vous pouvez remplacer ou ajouter de nouveaux cookies avec cette technique.


Si vous avez besoin d'indices, voici une première indice:

<details>
<summary>Show</summary>

* Créer utilisateur "aaaaaaaa" (8*a) et "aaaaaaaaaaaaaaaa" (16*a)

   * Est-ce que vous vous rendez compte quelque chose de particulière au cookie "auth"?   
   
</details>   


Si vous avez besoin encore des indices, des questions suivants peuvent-être utiles :   
<details>
<summary>Show</summary>

   * Quelle est la taille d'un bloc?
   
   * Souvenez-vous le première implication de sécurité en-dessus, comment vous pouvez fabriquer un utilisateur pour lequel le cookie contient le cookie de "admin"?
   
   * Une fois vous trouvez le cookie, modifiez-vous le à l'aide de document.cookie
   
</details>
   
   
