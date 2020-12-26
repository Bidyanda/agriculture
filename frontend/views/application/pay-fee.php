<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Registration Fee Payment';

$payfee = Url::to(['/application/registration-fee']);

setlocale(LC_MONETARY, 'en_IN');

?>

<div class="card">
	<?= $this->render('../site/header') ?>
	<div class="card-body hasloader">
        <div id="full-loader"></div>
		 <div class="loader">
            <div class="loader-cover"></div>
            <div class="loader-text">
                <i class="fa fa-spinner fa-spin text-primary"></i>&nbsp;
                <span class="loader-subtext">Please wait...</span>
            </div>
        </div>
        <h4 class="text-center">
            <p><b class="text-primary"><?= $this->title ?></b></p>
        </h4>
        <br>

        <?= $this->render('steps') ?>

		<section>
	        <br>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <label for="declaration" style="text-align: justify;">
                        <input type="checkbox" id="declaration">
                        I understand that I am required to deposit the amount of &#8377;<?= $amount ?> as caution money and undertaking to abide by the discipline of the institute, to take proper care of the tools and equipment entrusted to my charge and not to discontinue my training voluntarily before the completion of the course. I agree that if I fail to fulfil the terms of the undertaking, Government will have the right to recover the expenses incurred on my training of such an amount as they think fit. I shall be prepared to give such undertaking on the prescribed form on joining the institute and shall also secure sureties from my father/guardian and from another suitable person in this regard. I further understand that I shall have no claim for continuing the training if I fail in the aptitute test.
                    </label>
                </div>
            </div>
			<br>

        </section>
		<br>
		<div class="text-center">
			<?= Html::button('Pay Registration Fee', ['class'=>'btn btn-lg btn-primary', 'id'=>'submit-btn', 'disabled'=>true]) ?>
		</div>
		<br>

        <div id="payfee"></div>
	</div>
</div>

<?php
// do not remove. Need to place this here so that it is preloaded before the next action (/pay-fee/pay)
$this->registerJsFile("https://checkout.razorpay.com/v1/checkout.js");

$this->registerJs(<<<JS
$("#declaration").change(function() {
    if($(this).is(":checked")) {
        $("#submit-btn").prop("disabled", false);
    } else {
        $("#submit-btn").prop("disabled", true);
    }
});

$("#submit-btn").click(function() {
	$(".loader").show();
	$("#payfee").load('$payfee', function() {
		$(".loader").hide();
	});
});
JS
);
