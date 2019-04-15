# Craft CMS 3 - Mailjet mailer adapter

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