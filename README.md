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
cp -r vendor/wp-kit/rest-kit web/app/themes
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

## Recommended Plugins

We recommend the following plugins depending your use case:

|Plugin Name|Explanation|
|----|-----|
|[WP Rest Filter](https://wordpress.org/plugins/wp-rest-filter/)|In the boilerplate code for [wp-sapper-start](https://github.com/wp-kit/wp-sapper-start), we have included examples of filtering by term and author slugs, and have implemented this based on using WP Rest Filter. We generally recommend this plugin when seeking to fetch posts and pages primarily based on term slugs.|
|[Yoast SEO](https://wordpress.org/plugins/wordpress-seo/)|In the boilerplate code for [wp-sapper-start](https://github.com/wp-kit/wp-sapper-start), we have included examples of <head> meta tags, and have implemented this based on using Yoast SEO and WP Rest Yoast Meta. We generally recommend this plugin in all cases to control <head> tags within any framework you may be using.|
|[WP Rest Yoast Meta](https://wordpress.org/plugins/wp-rest-yoast-meta/)|In the boilerplate code for [wp-sapper-start](https://github.com/wp-kit/wp-sapper-start), we have included examples of <head> meta tags, and have implemented this based on using Yoast SEO and WP Rest Yoast Meta. We generally recommend this plugin in all cases to control <head> tags within any framework you may be using.|
|[WP Rest API V2 Menus](https://wordpress.org/plugins/wp-rest-api-v2-menus/)|In the boilerplate code for [wp-sapper-start](https://github.com/wp-kit/wp-sapper-start), we have included examples of fetching menus, and have implemented this based on using the endpoints provided by WP Rest API V2 Menus|
|[Application Password](https://wordpress.org/plugins/application-passwords/)|In the boilerplate code for [wp-sapper-start](https://github.com/wp-kit/wp-sapper-start), we have included examples of creating comments, form submissions and previewing draft post and pages; we have implemented this based on storing username and application password in a .env file which is read using server routes which sends a Basic authentication header to the API, this requires Application Password. We generally recommend this plugin when needing to write data back to the API or when needing to authenticate with Wordpress for any reason from your app. We recommend this over storing the raw password in .env or using WP oAuth Server which add more complexity than is neccessary due for a headless website.|
|[ACF to REST API](https://en-gb.wordpress.org/plugins/acf-to-rest-api/)|We generally recommend this plugin if you plan on using ACF in order to output field values within feild groups assigned to Posts and Pages, as oppose to Blocks. Any fields assigned to ACF Blocks are automatically pulled into the response when using rest-kit|
|[WP REST Cache](https://wordpress.org/plugins/wp-rest-cache/)|We generally recommend this plugin for all scenarios when using Wordpress as a headless CMS regardless of the framework you are using.| 
 
## Gists

__Menu Endpoint__

We have recently removed the Menu endpoint by default from the boilerplate code in favour of using [WP Rest API V2 Menus](https://wordpress.org/plugins/wp-rest-api-v2-menus/). You can easily add this back:

[Add Menu endpoint in wp-kit/rest-kit, if you don't want to use plugins/wp-rest-api-v2-menus](https://gist.github.com/terence1990/64ac107521142f2e65d8bf9053f7934f)

__Adjusting Gutenberg JSON__

We have recently pruned the transformation code right back so the schema of blocks received in the response is exactly the schema provided by `parse_blocks()`. You can change and transform this however you wish:

[Adjusting Gutenberg Block output in REST Response](https://gist.github.com/terence1990/223aa816df7d600005e55c39e9598b5d)

## Get Involved

Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/wp-kit)
- Sharing the project around your community

## Requirements

Wordpress 5+

PHP 7.4+

Composer

Node

NPM

## Security Vulnerabilities

If you discover a security vulnerability within wp-kit/rest-kit, please send an e-mail to tech@creativelittledots.co.uk or raise an issue on this repo. All security vulnerabilities will be promptly addressed.

## License

wp-kit/rest-kit is open-sourced software licensed under the MIT License.
