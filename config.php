<?php
//DATABASE SET UP
//1. Create a database called 'publications'
//2. Create a table called 'books'
/*
SCHEMA - TABLE - books:

Field 	Type 	Null 	Key 	Default 	Extra 	
author 	varchar(128) 	NO 		NULL	
title 	varchar(128) 	NO 		NULL	
year 	smallint(6) 	YES 		NULL	
isbn 	char(13) 	NO 	PRI 	NULL	
*/

//Add in your local host development details for your MySQL database!
//Server name
define('DB_HOST', 'localhost');
//Username
define('DB_USER', '');
//Password
define('DB_PASS', '');
//The name of the database.
define('DB_NAME', 'publications');

//CONSTANTS DEFINED FOR USE IN OUR APP
//Here add in the folder name where you will place your application.
define('ROOT_PATH', "/bookdatabaseapplication/");
//Here add in the full root url for your application
define('ROOT_URL', "http://localhost/bookdatabaseapplication");