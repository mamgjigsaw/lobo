<?php

class AgentesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','saveAgente','getSupervisores','getDireccionImagen'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Acceso;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Acceso']))
		{
			$model->attributes=$_POST['Acceso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idAcceso));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Acceso']))
		{
			$model->attributes=$_POST['Acceso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idAcceso));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Acceso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Acceso']))
			$model->attributes=$_GET['Acceso'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Acceso the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Acceso::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Acceso $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='acceso-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

   public function actionSaveAgente(){
   	    $respuesta = "";
   		$nombre = $_POST["nombre"];
   		$codigo = $_POST["codigo"];
   		$option = $_POST["option"];
   		$tipo = $_POST["tipo"];

   		if($tipo == 2){
   			if($option == 1){
   				//save
   				$agentes = new Agente;
		   		$agentes->nombre = $nombre;
		   		$agentes->codigo_qr = $codigo;
		   		$agentes->fecha_ingreo = date('Y-m-d H:i:s');
		   		$agentes->tipo = 2;
		   		$agentes->estado = 1;

		   		$agentes->save();

	   			Yii::import('ext.qrcode.QRCode');
				$code=new QRCode($codigo);					 
				$code->create('/Applications/MAMP/htdocs/lobo/protected/img/'.$agentes->idagente.'.png');

		   		$respuesta = $agentes->idagente;
		   		echo json_encode($respuesta);
   			}else{
   				//update
   				$id = $_POST["id"];
   				$agentes = new Agente;
   				$agentes = $agentes->find("idagente =:valor", array(":valor"=>$id));

   				$agentes->nombre = $nombre;
   				$agentes->codigo_qr = $codigo;
		        $agentes->update(array('nombre','codigo_qr'));

		        Yii::import('ext.qrcode.QRCode');
				$code=new QRCode($codigo);					 
				$code->create('/Applications/MAMP/htdocs/lobo/protected/img/'.$agentes->idagente.'.png');

		   		//$respuesta = $agentes->idagente;
   				
   			}
   			
   		}
   }

   public function actionGetSupervisores(){
   		$agentes = new Agente;
   		$criteria = new CDbCriteria();
   		$criteria->addCondition('estado = 1');
		$agentes = $agentes->findAll($criteria);   		

		$table = array();
		
		foreach ($agentes as $value) {
			$row = array();

			array_push($row, $value->idagente);
			array_push($row, $value->nombre);
			array_push($row, $value->codigo_qr);

			array_push($table, $row);
		}

		echo json_encode($table);
   }

   public function actionGetDireccionImagen(){

   	$path = Yii::app()->basePath.'/img/'. $_POST['id'] .'.png';
	$imgurl= Yii::app()->assetManager->publish($path);

	echo json_encode($imgurl);

   }

}
