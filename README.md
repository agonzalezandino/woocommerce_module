![Packlink logo](https://pro.packlink.es/public-assets/common/images/icons/packlink.svg)

# Packlink WooCommerce plugin

## Getting started

### Installation
To work with this integration, the module can be installed in a few minutes by going through these following steps:

- Step 1: Download the module
- Step 2: Go to WooCommerce back office
- Step 3: Navigate to Plugins >> Add New
- Step 4: Click on "Upload Plugin" button 
- Step 5: Select downloaded file and click on "Install Now".
- Step 6: Click on "Activate Plugin" button.

After installation is over, plugin configuration can be set by navigating to WooCommerce >> Packlink PRO.

## Version
2.0.3

## Compatibility
- WordPress v4.7+
- WooCommerce v3.0+

## Prerequisites
- PHP 5.3 or newer
- MySQL 5.0 or newer

## Development Guidelines
### Coding standards
Use WordPress extension for PhpStorm IDE. It will help significantly during the development.
To check the code against the coding standards, execute these commands in the root of the project
```bash
composer install
vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs/
vendor/bin/phpcs src/ --standard=WordPress --colors --severity=10
``` 

Correct **all** errors reported but the code sniffer.

### Generating translation files

Use WordPress CLI for generating translation .pot files.

### Running the tests
Tests are run on WordPress testing SDK. More on this can be found [here](https://make.wordpress.org/cli/handbook/plugin-unit-tests/).

First install the needed wordpress database for tests (this has to be run just once):
```bash
cd bin
bash bin/install-wp-tests.sh wordpress_test dbuser dbpass localhost latest
``` 
Then, either setup PHPStorm to run tests based on the `/src/phpunit.xml` configuration file
or go to the root directory and run
```bash
./run-tests.sh
```
This command will run unit tests on all different PHP versions from 5.6 to 7.3.

### Releasing a new module version

Please follow instructions provided [here](https://logeecom.atlassian.net/wiki/spaces/PACKLINK/pages/1367179297/WC+-+Plugin+Release+Procedure).