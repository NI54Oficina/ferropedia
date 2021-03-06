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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update',"torneos","editTorneo","crearLogro","deleteLogro"),
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
	
	public function actionCrearLogro(){
		
		if(isset($_POST["model"])&&isset($_POST["modelId"])){
			$logro= new Logro();
			$logro->model= $_POST["model"];
			$logro->modelId= $_POST["modelId"];
			$logro->tipo= $_POST["tipo"];
			$logro->fecha= $_POST["fecha"];
			$logro->save();
			$id=$logro->modelId;
			$this->redirect(array('staff/'.$id));
		}
	}
	
	public function actionDeleteLogro($id){
		$model= Logro::model()->findByPk($id);
		$modelId= $model->modelId;
		$model->delete();
		$this->redirect(array('staff/'.$modelId));
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
					"post_category"=>array(get_cat_ID( 'Director Técnico' )),
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
					"post_category"=>array(get_cat_ID( 'Director Técnico' ))
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
			$model->apellido= str_replace("'","&apos;",$model->apellido);
			if($model->save()){
				$model->apellido= str_replace("&apos;","'",$model->apellido);
				wp_insert_post(array(
					"post_title"=>$model->nombre." ".$model->apellido,
					"post_name"=>"director-tecnico-".$model->id,
					"post_category"=>array(get_cat_ID( 'Director Técnico' )),
					"meta_input"=>array(
						"_wp_page_template" => "template-ficha-tecnica3.php"
						)
				));
				
				if(isset($_POST['Partido'])){
					
					
					$ultimo= new DataExtra();
					$ultimo->titulo= "Último partido";
					$ultimo->model="Staff";
					$ultimo->modelId=$model->id;
					if($_POST["Partido"]["ultimo"]!=""){
						$ultimo->texto=$_POST["Partido"]["ultimo"];
					}else{
						$ultimo->texto="s/d";
					}
					$ultimo->save();
					
					$debut= new DataExtra();
					$debut->titulo= "Primer partido";
					$debut->model="Staff";
					$debut->modelId=$model->id;
					if($_POST["Partido"]["debut"]!=""){
						$debut->texto=$_POST["Partido"]["debut"];
					}else{
						$debut->texto="s/d";
					}
					$debut->save();
						
				}

				
				$this->redirect(array('view','id'=>$model->id));
				
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionTorneos($id){
		
		
		$torneos= DataExtra::model()->findAllByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Torneo"));
		$staff= Staff::model()->findByPk($id);
		$this->render('torneos',array(
			'torneos'=>$torneos, "staff"=>$staff,"id"=>$id
		));
	}
	
	public function actionEditTorneo($id=0)
	{
		if($id!=0){
			
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
		}else{
			$model= new DataExtra();
			if(isset($_POST["modelId"])){
				$model->modelId=$_POST["modelId"];
				$model->model="Staff";
			}
			if(isset($_POST['DataExtra']))
			{
				$texto="";
				foreach($_POST["DataExtra"] as $d){
					$texto.=$d."/";
				}
				$model->texto=$texto;
				$model->model="Staff";
				$model->titulo="Torneo";
				
				
				
				if($model->save(false)){
					$this->redirect(array('staff/torneos/','id'=>$model->modelId));
					exit();
				}
			}
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
		$model->apellido= str_replace("&apos;","'",$model->apellido);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$partido['debut']= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Primer partido"));
		if(!isset($partido["debut"])){
			$debut= new DataExtra();
			$debut->titulo= "Primer partido";
			$debut->model="Staff";
			$debut->modelId=$model->id;
			$debut->texto="s/d";
			$debut->save();
			$partido['debut']= "s/d";
		}else{
			$partido['debut']= $partido['debut']->texto;
		}
		
		$partido['ultimo']= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Último partido"));
		if(!isset($partido["ultimo"])){
			$debut= new DataExtra();
			$debut->titulo= "Último partido";
			$debut->model="Staff";
			$debut->modelId=$model->id;
			$debut->texto="s/d";
			$debut->save();
			$partido['ultimo']= "s/d";
		}else{
			$partido['ultimo']= $partido['ultimo']->texto;
		}
		
		if(isset($_POST['Partido'])){
			
			if($_POST["Partido"]["ultimo"]!=""){
				
				$ultimo= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Último partido"));
				$ultimo->texto=$_POST["Partido"]["ultimo"];
				$ultimo->save();
				$partido["ultimo"]=$ultimo->texto;
			}
			if($_POST["Partido"]["debut"]!=""){
				$debut= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$id,"titulo"=>"Primer partido"));
				$debut->texto=$_POST["Partido"]["debut"];
				$debut->save();
				$partido["debut"]=$debut->texto;
			}
		}
		
		
		if(isset($_POST['Staff']))
		{
			
			$model->attributes=$_POST['Staff'];
			//echo $model->apellido;
			//echo "<br>";
			$model->apellido= str_replace("\'","&apos;",$model->apellido);
			//echo $model->apellido;
			//exit();
			if($model->save()){
				$model->apellido= str_replace("&apos;","'",$model->apellido);
				$the_slug = 'director-tecnico-'.$model->id;
				
				$queried_post = get_page_by_path($the_slug,OBJECT,'post');
				
				if( $queried_post === NULL) {
					wp_insert_post(array(
						"post_title"=>$model->nombre." ".$model->apellido,
						"post_name"=>"director-tecnico-".$model->id,
						"post_status" => "publish",
						"post_category"=>array(get_cat_ID( 'Director Técnico' )),
						"meta_input"=>array(
							"_wp_page_template" => "template-ficha-tecnica3.php"
							)
					));

				}else{
					
					 $my_post = array(
						  'ID'           => $queried_post->ID,
						  "post_title"=>$model->nombre." ".$model->apellido,
							"post_name"=>"director-tecnico-".$model->id,
							"post_status" => "publish",
							"post_category"=>array(get_cat_ID( 'Director Técnico' ))
					  );
					  wp_update_post( $my_post );
					  update_post_meta( $queried_post->ID, '_wp_page_template', 'template-ficha-tecnica3.php' );
				}
				
				

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,"partido"=>$partido
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
		/*$model=new Staff('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Staff']))
			$model->attributes=$_GET['Staff'];
		*/
		$model= Staff::model()->findAll();
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
	
	public function actionCiudad(){
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
			
			if($jugador->ciudad_natal!=""){
				$jugador->nacimiento.= " | ".$jugador->ciudad_natal;
				echo $jugador->nacimiento;
				echo "<br>";
				$jugador->ciudad_natal="";
				$jugador->save();
			}
		}
	}
	
	public function actionTotales(){
		$staffs= Staff::model()->findAll();
		foreach($staffs as $staff){
			$staff->data;
			$auxT=0;
			foreach($staff->data as $data){
				
				if(strpos(strtolower($data->texto),"total")!==false){
					$auxT++;
				}
			}
			if($auxT>1){
				echo $staff->id;
				echo "<br>";
			}
		}
	}
}
