<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\Event;
use frontend\models\District;
use frontend\models\Scheme;
use frontend\models\FarmType;
use yii\helpers\Url;

$this->title = 'Geo Tagging Dashboard';

$webroot = Yii::getAlias('@web');

$load_url = Url::to(['/site/details', 'id'=>'']);
?>
<div class="">
<p>
  <h3>Birth of Agriculture Department</h3>
The Department of Agriculture, Manipur was emerged in March 1946 with a skeleton staff consisting of about a dozen members only headed by an Agriculture Officer in a small building at Babupara, Imphal.
With the lunching of “Grow More Food Campaign” under Ministry of Food and Agriculture, Government of India a separate Food Production Office was established in September 1950 with the objective of popularizing double cropping in all suitable areas state in both Hills and Valley.
The gradual increase of the staff strength to cop with the increasing volume of work of the Department, the State Government recognized the felt need of strengthening the Department that necessitated the creation of a post of Director of Agriculture, Manipur along with supporting staff during 1954. After 37 years of existence, Agriculture Department becomes a major department in the year 1983 with a total sanctioned post of 2,277 nos.
</p>
</div>
<?php
if(1){
  $this->registerJs(<<<JS

  $(document).ready(function(){
    $("#choose-modal").modal("show");
    return false;
  });
  JS
  );
}
