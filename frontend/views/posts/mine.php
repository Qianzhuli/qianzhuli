<?php
$this->title = Yii::$app->user->identity->username . '的资讯';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Information'),'url' => ['posts/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="cow">
	<div class="col-lg-12">
		<table class="posts-mine-table">
			<tr>
				<th>预览图</th>
				<th>标题</th>
				<th>摘要</th>
				<th>审核状态</th>
				<th>创建时间</th>
				<th>更新时间</th>
			</tr>
			<?php foreach ($posts as $post):?>
				<tr>
					<?= '<td><img src="' . $post['label_img'] . '"></td>' ?>
					<td><?= '<a href="view?id='.$post['id'].'">'.$post['title'].'</a>'?></td>
					<td><?= $post['summary'] ?></td>
					<td><?php if($post['is_valid'] == 1){
						echo '审核通过';
					}else{
						echo '待审核';
					} ?></td>
					<td><?= date('Y-m-d',$post['created_at']); ?></td>
					<td><?= date('Y-m-d',$post['updated_at']); ?></td>
				</tr>
			<?php endforeach?>
		</table>
	</div>
</div>