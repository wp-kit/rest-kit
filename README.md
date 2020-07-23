# wp-kit/rest-kit

```rest-kit``` is a micro [```RAD```](https://en.wikipedia.org/wiki/Rapid_application_development) solution for ```Wordpress REST API themes```.

## Installation

Download [Composer](https://getcomposer.org/download/) and install using this command

 ```php
cd wp-content/themes
composer create-project wp-kit/rest-kit rest-kit --prefer-dist
 ```
 
## Working with Bedrock?

Firstly, install Bedrock, then;

```
composer require wp-kit/rest-kit
cp -r vendor/wp-kit/rest-kit web/app/themes/rest-kit
(rm ./package.json || true) && mv web/app/themes/rest-kit/package.json ./package.json
(rm ./webpack.config.js || true) && mv web/app/themes/rest-kit/webpack.config.js ./webpack.config.js

// inside webpack.config.js change the following
const themeFolder = './web/app/themes/rest-kit';

npm i
npm run build
```

## When should you use wp-kit/rest-kit?

If you're looking for a theme to be able to build and manage custom Gutenberg blocks, and to consume Gutenberg block data via Wordpress Rest API, as well easily register Post Types and Taxonomies then this is a the perfect framework. Features include;

* Webpack configuration to easily create / edit Gutenberg blocks
* Gutenberg Blocks are JSONified and send with Post data in WP REST API
* ServiceProvider Config
* PostType Registration
* Taxonomy Registration
* Invoke Controllers on Conditions

## Get Involved

Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/wp-kit)
- Sharing the project around your community

## Requirements

Wordpress 4+

PHP 5.6+

Composer

Node

NPM

## Security Vulnerabilities

If you discover a security vulnerability within wp-kit/rest-kit, please send an e-mail to tech@creativelittledots.co.uk or raise an issue on this repo. All security vulnerabilities will be promptly addressed.

## License

wp-kit/rest-kit is open-sourced software licensed under the MIT License.
