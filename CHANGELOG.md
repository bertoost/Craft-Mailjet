# Craft CMS - Mailjet mailer adapter

## v2.1.0 - 2024-05-20

### Changed

- Updated for Craft CMS 5

## v2.0.2 - 2024-03-24

### Changed

- Fixed typo to the sort property ([#10](https://github.com/bertoost/Craft-Mailjet/pull/10/))
- Scaled down the symfony/mailjet-mailer requirement ([#9](https://github.com/bertoost/Craft-Mailjet/pull/9))

## v2.0.1 - 2022-07-30

### Changed

- Downgraded PHP version requirement to 8.0+
- Formatted code to match Craft's standards

## v2.0.0 - 2022-07-19

### Changed

- Updated Mail transport using Symfony's Mailer ([#8](https://github.com/bertoost/Craft-3-Mailjet/pull/8))
- Updated plugin codebase for Craft 4

## v1.2.3 - 2021-04-17

### Changed

- Improved utility view of sent status bullet (green)
- Updated Mailject icon
- Added PHP8 support

## v1.2.2 - 2020-05-27

### Changed

- Fixed SmsService init() to have a compatible return type definition ([#4](https://github.com/bertoost/Craft-3-Mailjet/issues/4))
- Fixed SmsService to support environment variables for settings ([#2](https://github.com/bertoost/Craft-3-Mailjet/pull/2))

## v1.2.1 - 2020-04-17

### Changed

- Fixed system utility interface
- Fixed rendering environment variables for the API Key & Secret for the CP elements

## v1.2.0 - 2019-09-11

### Changed

- Fixed composer dependency for Mailjet's Swiftmailer 6 support (no dev-dependency anymore)
- Including Mailjet Swiftmailer package version 2.0

## v1.1.2 - 2019-04-15

### Changed

- Fixed connecting to the Mailjet API by removing client options from mail adapter

## v1.1.1 - 2019-04-14

### Changed

- Added minimum-stability to composer.json since the Mailjet Swiftmailer transport requires a dev branch for newest 6+ version.

## v1.1.0 - 2019-02-27

### Added

- SMS features by Mailjet API
- System utility to view sent messages
- Caching for better performance in utility

### Changed

- Fixed checking if Mailjet transport is used in `MailjetAdapter::isUsed()`
- Separated docs into multiple markdown files

## v1.0.0 - 2019-02-23

### Added

- Initial release of the Craft CMS 3 plugin for Mailjet