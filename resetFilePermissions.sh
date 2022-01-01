chown www-data:www-data -R * # Set Apache's www-data user as the owner
find . -type d -exec chmod 775 {} \;  # Change folder permissions to rwxrwxr-x
find . -type f -exec chmod 664 {} \;  # Change file permissions to rw-rw--r--
chmod +x resetFilePermissions.sh
