# Silex DemoApp

A silex demo application for demonstrating the [silex-userprovider](https://github.com/chrootLogin/silex-userprovider).

-> __[Website: demoapp.rootlogin.ch](https://demoapp.rootlogin.ch)__ <-

## Development

### Legacy

Every standard LAMP with composer installation with PHP >= 5.4 should do it.

1. Clone the repository: `git clone https://github.com/chrootLogin/silex-demoapp.git`
2. Do a `composer install`
3. Browse to _web/index.php_-File

### Via Vagrant

This application supports [vagrant](http://vagrantup.com) for creating the development  evironment.

#### Dependencies
* Vagrant >= 1.8.1
* Vagrant Host Manager Plugin (`vagrant plugin install vagrant-hostmanager`)
* Ansible >= 1.9.3

#### Usage

1. Clone the repository: `git clone https://github.com/chrootLogin/silex-demoapp.git`
2. Make sure that the dependencies for vagrant are installed.
3. Do a `vagrant up`
4. Then you can install the dependencies with `composer install`. 
5. Afterwards browse to [demoapp.dev](http://demoapp.dev).