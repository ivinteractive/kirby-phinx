# Phinx for Kirby

Run database migrations and seeders on the command-line using Phinx with a Kirby CMS wrapper for migration and seed paths.

###Installation

- Download the repo and unzip in site/plugins/kirby-phinx or install as a git submodule.
```
git submodule add https://github.com/ivinteractive/kirby-phinx.git site/plugins/kirby-phinx
```
- Run `composer install` in the plugin directory.
- Copy `.env.example` to `.env` and add your database credentials.
- Create `migrations` and `seeds` directories at the site root.

###Important note

Whether or not you change the name of the migrations and seeds directories from the defaults, you should edit your .htaccess to redirect those directories, like so:

```
# block all files in the migrations folder from being accessed directly
RewriteRule ^migrations/(.*) index.php [L]

# block all files in the seeds folder from being accessed directly
RewriteRule ^seeds/(.*) index.php [L]
```