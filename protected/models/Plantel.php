<?php

/**
 * This is the model class for table "tbl_plantel".
 *
 * The followings are the available columns in table 'tbl_plantel':
 * @property integer $id
 * @property string $nombre
 * @property integer $club
 */
class Plantel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Plantel the static model class
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
		return 'tbl_plantel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, club, categoria', 'required'),
			array('club', 'numerical', 'integerOnly'=>true),
			array('categoria', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, club', 'safe', 'on'=>'search'),
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
			'club' => 'Club',
			'categoria' => 'Categoria',
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
		$criteria->compare('club',$this->club);
		$criteria->compare('categoria',$this->categoria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeDelete()
    {
		foreach(RelPlantelJugador::model()->findAll('plantel = '.$this->id) as $rel){
			$rel->delete();
		}
		foreach(RelImagen::model()->findAll('modelId = '.$this->id." and model='Plantel'") as $rel){
			$rel->delete();
		}
		foreach(DataExtra::model()->findAll('modelId = '.$this->id." and model='Plantel' ") as $rel){
			$rel->delete();
		}
		foreach(DataDefault::model()->findAll("model='Plantel' ") as $data){
			$data->delete();
		}
		return true;
    }
}