# Accords-CMS
A simple CMS written in PHP. Pages are stored as JSON files, and the content is written in Markdown. 

## Functionalities

### Login
 - Login page at /login
 - Support multiple users
 - Uses PHP built-in `password_hash` and `password_verify` for storing password and authentication

### Pages
 - Create, edit, and delete pages
 - Change a page slug (the URL to reach the page)
 - Pages have metadata such as the creation time, modification time, author, and title.

## Todo

### Accounts
 - Being able to create, edit, delete account
 - Support for user roles: Admin, Editor, Author, Contributor, and Subscriber (like WordPress)
 - Maybe add a registration form

### Images
 - Being able to create, delete images
 - Autoremoval of EXIF metadata (like GPS coordinates)
 - Autoconvertion to standard format (WebP and Jpg)
 - Backend gallery of all uploaded image
 - Being able to edit the metadata (alt)

### Pages
 - Ability to add tags

### Tags
 - Ability to create, edit, delete tags
 - Ability to create, edit, delete type of tags
 
