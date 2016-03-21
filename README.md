# Liege Hackerspace Website

This is the repository of the Front Pages for
Liege Hackerspace (LgHS) Website. Welcome.

## How to run

The website has Symfony Microframework as a server. It can be
 seen as a Symfony application but with a simpler file
 structure. For more info, refer to Symfony blog post : [New in Symfony 2.8: Symfony as a Microframework](http://symfony.com/blog/new-in-symfony-2-8-symfony-as-a-microframework).

1. `git clone https://github.com/LgHS/Site-Web-Front`
1. `composer install`
1. `npm install`
1. `npm run build` to build assets, generate favicons and copy fonts
1. Point Virtual Host to `files/` or run `php -S localhost:8000 -t files/`

## Dev

* `npm run watch` will rebuild scss files at every change.
* To activate Symfony debug tools, simply change AppKernel instantiation
   in `files/index.php`.