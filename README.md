
Toolbar Greeting Plugin
=========================

Teaching myself to write o-o code in a simple WP plugin.

##Description
A WordPress plugin. Allows the user to change the default 'Howdy' greeting in the Toolbar. Go to Settings>General to configure with your chosen greeting!
##Important Notes
The basic structure is based on Plugin template courtesy Francis Yaconiello.
The main function is adapted from a snippet intended for WP 3.3 and above
http://wp-snippets.com/replace-howdy-in-wordpress-3-3-admin-bar/ 

##Usage
The default 'Howdy' greeting is retained if the Setting is empty.

##Accessing the Setting

In the WordPress Dashboard, the setting is added to the bottom of Settings>General.

##Todo
* cleanup on uninstall
* restrict the change to the current user???
##Changelog
###1.3
* the main function is back outside the constructor function

###1.2
* change user-facing instances of 'Admin Bar' to 'Toolbar'
* add settings link
* merge manual branch into master

###1.1
* clean up readmes
* namespace vars

###1.0 
* Add setting.
* Git init.
* Create auto (master )and manual branches.

###0.1
* set up. 07/2013
