<?php
/**
 * [ADMIN] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

/**
 * [ADMIN] 登録項目一覧　テーブル
 * @var BcAppView $this
 */
?>

<?php if($isNewThemeAdmin):?>
<div class="bca-data-list__top">
<!-- 一括処理 -->
<?php if ($this->BcBaser->isAdminUser()): ?>
	<div class="bca-action-table-listup">
		<?php echo $this->BcForm->input('ListTool.batch', ['type' => 'select', 'options' => ['del' => __d('baser', '削除')], 'empty' => __d('baser', '一括処理'), 'data-bca-select-size' =>'lg']) ?>
		<?php echo $this->BcForm->button(__d('baser', '適用'), ['id' => 'BtnApplyBatch', 'disabled' => 'disabled' , 'class' => 'bca-btn', 'data-bca-btn-size' => 'lg']) ?>
	</div>
<?php endif ?>
  <div class="bca-data-list__sub">
    <!-- pagination -->
    <?php $this->BcBaser->element('pagination') ?>
  </div>
</div>
<?php else: ?>
<!-- pagination -->
<?php $this->BcBaser->element('pagination') ?>
<?php endif; ?>

<!-- list -->
<table cellpadding="0" cellspacing="0" class="list-table bca-table-listup sort-table" id="ListTable">
<thead class="bca-table-listup__thead">
	<tr>
	<?php if($isNewThemeAdmin):?>
		<th class="list-tool bca-table-listup__thead-th  bca-table-listup__thead-th--select">
			<?php if ($this->BcBaser->isAdminUser()): ?>
				<?php echo $this->BcForm->input('ListTool.checkall', ['type' => 'checkbox', 'label' => __d('baser', '一括選択')]) ?>
			<?php endif ?>
		</th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('id', ['asc' => '<i class="bca-icon--asc"></i>'.' id', 'desc' => '<i class="bca-icon--desc"></i>'.' id'], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('name', ['asc' => '<i class="bca-icon--asc"></i>'.' キー', 'desc' => '<i class="bca-icon--desc"></i>'.' キー'], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('value', ['asc' => '<i class="bca-icon--asc"></i>'.' 値', 'desc' => '<i class="bca-icon--desc"></i>'.' 値'], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('modified', ['asc' => '<i class="bca-icon--asc"></i>'.' 並び順', 'desc' => '<i class="bca-icon--desc"></i>'.' 並び順'], ['escape' => false, 'class' => 'btn-direction bca-table-listup__a']) ?></th>
		<th class="list-tool bca-table-listup__thead-th">
			アクション
		</th>
	<?php else:?>
		<th class="list-tool bca-table-listup__thead-th">
			<?php if ($this->BcBaser->isAdminUser()): ?>
			<div>
				<?php echo $this->BcForm->checkbox('ListTool.checkall', ['title' => __d('baser', '一括選択')]) ?>
				<?php echo $this->BcForm->input('ListTool.batch', ['type' => 'select', 'options' => array('del' => __d('baser', '削除')), 'empty' => __d('baser', '一括処理')]) ?>
				<?php echo $this->BcForm->button(__d('baser', '適用'), ['id' => 'BtnApplyBatch', 'disabled' => 'disabled']) ?>
			</div>
			<?php endif; ?>
		</th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('id', ['asc' => $this->BcBaser->getImg('admin/blt_list_down.png', ['alt' => __d('baser', '昇順'), 'title' => __d('baser', '昇順')]) . ' id', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', ['alt' => __d('baser', '降順'), 'title' => __d('baser', '降順')]) . ' NO'], ['escape' => false, 'class' => 'btn-direction']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('name', ['asc' => $this->BcBaser->getImg('admin/blt_list_down.png', ['alt' => __d('baser', '昇順'), 'title' => __d('baser', '昇順')]) . ' キー', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', ['alt' => __d('baser', '降順'), 'title' => __d('baser', '降順')]) . ' キー'], ['escape' => false, 'class' => 'btn-direction']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('value', ['asc' => $this->BcBaser->getImg('admin/blt_list_down.png', ['alt' => __d('baser', '昇順'), 'title' => __d('baser', '昇順')]) . ' 値', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', ['alt' => __d('baser', '降順'), 'title' => __d('baser', '降順')]) . ' 値'], ['escape' => false, 'class' => 'btn-direction']) ?></th>
		<th class="bca-table-listup__thead-th"><?php echo $this->Paginator->sort('modified', ['asc' => $this->BcBaser->getImg('admin/blt_list_down.png', ['alt' => __d('baser', '昇順'), 'title' => __d('baser', '昇順')]) . __d('baser', '更新日時'), 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', ['alt' => __d('baser', '降順'), 'title' => __d('baser', '降順')]) . __d('baser', '更新日時')], ['escape' => false, 'class' => 'btn-direction']) ?></th>
	<?php endif;?>
	</tr>
</thead>
<tbody>
	<?php if ($AddConfigData): ?>
		<?php $count = 0; ?>
		<?php foreach ($AddConfigData as $data): ?>
			<?php $this->BcBaser->element('addConfigs/index_row', array('data' => $data, 'count' => $count)) ?>
			<?php $count++; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<tr><td colspan="5" class="bca-table-listup__tbody-td"><p class="no-data"><?php echo __d('baser', 'データが見つかりませんでした。')?></p></td></tr>
<?php endif ?>
</tbody>
</table>

<!-- list-num -->
<?php $this->BcBaser->element('list_num') ?>
