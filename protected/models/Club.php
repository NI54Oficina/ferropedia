<?php

/**
 * This is the model class for table "tbl_club".
 *
 * The followings are the available columns in table 'tbl_club':
 * @property integer $id
 * @property string $nombre
 * @property string $ciudad
 */
class Club extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Club the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_club';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, ciudad', 'required'),
			array('nombre, ciudad', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, ciudad', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'planteles'=>array(self::HAS_MANY ,"Plantel",array('club'=>'id') ),
			'data'=>array(self::HAS_MANY ,"DataExtra",array('modelId'=>'id'),"condition"=>"data.model='Club'" ),
			'avatar'=>array(self::HAS_MANY ,"RelImagen","modelId","condition"=>"avatar.destacada=1 and avatar.model='Club'"),
			'imagenes'=>array(self::HAS_MANY ,"RelImagen",array('modelId'=>'id'),"condition"=>"imagenes.model='Club'","with"=>"imagen_data" ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'ciudad' => 'Ciudad',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('ciudad',$this->ciudad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeDelete()
    {
		foreach(RelPartidoClub::model()->findAll('club = '.$this->id) as $rel){
			$rel->delete();
		}
		foreach(Plantel::model()->findAll("club = ".$this->id) as $plantel){
			$plantel->delete();
		}
		foreach(RelImagen::model()->findAll('modelId = '.$this->id." and model='Club'") as $rel){
			$rel->delete();
		}
		foreach(DataExtra::model()->findAll('modelId = '.$this->id." and model='Club' ") as $data){
			$data->delete();
		}
		foreach(DataDefault::model()->findAll("model='Club' ") as $data){
			$data->delete();
		}
		
		return true;
    }
}