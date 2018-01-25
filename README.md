
FOSUserBundle
=============

The FOSUserBundle adds support for a database-backed user system in Symfony2.
It provides a flexible framework for user management that aims to handle
common tasks such as user registration and password retrieval.

Features include:

- Users can be stored via Doctrine ORM or MongoDB/CouchDB ODM
- Registration support, with an optional confirmation per email
- Password reset support
- Unit tested

**Note:** This bundle does *not* provide an authentication system but can
provide the user provider for the core [SecurityBundle](https://symfony.com/doc/current/book/security.html).

[![Build Status](https://travis-ci.org/FriendsOfSymfony/FOSUserBundle.svg?branch=master)](https://travis-ci.org/FriendsOfSymfony/FOSUserBundle) [![Total Downloads](https://poser.pugx.org/friendsofsymfony/user-bundle/downloads.svg)](https://packagist.org/packages/friendsofsymfony/user-bundle) [![Latest Stable Version](https://poser.pugx.org/friendsofsymfony/user-bundle/v/stable.svg)](https://packagist.org/packages/friendsofsymfony/user-bundle)

Documentation
-------------

The source of the documentation is stored in the `Resources/doc/` folder
in this bundle, and available on symfony.com:

[Read the Documentation for master](https://symfony.com/doc/master/bundles/FOSUserBundle/index.html)

[Read the Documentation for 1.3.x](https://symfony.com/doc/1.3.x/bundles/FOSUserBundle/index.html)

Installation
------------

All the installation instructions are located in the documentation.

License
-------

This bundle is under the MIT license. See the complete license [in the bundle](LICENSE)

About
-----

UserBundle is a [knplabs](https://github.com/knplabs) initiative.
See also the list of [contributors](https://github.com/FriendsOfSymfony/FOSUserBundle/contributors).

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/FriendsOfSymfony/FOSUserBundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.

INSTALACION :
-------------------------------------------------------------------------
Clonar repositorio desde git
	git clone https://github.com/Jositoyoyo/symfony4.x.git

Instalar dependencias del proyecto
	cd symfony4.x
	composer install

Configurar en el archivo .env la linea que pone
	 DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
	 debes poner tu configuracion de la base de datos, por ejemplo :
	 DATABASE_URL=mysql://pepeAdmin:12334@127.0.0.1:3306/example

Crear base de datos partiendo de los datos contenida en las entidades
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create 

Para comprobar que la base de datos esta correctamente mapeada
	php bin/console doctrine:schema:validate

Correr el proyecto
	php bin/console server:run
---------------------------------------------------------------------------
FRONTEND DEL PROYECTO
Clonar repositorio desde git
	git clone https://github.com/Jositoyoyo/template

Instalar dependencias
	cd template
	npm install
---------------------------------------------------------------------------
Editores recomendados :
	PhpStrorm (de Pago)
	Netbeans (gratis)
Lo demas es cosa tuya ;)







------------------------------------------
 php bin/console doctrine:mapping:convert annotation --from-database App/Entity



Faltan :
Translate all proyect
Crear el FronEnd
Crear Dockeck y Jenkins
