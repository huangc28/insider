# profiteer

## Folder structure

```
app
 |
 |-- Console
 |-- Domain
 |      |-- User.php
 |      |-- UserRepository.php // implementation of user repository interface
 |      |-- UserRepositoryInterface.php // interface
 |      |-- Commands
 |      |       |-- FooCommand.php
 |      |       |-- BarCommand.php
 |      |
 |      |-- Handlers
 |      |       |-- FooCommandHandler.php
 |      |       |-- BarCommandHandler.php
 |      |
 |      |-- Services
 |             |-- FooServices.php
 |
 |-- HTTP
 |     |-- Controllers
 |              |-- FooController.php
 |-- Providers
 |     |-- DomainServiceProvider.php
```


## Testing

All test suites run sql with **sqlite** that uses memory for performance concerns. It does not touch real DB environment when in **testing** environment.

## Coding Style

This project follows the coding style of `PSR2` in which laravel itself is following. Following instructions indicate how to install code sniffer following `PSR2` in **VScode**.

### VScode PSR-2 style sniffer

1. Install [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs).
2. Install [pear](https://coolestguidesontheplanet.com/installing-pear-on-osx-10-11-el-capitan/).
3. Install PHP_CodeSniffer `pear install PHP_CodeSniffer`
4. Set the default coding style check to `PSR-2` by prompting `phpcs --config-set default_standard PSR2`

You now will be notified in any error violating `PSR-2`

Happy Coding!

