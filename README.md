<p align="center"><img src="./docs/mailjet.svg" width="300" alt="Mailjet for Craft CMS icon"></p>

<h1 align="center">Mailjet for Craft CMS 3</h1>

This plugin provides a [Mailjet](https://www.mailjet.com/) integration for [Craft CMS](https://craftcms.com/).

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

## SMS

This plugin also supports the SMS features from Mailjet. Once you have completed the setup for SMS and added 
some credits to your SMS account, you can get an API Token from your 
[Mailjet account page](https://app.mailjet.com/sms) and configure it via the plugin settings section.

Once completed, you can easily call the SMS service to send an text message.

```php
// don't forget to use the plugin
use bertoost\mailjet\Plugin;

// send away
$sent = Plugin::getInstance()->getSms()->send('+310600000000', 'Your message');
```

## Setup

Once Mailjet is installed, go to Settings → Email, and change the “Transport Type” setting to “Mailjet”. 
Enter your Mailjet API Key and API secret (which you can get from 
[app.mailjet.com/account/setup](https://app.mailjet.com/account/setup)), then click Save.

> **Tip:** The API Key and API Secret settings can be set to an environment variables. See [Environmental Configuration](https://docs.craftcms.com/v3/config/environments.html) in the Craft docs to learn more about that.