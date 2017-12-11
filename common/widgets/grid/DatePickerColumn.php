<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 6:56 PM
 */
namespace common\widgets\grid;

use kartik\daterange\DateRangePicker;
use yii\di\Instance;
use yii\grid\Column;
use yii\helpers\ArrayHelper;
use yii\i18n\Formatter;
use Yii;
class DatePickerColumn extends Column{


    //Header Of Column
    public $header = 'Select Date';

    //Column of ActiveDataProvider model
    public $column = 'created_at';

    //Search Model Attribute
    public $filterAttribute = 'created_at';

    //plugin Options
    public $pluginOptions= ['format'=>'YYYY-MM-DD','opens'=>'left','separator'=> ' - '];

    //container options
    public $containerOptions=['class' => 'drp-container input-group', 'style' => 'width: 250px;'];


    public function init(){

        $maxValue = ArrayHelper::getValue($this->pluginOptions ,'maxDate' ,Yii::$app->formatter->asDate('now' ,'php:Y-m-d'));
        //$this->pluginOptions = ArrayHelper::merge($this->pluginOptions ,['maxDate' => $maxValue]);
        $startDate = Yii::$app->formatter->asDatetime('- 30 days','php:Y-m-d');
        $this->pluginOptions = ArrayHelper::merge($this->pluginOptions ,['startDate' => $startDate,'endDate'=>$maxValue]);
        parent::init();
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        /**
         * Assigning Instance as Formatter
         * @see Instance::ensure
         */
        $_dateFormats = null;
        $formatter = Instance::ensure('formatter',Formatter::className());
        $value = ArrayHelper::getValue($model ,$this->column);
        if($value){
            $_dateFormats  = $formatter->asDatetime(strtotime($value),'php:d M y h:i A');
        }
        return $_dateFormats;
    }

    protected function renderFilterCellContent()
    {
        return DateRangePicker::widget([
            'id' => 'date-picker',
            'model'=> $this->grid->filterModel,
            'attribute' => $this->filterAttribute,
            'presetDropdown'=>false,
            'hideInput'=>true,
            'pluginOptions' => $this->pluginOptions,
            'containerOptions' => $this->containerOptions,
        ]);
    }

}