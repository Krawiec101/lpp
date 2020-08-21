## Requirements

+ PHP ^7.3
+ PHP json extension
+ Composer

### Additional requirements for DEV

+ PHP ast extension

## Instalation

```bash
git clone git@github.com:Krawiec101/lpp.git
composer install
```

To run application we shoud type:

```bash
php index.php
```

### PHPUnit

```bash
./bin/phpunit -c ./test/phpunit.xml
```

### PHP Coding Standards

```bash
./bin/phpcs --colors --standard=PSR1,PSR2 ./src/Lpp/