<p align="center"><img src="./docs/mailjet.svg" width="300" alt="Mailjet for Craft CMS icon"></p>

<h1 align="center">Mailjet for Craft CMS 3</h1>

This plugin provides a [Mailjet](https://www.mailjet.com/) integration for [Craft CMS](https://craftcms.com/).

## Temporary note!

Craft already has a version of Swiftmailer to send emails. All Craft's mail adapters should (and probably will) use the Swiftmailer transport system.

 >Unfortunate the support of Mailjet's Swiftmailer transport integration is not yet merged for production ready codebase. Therefor you have to put the next lines in your `composer.json` file before requiring the plugin.

```json
{
  // ...
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

## Requirements

This plugin requires Craft CMS 3.1.5 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Mailjet”. Then click on the “Install” 
button in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require bertoost/craft-mailjet

# tell Craft to install the plugin
./craft install/plugin mailjet
```

## More...

- [Using Mailjet Email](docs/Email.md)
- [Using Mailjet SMS](docs/Sms.md)