<?php
namespace Insta\Models;

use Insta\Database as DB;

use Exception;
use PDOException;

/**
 * Inspired by Eloquent, a quick set-up for CRUD updates
 */
abstract class Model {

	private static $allowed_methods = ['find', 'create', 'update', 'destroy'];

	/**
	 * The table name of model must be defined via this method
	 */
	abstract public static function table(): string;

	/**
	 * The SQL to generate the table.
	 */
	abstract static function createTable(): string;

	/**
	 * Override static calls 
	 */
	public static function __callStatic($name, $parameters)
	{
		try {
			if(in_array($name, self::$allowed_methods))
				return call_user_func_array([static::class, $name], $parameters);
		} catch (PDOException $e) {
			if($e->getCode() === '42S02') {
				DB::get()->exec(static::createTable());
				return call_user_func_array([static::class, $name], $parameters);
			}
			throw $e;
		}
	}

	/**
	 * Create, Read, Update, Delete
	 */
	
	private final static function create(array $columns)
	{
		$column_names = self::buildInsertValues($columns);
		$column_keys = self::buildInsertValues($columns , ':');
		
		if(isset($columns['password'])) {
			$columns['password'] = password_hash($columns['password'], PASSWORD_BCRYPT);
		}

		return DB::get()
				->prepare('INSERT INTO ' . static::table() . "({$column_names})VALUES({$column_keys})")
				->execute($columns);
	}

	private final static function find($find, string $findBy = 'id')
	{
		$sql = DB::get()->prepare("SELECT * FROM " . static::table() . " WHERE {$findBy}=? LIMIT 1");
		$sql->execute([$find]);
		return $sql->fetch();
	}

	private final static function update(int $id, array $columns)
	{
		$set = self::buildUpdateSet($columns);
		$columns['id'] = $id;
		$sql = DB::get()->prepare("UPDATE " . static::table() . "SET {$set} WHERE id=:id");
		$sql->execute($columns);
		return $sql;
	}

	private final static function destroy(int $id)
	{
		return DB::get()
				->prepare("DELETE FROM " . static::table() . " WHERE id=?")
				->execute([$id]);
	}

	/**
	 * Builds the update SET, e.g.
	 * first_name = :first_name, email = :email
	 */
	private final static function buildUpdateSet(array $columns): string
	{
		$set_list = '';
		foreach($columns as $key => $col) {
			$set_list += "$key = :$key";
		}
		return $set_list;
	}

	private final static function buildInsertValues(array $columns, string $prefix = ''): string
	{
		return $prefix . implode(',' . $prefix, array_keys($columns));
	}
}