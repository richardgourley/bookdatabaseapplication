<?php
//DATABASE SET UP
//1. Create a database called 'publications'
//2. Create a table called 'classics'
/*
SCHEMA - TABLE - classics:

Field 	Type 	Null 	Key 	Default 	Extra 	
author 	varchar(128) 	NO 		NULL	
title 	varchar(128) 	NO 		NULL	
year 	smallint(6) 	YES 		NULL	
isbn 	char(13) 	NO 	PRI 	NULL	
*/

//Add in your local host development details for your MySQL database!
define('DB_HOST', 'localhost');  //Server
define('DB_USER', ''); //Username
define('DB_PASS', ''); //Password
define('DB_NAME', 'publications'); //Database name

//CONSTANTS DEFINED FOR USE IN OUR APP
define('ROOT_PATH', "/bookdatabaseapplication/");
define('ROOT_URL', "http://localhost/bookdatabaseapplication");

