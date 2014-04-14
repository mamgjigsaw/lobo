<?php

/**
 * This is the model class for table "detalle_equipo_clock".
 *
 * The followings are the available columns in table 'detalle_equipo_clock':
 * @property integer $iddetalle_equipo_clock
 * @property integer $iddetalleequipo
 * @property integer $tipo
 * @property string $latitud
 * @property string $longitud
 *
 * The followings are the available model relations:
 * @property DetalleEquipo $iddetalleequipo0
 */
class DetalleEquipoClock extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_equipo_clock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iddetalleequipo, tipo', 'numerical', 'integerOnly'=>true),
			array('latitud, longitud', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iddetalle_equipo_clock, iddetalleequipo, tipo, latitud, longitud', 'safe', 'on'=>'search'),
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
			'iddetalleequipo0' => array(self::BELONGS_TO, 'DetalleEquipo', 'iddetalleequipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddetalle_equipo_clock' => 'Iddetalle Equipo Clock',
			'iddetalleequipo' => 'Iddetalleequipo',
			'tipo' => 'Tipo',
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('iddetalle_equipo_clock',$this->iddetalle_equipo_clock);
		$criteria->compare('iddetalleequipo',$this->iddetalleequipo);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('latitud',$this->latitud,true);
		$criteria->compare('longitud',$this->longitud,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleEquipoClock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
