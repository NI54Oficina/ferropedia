<?php

class DataExtraController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update',"resultados","proximo","date"),
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
	
	public function actionDate(){
		//echo "poyo";
		$args = array(
			'date_query' => array(
				array(
					
					'month' => 07,
					'day'   => 27,
				),
			),
			"category_name"=>"evento"
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
					// The 2nd Loop
					while ( $query->have_posts() ) {
						$query->the_post();
						echo the_title();
						echo "<br>";
					}
		}
					exit();
	}
	
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DataExtra;
		
		if(isset($_POST["model"])){
			
			$model->model= $_POST["model"];
			$model->modelId= $_POST["modelId"];
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DataExtra']))
		{
			$model->attributes=$_POST['DataExtra'];
			if($model->save()){
				$this->redirect(array('/'.$model->model.'/'.$model->modelId));
			}
				//$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['DataExtra']))
		{
			$model->attributes=$_POST['DataExtra'];
			if($model->save()){
				$this->redirect(array('/'.$model->model.'/'.$model->modelId));
			}
				//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
	public function actionProximo()
	{
		$model= DataExtra::model()->findByAttributes(array("titulo"=>"ProximoPartido"));

		$guardado="no";
		if(isset($_POST['DataExtra']))
		{
			$texto="";
			foreach($_POST["DataExtra"] as $d){
				$texto.=$d.";";
			}
			$model->texto=$texto;
			if($model->save()){
				$guardado="si";
				//agregar textito que confirme el guardado
			}
				//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('proximo',array(
			'model'=>$model,"guardado"=>$guardado
		));
	}
	
	public function actionResultados()
	{
		$model= DataExtra::model()->findByAttributes(array("titulo"=>"Total"));
		$primera= DataExtra::model()->findByAttributes(array("titulo"=>"Primera División"));
		$ascenso= DataExtra::model()->findByAttributes(array("titulo"=>'Ascenso  <span style="color:#8f8f8f">*</span>'));
		$local= DataExtra::model()->findByAttributes(array("titulo"=>'Copas Locales'));
		$internacional= DataExtra::model()->findByAttributes(array("titulo"=>'Copas Internacionales'));

		$guardado="no";
		if(isset($_POST['Totales']))
		{
			$texto="";
			foreach($_POST["Totales"] as $d){
				$texto.=$d."/";
			}
			$model->texto=$texto;
			if($model->save()){
				$guardado="si";
				//agregar textito que confirme el guardado
			}
				//$this->redirect(array('view','id'=>$model->id));
		}
		
		if(isset($_POST['Primera']))
		{
			$texto="";
			foreach($_POST["Primera"] as $d){
				$texto.=$d."/";
			}
			$primera->texto=$texto;
			if($primera->save()){
				$guardado="si";
				
			}
		}
		
		if(isset($_POST['Ascenso']))
		{
			$texto="";
			foreach($_POST["Ascenso"] as $d){
				$texto.=$d."/";
			}
			$ascenso->texto=$texto;
			if($ascenso->save()){
				$guardado="si";
				
			}
		}
		
		if(isset($_POST['Local']))
		{
			$texto="";
			foreach($_POST["Local"] as $d){
				$texto.=$d."/";
			}
			$local->texto=$texto;
			if($local->save()){
				$guardado="si";
				
			}
		}
		
		if(isset($_POST['Internacional']))
		{
			$texto="";
			foreach($_POST["Internacional"] as $d){
				$texto.=$d."/";
			}
			$internacional->texto=$texto;
			if($internacional->save()){
				$guardado="si";
				
			}
		}
		
		

		$this->render('resultados',array(
			'model'=>$model,
			"primera"=>$primera,
			"ascenso"=>$ascenso,
			"local"=>$local,
			"internacional"=>$internacional,
			"guardado"=>$guardado
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model= $this->loadModel($id);
		$redirectM=$model->model;
		$redirectI=$model->modelId;
		
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
			$this->redirect(array($redirectM."/view","id"=>$redirectI));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DataExtra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DataExtra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DataExtra']))
			$model->attributes=$_GET['DataExtra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DataExtra the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DataExtra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DataExtra $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-extra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
