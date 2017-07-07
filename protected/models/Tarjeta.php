<?php

/**
 * This is the model class for table "tbl_tarjeta".
 *
 * The followings are the available columns in table 'tbl_tarjeta':
 * @property integer $id
 * @property integer $tarjeta
 * @property integer $rel
 * @property string $comentario
 */
class Tarjeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tarjeta the static model class
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
		return 'tbl_tarjeta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tarjeta, rel,minuto', 'required'),
			array('tarjeta, rel', 'numerical', 'integerOnly'=>true),
			array('comentario,minuto', "safe"),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tarjeta, rel, comentario', 'safe', 'on'=>'search'),
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
			'rel_data'=>array(self::HAS_ONE , 'RelPartidoJugador', array('id'=>'rel')),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tarjeta' => 'Tarjeta',
			'rel' => 'Rel',
			'minuto' => 'Minuto',
			'comentario' => 'Comentario',
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
		$criteria->compare('tarjeta',$this->tarjeta);
		$criteria->compare('rel',$this->rel);
		$criteria->compare('minuto',$this->minuto);
		$criteria->compare('comentario',$this->comentario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}