<?php

/**
 * This is the model class for table "detalle_equipofisico".
 *
 * The followings are the available columns in table 'detalle_equipofisico':
 * @property integer $iddetalle_quipoFisico
 * @property integer $idevento
 * @property string $marca_equipo
 * @property string $voltaje
 * @property string $corriente
 * @property string $presion_baja
 * @property string $temperatura
 * @property string $presion_alta
 *
 * The followings are the available model relations:
 * @property Evento $idevento0
 */
class DetalleEquipofisico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_equipofisico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idevento', 'numerical', 'integerOnly'=>true),
			array('marca_equipo, voltaje, corriente, presion_baja, temperatura, presion_alta', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iddetalle_quipoFisico, idevento, marca_equipo, voltaje, corriente, presion_baja, temperatura, presion_alta', 'safe', 'on'=>'search'),
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
			'idevento0' => array(self::BELONGS_TO, 'Evento', 'idevento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddetalle_quipoFisico' => 'Iddetalle Quipo Fisico',
			'idevento' => 'Idevento',
			'marca_equipo' => 'Marca Equipo',
			'voltaje' => 'Voltaje',
			'corriente' => 'Corriente',
			'presion_baja' => 'Presion Baja',
			'temperatura' => 'Temperatura',
			'presion_alta' => 'Presion Alta',
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

		$criteria->compare('iddetalle_quipoFisico',$this->iddetalle_quipoFisico);
		$criteria->compare('idevento',$this->idevento);
		$criteria->compare('marca_equipo',$this->marca_equipo,true);
		$criteria->compare('voltaje',$this->voltaje,true);
		$criteria->compare('corriente',$this->corriente,true);
		$criteria->compare('presion_baja',$this->presion_baja,true);
		$criteria->compare('temperatura',$this->temperatura,true);
		$criteria->compare('presion_alta',$this->presion_alta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleEquipofisico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
