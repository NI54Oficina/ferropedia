<?php

class JugadorController extends Controller
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
				'actions'=>array('index','view',"listar","puestos"),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update',"checkDatos","torneos","editTorneo","crearLogro","deleteLogro"),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete',"setAvatar"),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCheckDatos(){
		set_time_limit(300000);
		$jugadores= Jugador::model()->findAll();
		foreach($jugadores as $jugador){
			$jugador->data;
			
		$lastTorneo="";
		$debut="";
		$ultimo="";
		$torneos=array();
		$otros= array();
		foreach($jugador->data as $data){ 
			if($data["titulo"]=="Debut"){
				$debut =$data["texto"];
			}else if($data["titulo"]=="Torneo"){
				$auxT= explode("/",$data["texto"]);
				if(count($auxT)>2){
					if(isset($torneos[$auxT[0]])){
						array_push($torneos[$auxT[0]],$auxT);
					}else{
						$torneos[$auxT[0]]= array($auxT);
					}
				}
				$lastTorneo= $data["texto"];
			}else if($data["titulo"]=="Último partido"){
				$ultimo= $data["texto"];
			}else{
				array_push($otros,$data);
			}
		 }
		 $lastTorneo= explode("/",$lastTorneo);
		 if(count($lastTorneo)>3){
			echo "id ".$jugador->id." = ".count($lastTorneo);
			echo "<br>";
		 }
		}
		
	}
	
	public function actionCrearLogro(){
		//var_dump($_POST);
		//exit();
		if(isset($_POST["model"])&&isset($_POST["modelId"])){
			$logro= new Logro();
			$logro->model= $_POST["model"];
			$logro->modelId= $_POST["modelId"];
			$logro->tipo= $_POST["tipo"];
			$logro->fecha= $_POST["fecha"];
			$logro->save();
			$id=$logro->modelId;
			$this->redirect(array('jugador/'.$id));
		}
	}
	
	public function actionDeleteLogro($id){
		$model= Logro::model()->findByPk($id);
		$modelId= $model->modelId;
		$model->delete();
		$this->redirect(array('jugador/'.$modelId));
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
	
	public function actionVer($id){
		$this->layout='jugador';
		$this->render('ver',array(
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
		$jugadores= Jugador::model()->findAll();
		foreach($jugadores as $jugador){
			
			$the_slug = 'jugador-'.$jugador->id;
			$queried_post = get_page_by_path($the_slug,OBJECT,'post');
			
			if( $queried_post === NULL) {
				wp_insert_post(array(
					"post_title"=>$jugador->nombre." ".$jugador->apellido,
					"post_name"=>"jugador-".$jugador->id,
					"post_status" => "publish",
					"post_category"=>array(get_cat_ID( 'jugador' )),
					"meta_input"=>array(
						"_wp_page_template" => "template-ficha-tecnica.php"
						)
				));

			}else{
				echo "entra?";
				 $my_post = array(
				  'ID'           => $queried_post->ID,
				  "post_title"=>$jugador->nombre." ".$jugador->apellido,
					"post_name"=>"jugador-".$jugador->id,
					"post_status" => "publish",
					"post_category"=>array(get_cat_ID( 'jugador' ))
			  );
			  wp_update_post( $my_post );
			  update_post_meta( $queried_post->ID, '_wp_page_template', 'template-ficha-tecnica.php' );
			}
			echo "<br>";
		}
	}
	
	public function actionPuestos(){
		set_time_limit (100000);
		$jugadores= Jugador::model()->findAll();
		foreach($jugadores as $jugador){
			if($jugador->puesto==""||!isset($jugador->puesto)){
			$jugador->puesto= $this->GetPuesto($jugador->detalle_puesto);
			$jugador->save();
			}
			
		}

	}
	
	public function actionTorneos($id){
				
		$torneos= DataExtra::model()->findAllByAttributes(array("model"=>"Jugador","modelId"=>$id,"titulo"=>"Torneo"));
		$jugador= Jugador::model()->findByPk($id);
		$this->render('torneos',array(
			'torneos'=>$torneos,"jugador"=>$jugador,"id"=>$id
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
				//agregar textito que confirme el guardado
			}
			$this->redirect(array('jugador/torneos/','id'=>$model->modelId));
			exit();
				//$this->redirect(array('view','id'=>$model->id));
		}
		}else{
			$model= new DataExtra();
			if(isset($_POST["modelId"])){
				$model->modelId=$_POST["modelId"];
				$model->model="Jugador";
			}
			if(isset($_POST['DataExtra']))
			{
				$texto="";
				foreach($_POST["DataExtra"] as $d){
					$texto.=$d."/";
				}
				$model->texto=$texto;
				$model->model="Jugador";
				$model->titulo="Torneo";
				
				
				
				if($model->save(false)){
					$this->redirect(array('jugador/torneos/','id'=>$model->modelId));
					exit();
				}
			}
		}

		$this->render('editTorneo',array(
			'model'=>$model,"guardado"=>$guardado
		));
	}
	
	public function GetPuesto($detalle){
			switch($detalle){
				case "Centrodelantero": case "Delantero": case "Insider derecho": case "Insider derecho o izquierdo": case "Insider iquierdo": case "Insider izquierdo": case "Puntero derecho": case "Puntero derecho e izquierdo": case "Puntero izquierdo": case "Puntero derecho o izquierdo": case "Puntero derehco": case "Puntero": case "Puntero iIzquierdo": case "Puntero derecho y back izquierdo": case "Puntero Derecho": case "Puntero Izquierdo": case "Volante ofensivo / Delantero": case "Extremo izquierdo": case "Wing derecho o izquierdo": 
				return "delantero"; break;
				case "Half izquierdo": case "Back  derecho": case "Back derecho": case "Back central": case "Back izquierdo": case "Centre half":  case "Defensor": case "Half derecho": case "Half derecho o izquierdo": case "Back  derecho o izquierdo": case "Back derecho y centromedio":case  "Marcador central": case "Marcador de punta": case "Defensa": case "Marcador lateral": case "Defensor central": case "Defensor Lateral": case "Marcador lateral izquierdo": case "Lateral derecho": case "Half Derecho": case "Lateral izquierdo": case "Half Izquierdo": case "Marcador lateral derecho": case "back derecho": case "Back  derecho o izquierdo": case "Marcador central": case "Marcador Central": case "Back derecho o izquierdo": case "Lateral por izquierda": case "Half": case "Lateral Izquierdo": case "Back  derecho o izquierdo": case "Half y puntero derecho": case "Back": case "Marcador de Punta": case "Back y half derecho": case "Half derecho e izquierdo":  case "Half izquierdo": case "Zaguero izquerdo": case "Zaguero central":
				return "defensor"; break;
				case "Arquero":
				return "arquero";break;
				case "Centromedio": case "Entreala derecho": case "Enterala izquierdo": case "Entreala": case "Entreala izquierdo": case "Polifuncional": case "Volante": case "Volante central": case "Volante ofensivo": case "Entreala Izquierdo": case "Volante izquierdo": case "Volante derecho": case "Enganche": case "Centrodelatnero": case "Volante por izquierda": case "Volante Derecho": case "Defensor/Volante": case "Volante central o derecho": case "Mediocampista y marcador central": case "Volante Central": case "Volante Ofensivo": case "Marcador central o volante central": case "Lateral volante": case "Entreala derecha": case "Mediocampista": case "Interior izquierdo": 
				return "mediocampista"; break;
				
				
				
			}
			
		}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Jugador;
		
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Jugador']))
		{
			$model->attributes=$_POST['Jugador'];
			$model->apellido= str_replace("'","&apos;",$model->apellido);
			if($model->save()){
				$model->apellido= str_replace("&apos;","'",$model->apellido);
				wp_insert_post(array(
					"post_title"=>$model->nombre." ".$model->apellido,
					"post_name"=>"jugador-".$model->id,
					"post_category"=>array(get_cat_ID( 'jugador' )),
					"meta_input"=>array(
						"_wp_page_template" => "template-ficha-tecnica.php"
						)
				));
				
				if(isset($_POST['Partido'])){
					
					
					$ultimo= new DataExtra();
					$ultimo->titulo= "Último partido";
					$ultimo->model="Jugador";
					$ultimo->modelId=$model->id;
					if($_POST["Partido"]["ultimo"]!=""){
						$ultimo->texto=$_POST["Partido"]["ultimo"];
					}else{
						$ultimo->texto="s/d";
					}
					$ultimo->save();
					
					$debut= new DataExtra();
					$debut->titulo= "Debut";
					$debut->model="Jugador";
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
		$partido['debut']= DataExtra::model()->findByAttributes(array("model"=>"Jugador","modelId"=>$id,"titulo"=>"Debut"));
		if(!isset($partido["debut"])){
			$debut= new DataExtra();
			$debut->titulo= "Debut";
			$debut->model="Jugador";
			$debut->modelId=$model->id;
			$debut->texto="s/d";
			$debut->save();
			$partido['debut']= "s/d";
		}else{
			$partido['debut']= $partido['debut']->texto;
		}
		
		$partido['ultimo']= DataExtra::model()->findByAttributes(array("model"=>"Jugador","modelId"=>$id,"titulo"=>"Último partido"));
		if(!isset($partido["ultimo"])){
			$debut= new DataExtra();
			$debut->titulo= "Último partido";
			$debut->model="Jugador";
			$debut->modelId=$model->id;
			$debut->texto="s/d";
			$debut->save();
			$partido['ultimo']= "s/d";
		}else{
			$partido['ultimo']= $partido['ultimo']->texto;
		}
		
		
		if(isset($_POST['Partido'])){
			
			if($_POST["Partido"]["ultimo"]!=""){
				
				$ultimo= DataExtra::model()->findByAttributes(array("model"=>"Jugador","modelId"=>$id,"titulo"=>"Último partido"));
				$ultimo->texto=$_POST["Partido"]["ultimo"];
				$ultimo->save();
				$partido["ultimo"]=$ultimo->texto;
			}
			if($_POST["Partido"]["debut"]!=""){
				$debut= DataExtra::model()->findByAttributes(array("model"=>"Jugador","modelId"=>$id,"titulo"=>"Debut"));
				$debut->texto=$_POST["Partido"]["debut"];
				$debut->save();
				$partido["debut"]=$debut->texto;
			}
		}

		if(isset($_POST['Jugador']))
		{
			$model->attributes=$_POST['Jugador'];
			$model->apellido= str_replace("\'","&apos;",$model->apellido);
			if($model->save()){
				$model->apellido= str_replace("&apos;","'",$model->apellido);
				$the_slug = 'jugador-'.$model->id;
				$queried_post = get_page_by_path($the_slug,OBJECT,'post');
				
				if( $queried_post === NULL) {
					wp_insert_post(array(
						"post_title"=>$model->nombre." ".$model->apellido,
						"post_name"=>"jugador-".$model->id,
						"post_status" => "publish",
						"post_category"=>array(get_cat_ID( 'jugador' )),
						"meta_input"=>array(
							"_wp_page_template" => "template-ficha-tecnica.php"
							)
					));

				}else{
					
					 $my_post = array(
						  'ID'           => $queried_post->ID,
						  "post_title"=>$model->nombre." ".$model->apellido,
							"post_name"=>"jugador-".$model->id,
							"post_status" => "publish",
							"post_category"=>array(get_cat_ID( 'jugador' ))
					  );
					  wp_update_post( $my_post );
					  update_post_meta( $queried_post->ID, '_wp_page_template', 'template-ficha-tecnica.php' );
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
		$dataProvider=new CActiveDataProvider('Jugador');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		/*$model=new Jugador('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Jugador']))
			$model->attributes=$_GET['Jugador'];*/
		$model= Jugador::model()->findAll();

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Jugador the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		//$model=Jugador::model()->with(array("data","imagenes","avatar"))->findByPk($id);
		$model=Jugador::model()->findByPk($id);
		//$model=Jugador::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionSetAvatar($id,$imagen){
		$auxRel= RelImagenJugador::model()->find("jugador=$id and avatar=1");
		if(isset($auxRel)){
			$auxRel->avatar=0;
			$auxRel->save();
		}
		$auxRel= RelImagenJugador::model()->findByPk($imagen);
		$auxRel->avatar=1;
		$auxRel->save();
		echo "1";
	}
	
	public function actionDeleteAll(){
		exit();
		set_time_limit (100000);
		$jugadores= Jugador::model()->findAll();
		foreach($jugadores as $jugador){
			$jugador->delete();
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Jugador $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='jugador-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSacarSab(){
		set_time_limit (100000);
		$jugadores= Jugador::model()->findAll();
		foreach($jugadores as $jugador){
			$jugador->data;
			foreach($jugador->data as $data){
				if(strpos($data->titulo,"¿Sab")!==false){
					//echo $data->titulo;
					//echo "<br>";
					$data->titulo= "Más sobre ".$jugador->nombre." ".$jugador->apellido;
					$data->save();
				}
			}
		}
	}
	
	public function actionTotales(){
		$staffs= Jugador::model()->findAll();
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
