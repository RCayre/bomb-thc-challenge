"Un titre" + "abstract" + "une description" here ...
# Table of Contents
* [Installation](./README.md/#installation)
* [AndroidGestureForensic](./README.md/#androidGestureForensic)
* [Webserver vulnerability](./README.md/#webserver-vulnerability)
* ....

## Installation

## AndroidGestureForensic

## Webserver vulnerability
In this section, you have to first bypass the authentication by cookie and then exploit the LFI in read.php
### Authentication by cookie
Our website uses ECB mode to encrypt username and return to user as a cookie.

Your mission is to find a cookie for user "admin" to get access to read.php and admin.php.

We will see how this behaviour can impact the authentication and how it can be exploited.

#### ECB
ECB is an encryption mode in which the message is splitted into blocks of X bytes length and each block is encrypted separetely using a key.

The following schema (source: [Wikipedia](https://en.wikipedia.org/wiki/Block_cipher_mode_of_operation)) explains this method:

![ecbencrypt](https://user-images.githubusercontent.com/26149560/36741024-5cc2be06-1be4-11e8-96c4-8c0684934230.PNG)

During the decryption, the reverse operation is used. Using ECB has multiple security implications:

* Blocks from encrypted message can be removed without disturbing the decryption process.
* Blocks from encrypted message can be moved around without disturbing the decryption process.
