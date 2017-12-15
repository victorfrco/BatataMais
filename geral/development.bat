@echo off
start C:\starthttpd.vbs
start C:\startmysqld.vbs
start chrome http://localhost:8000
cd \Users\victor.oliveira\ProjetoBatata\
php artisan serve
Exit