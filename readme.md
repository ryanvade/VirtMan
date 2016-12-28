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
$testStorage = $virtMan->createStorage("TestStorage", "qcow2", 20480);
```
## TODO
- [ ] Create Virtual Machines
- [ ] Create Storage Images
- [ ] Create Storage Pools
- [ ] Create Public/Private Networks
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
