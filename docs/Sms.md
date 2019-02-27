<p align="center"><img src="./mailjet.svg" width="300" alt="Mailjet for Craft CMS icon"></p>

<h1 align="center">Mailjet SMS</h1>

This plugin also supports the SMS features from Mailjet. Once you have completed the setup for SMS and added 
some credits to your SMS account, you can get an API Token from your 
[Mailjet account page](https://app.mailjet.com/sms) and configure it via the plugin settings section.

Once completed, you can easily call the SMS service to send an text message.

```php
// don't forget to use the plugin
use bertoost\mailjet\Plugin;

// send away
$sent = Plugin::getInstance()->getSms()
    ->send('+310600000000', 'Your message');
```
