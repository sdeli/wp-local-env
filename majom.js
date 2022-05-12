var http = require('http');

http.createServer(function (request, response) {
    console.log('request starting...');
    response.end('sannya', 'utf-8');
}).listen(80);
a2dismod mpm_event && a2enmod mpm_prefork && a2enmod php7

apt install libapache2-mod-php7.3 libapache2-mod-php
a2enmod php7.0