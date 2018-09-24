<?php
namespace Insta\Models;

class User extends Model
{
	public static function table(): string
	{
		return 'users';
	}
	
	public static function createTable(): string
	{
		return "
		CREATE TABLE `users` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`email` varchar(255) DEFAULT NULL,
			`password` varchar(255) DEFAULT NULL,
			`dob` date DEFAULT NULL,
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";
	}
}