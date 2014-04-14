<?php

/**
 * This is the model class for table "detalle_equipo".
 *
 * The followings are the available columns in table 'detalle_equipo':
 * @property integer $iddetalle_equipo
 * @property integer $idevento
 * @property string $fecha
 * @property integer $idequipo
 * @property string $hora_inicio_prog
 * @property string $hora_fina_prog
 * @property string $hora_inicio_real
 * @property string $hora_fina_real
 * @property integer $estado
 * @property integer $estado_clock
 *
 * The followings are the available model relations:
 * @property Equipo $idequipo0
 * @property Evento $idevento0
 * @property DetalleEquipoClock[] $detalleEquipoClocks
 * @property DetalleEquipoProducto[] $detalleEquipoProductos
 */
class DetalleEquipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idevento, idequipo, estado, estado_clock', 'numerical', 'integerOnly'=>true),
			array('fecha, hora_inicio_prog, hora_fina_prog, hora_inicio_real, hora_fina_real', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iddetalle_equipo, idevento, fecha, idequipo, hora_inicio_prog, hora_fina_prog, hora_inicio_real, hora_fina_real, estado, estado_clock', 'safe', 'on'=>'search'),
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
			'idequipo0' => array(self::BELONGS_TO, 'Equipo', 'idequipo'),
			'idevento0' => array(self::BELONGS_TO, 'Evento', 'idevento'),
			'detalleEquipoClocks' => array(self::HAS_MANY, 'DetalleEquipoClock', 'iddetalleequipo'),
			'detalleEquipoProductos' => array(self::HAS_MANY, 'DetalleEquipoProducto', 'iddetalle_equipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddetalle_equipo' => 'Iddetalle Equipo',
			'idevento' => 'Idevento',
			'fecha' => 'Fecha',
			'idequipo' => 'Idequipo',
			'hora_inicio_prog' => 'Hora Inicio Prog',
			'hora_fina_prog' => 'Hora Fina Prog',
			'hora_inicio_real' => 'Hora Inicio Real',
			'hora_fina_real' => 'Hora Fina Real',
			'estado' => 'Estado',
			'estado_clock' => 'Estado Clock',
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

		$criteria->compare('iddetalle_equipo',$this->iddetalle_equipo);
		$criteria->compare('idevento',$this->idevento);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('idequipo',$this->idequipo);
		$criteria->compare('hora_inicio_prog',$this->hora_inicio_prog,true);
		$criteria->compare('hora_fina_prog',$this->hora_fina_prog,true);
		$criteria->compare('hora_inicio_real',$this->hora_inicio_real,true);
		$criteria->compare('hora_fina_real',$this->hora_fina_real,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('estado_clock',$this->estado_clock);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
