<?php

class StaffController extends Controller
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
				'actions'=>array('index','view',"listar"),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update',"torneos","editTorneo"),
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
	
	public function actionListar(){
		/*$puestos= array();
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"arquero")));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"defensor")));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"mediocampista")));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"delantero")));
		$this->layout='jugador';
		$this->render('listar',array("model"=>$puestos
			
		));*/
		set_time_limit (100000);
		$jugadores= Staff::model()->findAll();
		foreach($jugadores as $jugador){
			
			$the_slug = 'director-tecnico-'.$jugador->id;
			$queried_post = get_page_by_path($the_slug,OBJECT,'post');
			
			if( $queried_post === NULL) {
				wp_insert_post(array(
					"post_title"=>$jugador->nombre." ".$jugador->apellido,
					"post_name"=>"director-tecnico-".$jugador->id,
					"post_status" => "publish",
					"post_category"=>array(get_cat_ID( 'director-tecnico' )),
					"meta_input"=>array(
						"_wp_page_template" => "template-ficha-tecnica3.php"
						)
				));

			}else{
				echo "entra?";
				 $my_post = array(
				  'ID'           => $queried_post->ID,
				  "post_title"=>$jugador->nombre." ".$jugador->apellido,
					"post_name"=>"director-tecnico-".$jugador->id,
					"post_status" => "publish",
					"post_category"=>array(get_cat_ID( 'director-tecnico' ))
			  );
			  wp_update_post( $my_post );
			  update_post_meta( $queried_post->ID, '_wp_page_template', 'template-ficha-tecnica3.php' );
			}
			echo "<br>";
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Staff;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Staff']))
		{
			$model->attributes=$_POST['Staff'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionTorneos($id){
		
		
		$torneos= DataExtra::model()->findAllByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Torneo"));
		$staff= Staff::model()->findByPk($id);
		$this->render('torneos',array(
			'torneos'=>$torneos, "staff"=>$staff
		));
	}
	
	public function actionEditTorneo($id)
	{
		$model= DataExtra::model()->findByPk($id);

		$guardado="no";
		if(isset($_POST['DataExtra']))
		{
			$texto="";
			foreach($_POST["DataExtra"] as $d){
				$texto.=$d."/";
			}
			$model->texto=$texto;
			if($model->save()){
				$guardado="si";
				
			}
			$this->redirect(array('staff/torneos/','id'=>$model->modelId));
			exit();
			
		}

		$this->render('editTorneo',array(
			'model'=>$model,"guardado"=>$guardado
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

		if(isset($_POST['Staff']))
		{
			$model->attributes=$_POST['Staff'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Staff');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Staff('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Staff']))
			$model->attributes=$_GET['Staff'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Staff the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Staff::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Staff $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='staff-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
