<?=app\packages\diy\widgets\Position::widget([
	'options' => [
		'class' => 'diy-dropable',
	]
])?>
<br/>
<br/>
<?=app\packages\diy\widgets\Position::widget([
	'options' => [
		'class' => 'diy-dropable',
	]
])?>

<?=letyii\jstree\JsTreeInput::widget([
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
])?>