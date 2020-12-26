<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
</p>
<div align="center">
  <div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <h3>Document Verification</h3>
         <?= $form->field($model, 'application_status')->radioList(['0'=>'Pending','1'=>'Verify','2'=>'Defect','3'=>'Reject'])->label(false) ?>
         <?= $form->field($model, 'defect_reject_reason')->textarea(['rows' => 3,'placeholder'=>'Enter the reason for defect/reject'])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
  </div>
  <h4>Class X Marksheet</h4>
    <img src="/<?= $model->marksheet_1?>" height="1200px">
  <h4>Class X Certificate</h4>
    <img src="/<?= $model->certificate_1?>" height="1200px">
  <h4>Class XII Marksheet</h4>
    <img src="/<?= $model->marksheet_2?>" height="1200px">
  <h4>Class XII Certificate</h4>
    <img src="/<?= $model->certificate_2?>" height="1200px">
  <h4>Class XII Migration/Transfer Certificate</h4>
    <img src="/<?= $model->migration_transfer?>" height="1200px">
    <?php if($model->is_other_course =='1') {?>
      <h4><?=$model->other_course?> Certificate</h4>
      <img src="/<?= $model->other_course_certificate?>" height="1200px">
    <?php } ?>
  <h4>Category(OBC/SC/ST) Certificate</h4>
  <?php if($model->category != 'General'){ ?>
    <img src="/<?= $model->obc_sc_st_file?>" height="1200px">
  <?php }else{?>
  <div>Data not found.</div>
  <?php } ?>
  <h4>Affidavit</h4>
    <?php if(!empty($model->affidavit)){ ?>
      <img src="/<?= $model->migration_transfer?>" height="1200px">
    <?php }else{?>
     <div>Data not found.</div>
    <?php } ?>
</div>
<?php
$this->registerJs(<<<JS
$(document).ready(function(){
  var status = "$model->application_status";
  if(status == '2' || status == '3'){
    $("#verify-defect_reject_reason").show();
  }else{
    $("#verify-defect_reject_reason").hide();
  }
});
$("input[name='Verify[application_status]']").change(function() {
  if(this.value == 2 || this.value == 3){
    $("#verify-defect_reject_reason").show();
  }else {
    $("#verify-defect_reject_reason").hide();
    $("#verify-defect_reject_reason").val('');
  }
});
JS
);
