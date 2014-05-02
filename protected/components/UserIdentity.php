<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
     private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        /* 	
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		
		$user = Usuario::model()->find("nick=?", array($this->username));
		
		//sha1(pass)
		//Yii::app()->user->id
		//para variable de stado
		//$this->setState("email",valor);
		//Yii::app()->user->getState("email")
		if($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($this->password !== $user->contra)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
		    
		    //save access
            $acceso = new Acceso();
            //$idAcceso
            $acceso->idusuario = $user->idusuario;
            $acceso->fecha_inicio = date('Y-m-d H:i:s');
            $acceso->fecha_finalizacion = date('Y-m-d H:i:s');
            $acceso->save();

		    $this->_id =  $user->idusuario;
			$this->setState("idUsuario",$user->idusuario);
			$this->setState("admin",$user->admin);
			$this->setState("acceso", $acceso->idacceso);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
}