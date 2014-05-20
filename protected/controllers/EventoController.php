<?php

class EventoController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionNuevo()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('nuevo');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionGetNameProductByCodigo($params){

		$producto = new Producto;
		$producto = $producto->find('codigo_detalle_producto =:valor', array(':valor' => $params));

		$arrTotal = array();
		$a = array('id','nombre');
		$b = array();
		$c = array();

		if($producto != null){
			array_push($b,$producto->idproducto);
			array_push($b,$producto->nombre_producto);
			$c = array_combine($a, $b);

			//array_push($arrTotal, $c);
		}
		

		echo json_encode($c);
	}

	public function actionSave(){

        $respuesta;

        //save evento
		$event = new Evento;

		$event->nombre = $_POST["nombre"];
		$event->nombre_cliente = $_POST["nombre_cliente"];
		$event->numero_telefono = $_POST["numero_telefono"];
	    $event->direccion = $_POST["direccion"];
	    $event->fecha_facturacion = $_POST["fecha_facturacion"];
	    $event->numero_factura = $_POST["numero_factura"];
	    $event->nombre_vendedor = $_POST["nombre_vendedor"];
	    $event->tipo_evento = $_POST["tipo_evento"];
	    $event->observacion = $_POST["observacion"];
	    $event->imagen_firma = "";

	    if($event->save()){
	    	$respuesta = "ok";

	    	//save detalle_producto

		    $rows = count($_POST["materiales"]);

		    for ($i = 0; $i < $rows; $i++) {
			    $codigo = $_POST["materiales"][$i][0];

			    $producto = new Producto;
			    $producto = $producto->find("codigo_detalle_producto =:valor",array(":valor"=>$codigo));

	    	    $detalle_producto = new DetalleProducto;

			    $detalle_producto->idevento = $event->idevento;			    
			    $detalle_producto->idproducto = $producto->idproducto;
			    $detalle_producto->unidades_recibidas = $_POST["materiales"][$i][2];
			    $detalle_producto->unidades_utilizadas = $_POST["materiales"][$i][2];
			    $detalle_producto->bodega = $_POST["materiales"][$i][3];

			    if($detalle_producto->save())
			    	continue;
			}
	    }

		//$arraTotal = array();
		//array_push($arraTotal, $event->direccion);

		//echo json_encode($_POST["materiales"][0][0]);
		echo json_encode($respuesta);
	}
}

