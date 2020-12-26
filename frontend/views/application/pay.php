<?php

use yii\helpers\Html;
use yii\helpers\Url;

$confirm_url = Url::to(["/application/confirm"]);

?>

<?php if($fail) { ?>
    <?php $this->registerJs('toast("'.$fail.'", "bg-red")'); ?>
<?php } else { ?>

<script type="text/javascript">
var options = {
    "key": "<?= $data['key'] ?>",
    "amount": "<?= $data['amount'] ?>",
    "currency": "INR",
    "name": "ITI Manipur",
    "image": "/images/rzp_logo.png",
    "order_id": "<?= $data['razorpay_order_id'] ?>",
    "handler": function (response) {
        $.ajax({
        	url: "<?= $confirm_url ?>",
        	data: {'data':JSON.stringify(response)},
        	type: "POST",
        	dataType: 'json'
        });
    },
    "prefill": {
        "name": "<?= $data['name'] ?>",
        "email": "<?= $data['email'] ?>",
        "contact": "<?= $data['phone'] ?>"
    },
    "modal": {
    	"escape": false
    },
    "theme": {
        "color": "#3d5890"
    }
};

</script>

<?php
// manual mode is used because button it's not working when loaded via ajax
// Razorpay script checkout.js is loaded in the previos view (_form.php)
$this->registerJs(<<<JS
var rzp1 = new Razorpay(options);
rzp1.open();
JS
);

}
