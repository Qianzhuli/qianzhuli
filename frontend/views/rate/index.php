<?php

use yii\helpers\Url;

$this->title = Yii::t('common','Rating');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row table-responsive">
	<div class="col-lg-12">
		<div style="border-bottom: 3px solid #e26854;">
			<span style="color: #e26854; font-size: 28px;">网贷平台评级&nbsp;</span>
			<b style="color: gray;"><?= Date('Y年m月d日') ?>更新</b>
		</div>
		<div style="border-bottom: 1px dashed gray; padding: 12px 5px;">
			<p>1.本网贷评级结果仅供参考，不构成投资建议，本课题组不对投资者据此操作造成的损失承担后果；</p>
			<p>2.评级参考的信息与数据不依赖网贷平台主动提供，且评级项目的所有经费由本站承担，凡以本课题组名义， 以任何理由向被评级对象或利益相关方收取费用的行为均属违规行为，如发现类似情况可及时向我们举报， 举报邮箱：735407073@qq.com</p>
		</div>
	</div>
</div>
<div class="row table-responsive">
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>综合排名</th>
					<th>平台</th>
					<th>评级</th>
					<th>平均收益</th>
					<th>上线时间</th>
					<th>平台背景</th>
					<th>人气指数</th>
					<th>网友评价</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $key => $value): ?>
				<tr>
					<td><?= $key+1 ?></td>
					<td><a href="<?=Url::to(['rate/view','org_name'=>$value['org_name']])?>"><?= $value['org_name'] ?></a></td>
					<td style="font-weight: bold;"><?= $value['rate'] ?></td>
					<td style="color: #bd0000;"><?= $value['average_income'] ?></td>
					<td><?= $value['build_time'] ?></td>
					<td><?= $value['backgroud'] ?></td>
					<td style="color: red;"><?= $value['hot'] ?></td>
					<td><?= $value['high_praise'] ?></td>
					<td><a href="<?=Url::to(['rate/view','org_name'=>$value['org_name']])?>">了解更多</a></td>
				</tr>
				<?php endforeach;?> 
			</tbody>
		</table>
	</div>
</div>