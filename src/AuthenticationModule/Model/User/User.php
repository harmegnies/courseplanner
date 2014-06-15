<?php
namespace CoursePlanner\AuthenticationModule\Model\User;

use Octopix\Selene\Mvc\Model\Model;

session_start();

class User extends Model {

	private $name;
	private $password;

	public function __get( $key )
	{
		if ( isset( $_SESSION['user_auth'] ) ) {
			return $_SESSION[sprintf( 'user_%s', $key )];
		}
		return $this->$key;
	}

	public function __set( $key, $value )
	{
		$sessionKey = sprintf( 'user_%s', $key );
		// if ( isset( $_SESSION['user_auth'] ) ) {
			$_SESSION[$sessionKey] = $value;
		// }
		$this->$key = $value;
	}

	public function save()
	{
		if ( $this->isNew() && $this->hasUniqueName() ) {
			$sql = 'INSERT INTO `user` ( `id`, `name`, `firstname`, `lastname`, `email`, `password`, `user_role_id`, `registration_date` ) VALUES ( :id, :name, :firstname, :lastname, :email, :password, 1, NOW() );';

			$query = parent::prepare( $sql );

			$query->bindValue(':id', $this->id );
			$query->bindValue(':name', $this->name );
			$query->bindValue(':firstname', $this->firstname );
			$query->bindValue(':lastname', $this->lastname );
			$query->bindValue(':email', $this->email );
			$query->bindValue(':password', sha1( \App\App::salt() . $this->password ) );

			return (bool) $query->execute();
		}
		return false;
	}

	public function hasUniqueName()
	{
		if ( isset( $this->name ) ) {
			$query = self::prepare( 'SELECT * FROM `user` WHERE `name` = :name' );
			$query->bindValue(':name', $this->name );
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
			$user = $query->fetch();
			if ( !empty( $user ) ) {
				$this->hydrate( $user );
				return empty( $this->id );
			}
		}
		return true;
	}

	public function exist()
	{
		if ( isset( $this->name ) && isset( $this->password ) ) {
			$query = self::prepare( 'SELECT * FROM `user` WHERE `name` = :name AND `password` = :password' );
			$query->bindValue(':name', $this->name );
			$query->bindValue(':password', $this->password );
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
			$user = $query->fetch();
			if ( !empty( $user ) ) {
				$this->hydrate( $user );
				return !empty( $this->id );
			}
		}
		return false;
	}

	public function authenticate()
	{
		if ( $this->exist() ) {
			//if( $this->rememberMe ) {
				//setcookie('name', $this->name);
				//setcookie('password', $this->password);
			//}
			$_SESSION['user_auth'] = true;
			return true;
		}
		return false;
	}

	public function isAuthenticated()
	{
		return isset($_SESSION['user_auth']) && $_SESSION['user_auth'] === true;
	}

	public function fullname()
	{
		return sprintf( '%1$s, %2$s', $this->lastname, $this->firstname );;
	}

	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		//setcookie('name', '');
		//setcookie('password', '');
	}

}