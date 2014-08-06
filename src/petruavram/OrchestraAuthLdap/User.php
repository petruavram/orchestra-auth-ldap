<?php namespace petruavram\OrchestraAuthLdap;

use Config;
use Illuminate\Auth;

/**
 * Description of LdapUser
 *
 * @author ccovey
 */
class LdapUser implements Auth\UserInterface
{
	protected $attributes;

	public function __construct($attributes)
	{
		error_log('________$attributes________ : ' . print_r( $attributes, TRUE), 3, 'D:/dev/work/htdocs/gmab-project-tracking/app/storage/logs/laravel.log' );
		$this->attributes = $attributes;
	}
    /**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
    public function getAuthIdentifier()
	{
		$username = (Config::has('auth.username_field')) ? Config::get('auth.username_field') : 'username';
		return $this->attributes[$username];
	}
    
    /**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->attributes['password'];
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken(){}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value){}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName(){}

	/**
	 * Dynamically access the user's attributes.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->attributes[$key];
	}

	/**
	 * Dynamically set an attribute on the user.
	 *
	 * @param  string  $key
	 * @param  mied    $value
	 * @return void
	 */
	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	/**
	 * Dynamically check if a value is set on the user.
	 *
	 * @return bool
	 */
	public function __isset($key)
	{
		return isset($this->attributes[$key]);
	}

	/**
	 * Dynamically unset a value on the user.
	 *
	 * @return bool
	 */
	public function __unset($key)
	{
		unset($this->attributes[$key]);
	}
}