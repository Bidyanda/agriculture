<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
  'id'=>'modal-sm',
  'size'=>'modal-sm',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-sm-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-sm-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-md',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-md-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-md-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-lg',
  'size'=>'modal-lg',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-lg-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-lg-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'modal-xl',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text"></div>'
]);
echo '<div id="modal-xl-loader" style="display: none;">';
echo $this->render('loader-modal.php');
echo '</div><div id="modal-xl-body"><br><br></div>';
Modal::end();

Modal::begin([
  'id'=>'choose-modal',
  'size'=>'modal-sm',
  'clientOptions'=>['backdrop'=>'static'],
  'header' => '<div class="header-text">Application for</div>'
]);
?>
<div>
  <p>
    <div class="row">
      <div class="col-md-6">
        <?= Html::a('Insecticide', ['/application/insecticide'], ['class' => 'btn btn-primary btn-md']) ?>
      </div>
      <div class="col-md-6">
        <?= Html::a('Fertilizer', ['/application/fertilizer'], ['class' => 'btn btn-primary btn-md']) ?>
      </div>
    </div>
  </p>
</div>
<!-- <div class="text-center"><button class="btn btn-danger btn-sm" onclick="$('#instructions-modal').modal('hide');">Close</button></div> -->
<?php
Modal::end();
