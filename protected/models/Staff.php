<?php

/**
 * This is the model class for table "tbl_staff".
 *
 * The followings are the available columns in table 'tbl_staff':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $nacimiento
 * @property string $ciudad_natal
 * @property string $puesto
 * @property string $detalle_puesto
 * @property string $defuncion
 */
class Staff extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Staff the static model class
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
		return 'tbl_staff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido', 'required'),
			array('nombre, apellido, nacimiento, ciudad_natal, detalle_puesto, defuncion', 'length', 'max'=>300),
			array('puesto', 'length', 'max'=>100),
			array('nacimiento, ciudad_natal, puesto, detalle_puesto, defuncion,activo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, apellido, nacimiento, ciudad_natal, puesto, detalle_puesto, defuncion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$nombreClase=get_class($this);
		return array(
			
			'imagenes'=>array(self::HAS_MANY ,"RelImagen",array('modelId'=>'id'),"condition"=>"model = '$nombreClase'", ),
			'avatar'=>array(self::HAS_MANY ,"RelImagen","modelId","condition"=>"avatar.destacada=1 and avatar.model = '$nombreClase' " ),
			'data'=>array(self::HAS_MANY ,"DataExtra",array('modelId'=>'id'),"condition"=>"model = '$nombreClase'", ),
			'logros'=>array(self::HAS_MANY ,"Logro",array('modelId'=>'id'),"condition"=>"model = '$nombreClase'", ),
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
			'apellido' => 'Apellido',
			'nacimiento' => 'Fecha y lugar de nacimiento',
			'defuncion' => 'Fecha y lugar de defunción',
			'ciudad_natal' => 'Ciudad Natal',
			'puesto' => 'Puesto',
			'detalle_puesto' => 'Detalle Puesto',
			
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
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nacimiento',$this->nacimiento,true);
		$criteria->compare('ciudad_natal',$this->ciudad_natal,true);
		$criteria->compare('puesto',$this->puesto,true);
		$criteria->compare('detalle_puesto',$this->detalle_puesto,true);
		$criteria->compare('defuncion',$this->defuncion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}