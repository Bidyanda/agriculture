<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model frontend\models\Fertilizer */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $this->render('/site/steps');?>
<div class="fertilizer-form card">
    <div class="card-body">
      <div class="card-body hasloader">
          <div id="full-loader"></div>
          <div class="loader">
              <div class="loader-cover"></div>
              <div class="loader-text">
                  <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                  <span class="loader-subtext">Uploading...</span>
              </div>
          </div>

        <?php $form = ActiveForm::begin([
          'id' => 'fertilizer-form',
          'layout' => 'horizontal',
          'fieldConfig' => [
              'horizontalCssClasses' => [
                                            'label' => 'col-sm-4',
                                            'offset' => 'col-sm-offset-2',
                                            'wrapper' => 'col-sm-5',
                                        ],
                                    ],
                                ]); ?>
        <h4 class="text-center">
            <p>
              <b class="text-primary" style="font-size:22px;"><u>FORM-'A1'</u></b><br />
              <b class="text-primary" style="font-size:22px;">MEMORANDUM OF INTIMATION,</b><br />
              <div><small>[See Clause 8(2)]</small></div>
            </p>
            <div><small>Fields marked (<span class="text-danger">*</span>) are mandatory</small></div>
        </h4>
        <div align='center'>
          <?= $form->field($model, 'is_renew')->radiolist(['1'=>'New','2'=>'Renewal'])->label('Application for Licence <span class="text-danger">*</span>') ?>
        </div>
        <?php //if($model->is_renew == '2') {?>
          <?= $form->field($model, 'licence')->textInput()->label($model->getAttributeLabel('licence').' <span class="text-danger">*</span>') ?>
          <?= $form->field($model, 'licence_grant_date')->widget(DatePicker::className(), [
                                                                            'options' => ['readonly' => true,'class'=>'form-control','autocomplete'=>'off','placeholder'=>'Date of licence grant'],
                                                                            'clientOptions' => [
                                                                                'autoclose' => true,
                                                                                'format' => 'dd-mm-yyyy'
                                                                            ]
                                                                    ])->label($model->getAttributeLabel('Date of grant').' <span class="text-danger">*</span>')  ?>
        <?php //} ?>
        <h4 class="text-left">
            <div><b class="text-primary">1. Place of business(Please give full address)</b></div>
        </h4>
        <section>
          <div align='center'>
            <?= $form->field($model, 'address_of_sale')->textarea(['rows' =>3])->label($model->getAttributeLabel('For Sale').' <span class="text-danger">*</span>')  ?>
          </div>
          <div align='center'>
            <?= $form->field($model, 'address_of_storage')->textarea(['rows' =>3])->label($model->getAttributeLabel('For Storage').' <span class="text-danger">*</span>')  ?>
          </div>
        </section>
        <h4 class="text-left">
            <div><b class="text-primary">2. Whether the application is for </b></div>
        </h4>
        <section>
          <div align='center'>
            <?= $form->field($model, 'manufacture')->radiolist([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])->label($model->getAttributeLabel('Manufacture').' <span class="text-danger">*</span>')  ?>
          </div>
          <div align='center'>
            <?= $form->field($model, 'importer')->radiolist([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])->label($model->getAttributeLabel('Importer').' <span class="text-danger">*</span>')  ?>
          </div>
          <div align='center'>
            <?= $form->field($model, 'pool_handling_agency')->radiolist([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])->label($model->getAttributeLabel('Pool Handling Agency').' <span class="text-danger">*</span>')  ?>
          </div>
          <div align='center'>
            <?= $form->field($model, 'wholesale_dealer')->radiolist([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])->label($model->getAttributeLabel('Wholesale Dealer').' <span class="text-danger">*</span>')  ?>
          </div>
          <div align='center'>
            <?= $form->field($model, 'retail_dealer')->radiolist([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => ''])->label($model->getAttributeLabel('retail_dealer').' <span class="text-danger">*</span>')  ?>
          </div>
        </section>
        <h4 class="text-left">
            <div><b class="text-primary">3. Details of Fertilizer and their source in form 'O'</b></div>
        </h4>
        <section>
          <div class="task-form">
            <div class="container-items"><!-- widgetContainer -->
              <?php DynamicFormWidget::begin([
                  'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                  'widgetBody' => '.container-items', // required: css class selector
                  'widgetItem' => '.item', // required: css class
                  'limit' => 8, // the maximum times, an element can be added (default 999)
                  'min' => 1, // QUESTION: , // 0 or 1 (default 1)
                  'insertButton' => '.add-item', // css class
                  'deleteButton' => '.remove-item', // css class
                  'model' => $modelsInsecticide[0],
                  'formId' => 'fertilizer-form',
                  'formFields' => [
                      'fertilizer_name',
                      'whether_cert_form_o_attach'
                  ],
              ]);
              ?>
              <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsInsecticide as $i => $modelInsecticide): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs "><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <!-- <div class="clearfix"></div> -->
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $modelInsecticide->isNewRecord) {
                                    echo Html::activeHiddenInput($modelInsecticide, "[{$i}]id");
                                }
                            ?>
                              <?= $form->field($modelInsecticide, "[{$i}]sl_no",['template' => '<div class="col-md-6">{input}{error}</div>'])->textInput(['placeholder'=>'Name of Fertilizer'])->label(false) ?>
                              <?= $form->field($model, "[{$i}]manufacture",['template' => '<div class="col-md-6">{input}{error}</div>'])->radiolist([ 'Yes' => 'Yes', 'No' => 'No'])->label(false)  ?>
                        </div>
                    </div>
                <?php endforeach; ?>
              </div>
              <?php DynamicFormWidget::end(); ?>
            </div>
          </div>
        </section>
        <b>4. Whether the intimation is for an authorisation letter or a renewal thereof.<br /> Note: in case the intimation is for renewal of authorisation letter, ther acknowledgement in Form A2 should be submitted for necessary endorsement thereon.)</b>
        <br><br />
        <b>5. Any other relevant information.
         I have read the terms and conditions of eligibility for submission of Memoradum of Intimation and undertake that the same will be complied by me and in token of the samem i have signed the same adn is enclosed herewith.</b>
         <br /><br />
        <div class="form-group text-center">
            <?= Html::submitButton('Proceed', ['class' => 'btn btn-primary btn-lg', 'id'=>'submit-btn']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>
<style>

container-items .
[role="radiogroup"] {
	margin-top: 12px;
}
[role="radiogroup"] .radio {
	display: inline;
}
.form-horizontal .radio, .form-horizontal .radio-inline {
    padding-top: 2px;
}
.card-header, .card-body {
    padding: 24px;
    padding-top: 0.2%;
}
</style>
