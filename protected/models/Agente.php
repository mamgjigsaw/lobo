<?php

/**
 * This is the model class for table "agente".
 *
 * The followings are the available columns in table 'agente':
 * @property integer $idagente
 * @property string $nombre
 * @property integer $tipo
 * @property string $codigo_qr
 * @property string $fecha_ingreo
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property AsignacionEquipoAgente[] $asignacionEquipoAgentes
 */
class Agente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, estado', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			array('codigo_qr', 'length', 'max'=>200),
			array('fecha_ingreo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idagente, nombre, tipo, codigo_qr, fecha_ingreo, estado', 'safe', 'on'=>'search'),
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
			'asignacionEquipoAgentes' => array(self::HAS_MANY, 'AsignacionEquipoAgente', 'idagente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idagente' => 'Idagente',
			'nombre' => 'Nombre',
			'tipo' => 'Tipo',
			'codigo_qr' => 'Codigo Qr',
			'fecha_ingreo' => 'Fecha Ingreo',
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

		$criteria->compare('idagente',$this->idagente);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('codigo_qr',$this->codigo_qr,true);
		$criteria->compare('fecha_ingreo',$this->fecha_ingreo,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Agente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
