<?=app\packages\diy\widgets\Position::widget([
	'mode' => (!empty($_GET['diy']) ? (int)$_GET['diy'] : app\packages\diy\widgets\Position::MODE_VIEW),
])?>
<br/>
<br/>
<?=app\packages\diy\widgets\Position::widget([
	'mode' => (!empty($_GET['diy']) ? (int)$_GET['diy'] : app\packages\diy\widgets\Position::MODE_VIEW),
])?>

<?php /* letyii\jstree\JsTreeInput::widget([
	'name' => 'JLS',
	'items' => [
		'Simple root node',
		[
			'text' => 'root node 2',
			'state' => [
				'opened' => true,
				'selected' => true,
			],
			'children' => [
				['text' => 'child 1'],
				'child 2',
			]
		],
	]
]) */ ?>