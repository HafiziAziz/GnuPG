# GnuPG
+ Bone Structure for PGP encryption in PHP.

## Overview
+ Pretty Good Privacy is an encryption program that provides cryptographic privacy and authentication for data communication.

## Functionalities
+ Secure inbound and outbound request.
+ To avoid MITM attack.

## Techonology / Knowledge
+ RHEL 6
+ PHP 5.6/7.+
```
yum install php56-php-pecl-gnupg -y
```
+ Cheat sheet : http://irtfweb.ifa.hawaii.edu/~lockhart/gpg/

## JFYI
+ If GnuPG key been created not in default path. Kindly, declare the path in your code.
```
putenv("GNUPGHOME=/etc/pki/tls/certs/");
```