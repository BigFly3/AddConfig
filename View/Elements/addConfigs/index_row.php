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
 * [ADMIN] 登録項目一覧　行
 * @var BcAppView $this
 */
?>


<tr id="Row<?php echo $count + 1 ?>">
	<td class="bca-table-listup__tbody-td bca-table-listup__tbody-td--select">
		<?php if ($this->BcBaser->isAdminUser()): ?>
			<?php if($isNewThemeAdmin):?>
			<?php echo $this->BcForm->checkbox('ListTool.batch_targets.' . $data['AddConfig']['id'], array('type' => 'checkbox', 'label'=> '<span class="bca-visually-hidden">' . __d('baser', 'チェックする') . '</span>', 'class' => 'batch-targets bca-checkbox__input', 'value' => $data['AddConfig']['id'])) ?>
			<?php else:?>
				<?php echo $this->BcForm->checkbox('ListTool.batch_targets.' . $data['AddConfig']['id'], array('type' => 'checkbox', 'class' => 'batch-targets bca-checkbox__input', 'value' => $data['AddConfig']['id'])) ?>
				<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_edit.png', array('alt' => __d('baser', '編集'), 'class' => 'btn')), ['action' => 'edit', $data['AddConfig']['id']], ['title' => '編集','class' => 'btn-edit']) ?>
				<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_delete.png', array('alt' => __d('baser', '削除'), 'class' => 'btn')), ['action' => 'ajax_delete', $data['AddConfig']['id']], ['title' => __d('baser', '削除'), 'class' => 'btn-delete']) ?>
			<?php endif ?>
		<?php endif ?>
	</td>
	<td class="bca-table-listup__tbody-td"><?php echo $data['AddConfig']['id'] ?></td>
	<td class="bca-table-listup__tbody-td"><?php echo $data['AddConfig']['name'] ?></td>
	<td class="bca-table-listup__tbody-td"><?php echo $data['AddConfig']['value'] ?></td>
	<td class="bca-table-listup__tbody-td"><?php echo date('Y/m/d H:i', strtotime($data['AddConfig']['modified'])) ?></td>
	<?php if($isNewThemeAdmin):?>
	<td class="row-tools bca-table-listup__tbody-td bca-table-listup__tbody-td--actions">
		<?php if ($this->BcBaser->isAdminUser()): ?>
			<?php $this->BcBaser->link('', ['action' => 'edit', $data['AddConfig']['id']], ['title' => 'フィールドグループを編集','class' => 'btn-setting bca-btn-icon' ,'data-bca-btn-type'=>'edit','data-bca-btn-size'=>'lg']) ?>
			<?php $this->BcBaser->link('', ['action' => 'ajax_delete', $data['AddConfig']['id']], ['title' => '削除','class' => 'btn-delete bca-btn-icon' ,'data-bca-btn-type'=>'delete','data-bca-btn-size'=>'lg']) ?>
		<?php endif ?>
	</td>
	<?php endif; ?>
</tr>
