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
 * [管理画面] オリジナル設定 編集
 * @var BcAppView $this
 */

?>

<?php if($this->request->data): ?>

<?php echo $this->BcForm->create('AddConfig', array('url' => array('action' => 'edit'))) ?>
<?php echo $this->BcForm->input('AddConfig.id', array('type' => 'hidden')) ?>

<table cellpadding="0" cellspacing="0" class="form-table bca-form-table section">
	<tr>
		<th class="col-head bca-form-table__label"><?php echo $this->BcForm->label('AddConfig.id', 'NO') ?></th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->value('AddConfig.id') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head bca-form-table__label">
			<?php echo $this->BcForm->label('AddConfig.name', 'フィールド名') ?>
		</th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->input('AddConfig.name',['type' => 'text','size' => 70]) ?>
			<?php echo $this->BcForm->error('AddConfig.name') ?>
		</td>
	</tr>
	<tr>
		<th class="col-head bca-form-table__label">
			<?php echo $this->BcForm->label('AddConfig.form_place', '設定値') ?>
		</th>
		<td class="col-input bca-form-table__input">
			<?php echo $this->BcForm->input('AddConfig.value',['type' => 'textarea','size' => 10]) ?>
			<?php echo $this->BcForm->error('AddConfig.value') ?>
		</td>
	</tr>
</table>
<div class="submit bca-actions">
	<span class="bca-actions__main">
	<?php if($isNewThemeAdmin):
		$this->BcBaser->link('一覧に戻る',['action' => 'index'],
		['class' => 'btn-gray button bca-btn bca-actions__item', 'data-bca-btn-size' => 'sm', 'data-bca-btn-type' => 'back-to-list'],false);
	endif; ?>
	<?php echo $this->BcForm->submit('保　存', array('div' => false, 'class' => 'button btn-red bca-btn bca-actions__item', 'id' => 'BtnSave' ,'data-bca-btn-type' => 'save', 'data-bca-btn-size'=>'lg','data-bca-btn-width'=>'lg')) ?>
	</span>
</div>

<?php else: ?>
<table cellpadding="0" cellspacing="0" class="form-table bca-form-table section">
	<tr>
		<td>データが存在しません。</td>
	</tr>
</table>
<div class="submit bca-actions">
	<span class="bca-actions__main">
	<?php if($isNewThemeAdmin):
		$this->BcBaser->link('一覧に戻る',['action' => 'index'],
		['class' => 'btn-gray button bca-btn bca-actions__item', 'data-bca-btn-size' => 'sm', 'data-bca-btn-type' => 'back-to-list'],false);
	endif; ?>
	</span>
</div>
<?php endif; ?>
