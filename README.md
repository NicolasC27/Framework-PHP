# Framework-PHP
Framework being created.

Framework use PSR-7, codesniffer(standard coding), zend-fastroute (Router), Twig (Render), php-di (container) and faker (fake data generator)

# Usage

!WARNING! This framework use PHP 7.1

- composer update

# DEMO

To test this framework, you can migrate my tests.

- ./vendor/bin/phinx migrate
- ./vendor/bin/phinx seed:run

# PHPUNIT

- ./vendor/bin/phpunit tests/Framework/RouterTest.php
- ./vendor/bin/phpunit tests/Framework/Renderer/RendererTest.php

- ./vendor/bin/phpunit tests/Framework/Renderer/App.php => Doesn't work at this moment.

# Launch Website

- php -S localhost:[PORT] -t public

Tee file .htaccess doesn't exists for the moment.

# Next update

- Blog Management
- Flash messages
- Validation of data
