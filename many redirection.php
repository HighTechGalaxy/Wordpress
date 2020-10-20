/*Troubleshooting: Too Many Redirects   https://www.liquidweb.com/kb/troubleshooting-too-many-redirects/*/


RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
