<?php

/**
 * This is the model class for table "asignacion_equipo_agente".
 *
 * The followings are the available columns in table 'asignacion_equipo_agente':
 * @property integer $idasignacion_equipo_agente
 * @property integer $idequipo
 * @property integer $idagente
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Agente $idagente0
 * @property Equipo $idequipo0
 */
class AsignacionEquipoAgente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asignacion_equipo_agente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idequipo, idagente, estado', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idasignacion_equipo_agente, idequipo, idagente, estado', 'safe', 'on'=>'search'),
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
			'idagente0' => array(self::BELONGS_TO, 'Agente', 'idagente'),
			'idequipo0' => array(self::BELONGS_TO, 'Equipo', 'idequipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idasignacion_equipo_agente' => 'Idasignacion Equipo Agente',
			'idequipo' => 'Idequipo',
			'idagente' => 'Idagente',
			'estado' => 'Estado',
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

		$criteria->compare('idasignacion_equipo_agente',$this->idasignacion_equipo_agente);
		$criteria->compare('idequipo',$this->idequipo);
		$criteria->compare('idagente',$this->idagente);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AsignacionEquipoAgente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
