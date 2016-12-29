# VirtMan
A Libvirt PHP wrapper library for the [Laravel Framework](https://laravel.com/).
_version **0.0.1**_
## Requirements
* PHP >= 7.0
* Libvirt PHP extension

## Installation
First grab the package via composer.
```bash
composer require ryanvade/virtman
```
Then add the service provider to the list of providers in config/app.php.
```php
...
        /*
         * Package Service Providers...
         */

        VirtMan\VirtManServiceProvider::class,
...
```
Finally publish the package to your laravel project and run the migrations.
```bash
php artisan vendor:publish
php artisan migrate
```

## Examples
### Create a Storage Object
```php
use VirtMan\VirtMan;

$virtMan = new VirtMan();
$testInstallImage = $virtMan->createStorage("installimage.iso", "ISO", -1);
$testStorage = $virtMan->createStorage("TestStorage", "qcow2", 20480);
```
### Create a Network Object
```php

$network = $virtMan->createNetwork("00:11:22:33:44:55", "machine_network", "e1000");
```
### Create a Virtual Machine
```php
$machine = $virtMan("TestMachine", "Linux", 2048, 1, "x86_64", [
  $testInstallImage,
  $testStorage
], $network);
```
## TODO
- [ ] Create Virtual Machines
- [x] Create Storage Images
- [ ] Create Storage Pools
- [x] Create Networks
- [ ] Create Machine Groups
- [ ] Delete Virtual Machines
- [ ] Delete Storage Images
- [ ] Delete Storage Pools
- [ ] Delete Networks
- [ ] Delete Machine Groups
- [ ] List Machines
- [ ] Change Machine Settings
- [ ] Change Machine Networks
- [ ] Add a Machine to a Network
- [ ] Clone a Machine
- [ ] Add Storage to a Storage Pool
- [ ] Manage Install Images
