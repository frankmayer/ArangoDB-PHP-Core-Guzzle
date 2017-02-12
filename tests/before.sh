#! /bin/bash bash
#
# This script is run by Travis CI before the test script.
# It updates composer

echo -- Updating Composer
wget http://getcomposer.org/composer.phar

composer require satooshi/php-coveralls:dev-master --dev --no-progress --prefer-source --ignore-platform-reqs

# composer self-update

# those are not needed
#
# echo -- Installing the dependencies
# composer install --dev
