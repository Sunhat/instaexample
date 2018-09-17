<?php
namespace Insta;

use PDO;
/**
 * A quick Database object to use
 * After writing this, I saw there's a way to put bring this closer
 * to Slims container. 
 * ----
 * I considered Eloquent, but that felt like I was just importing Laravel into Slim.
 * I should at least write some SQL :P 
 */
/**
 * if I had more time I would've added env() too
 */
class Database {

	private static $PDO;

	private static $host = '127.0.0.1';
	private static $db = 'instaexample';
	private static $user = 'root';
	private static $pass = '';
	private static $options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	public static function get()
	{
		if(self::$PDO) {
			return self::$PDO;
		}
		return self::$PDO = new PDO(
			"mysql:host=". self::$host .";dbname=". self::$db .";", 
			self::$user, self::$pass, self::$options
		);
	}
}