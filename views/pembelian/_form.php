<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Supplier;
use app\models\Gudang;

$supplier = ArrayHelper::map(
    Supplier::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
  ->asArray()
  ->all(),
    'id',
    'ket'
);

$gudang = ArrayHelper::map(
    Gudang::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
  ->asArray()
  ->all(),
    'id',
    'ket'
);


/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
        <div class="row">
 <div class="col-md-6">
    <?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->widget(DateControl::classname()); ?>
    </div>
    <div class="col-md-6">

    <?= $form->field($model, 'id_supplier')->widget(Select2::className(), [
        'data' => $supplier,
        'options' => ['placeholder' => 'Pilih Supplier...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'id_gudang')->widget(Select2::className(), [
        'data' => $gudang,
        'options' => ['placeholder' => 'Pilih Gudang...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>


    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
</div>
    </div>

    <div class="panel panel-success"   >
<div class="panel-heading"> Detail Pembelian

</div>
<div class="panel-body">
<table class="table">
    <thead>
        <tr>

            <th>Barang</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Sub Total</th>

            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->listPembelian,
        'model' => \app\models\ItemPembelian::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
