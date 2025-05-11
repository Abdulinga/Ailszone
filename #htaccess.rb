# .htaccess

# Enable mod_rewrite
RewriteEngine On

# Redirect to HTTPS (if SSL is enabled)
# Uncomment the following lines if your site uses HTTPS
# RewriteCond %{HTTPS} !=on
# RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Remove .php extension from URLs
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^/]+)$ $1.php [L]

# Redirect to index.php if no file or directory exists
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [L]

# Deny access to sensitive files
<FilesMatch "\.(htaccess|htpasswd|ini|log|sh|bak|sql|php)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

