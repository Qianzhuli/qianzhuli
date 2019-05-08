<?php
use yii\web\Controller;

$this->title = Yii::t('common','Platform for details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Rating'),'url' => ['rate/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (isset($data['error'])) {?>
	<h1><?= $data['org_name'] ?>的信息正在采集中，就快有啦...</h1>
<?php }else { ?>
	<h1>系统错误，请联系管理员735407073@qq.com</h1>
<?php } ?>