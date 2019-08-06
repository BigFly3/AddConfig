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
 * [管理画面] オリジナル設定 フォーム
 * @var BcAppView $this
 */
?>
<?php if(!empty($formConfigs)):?>

<?php echo $this->BcForm->create('AddConfig', ['url' => ['action' => 'form']]) ?>
<?php echo $this->BcFormTable->dispatchBefore() ?>
<?php echo $this->BcForm->hidden('AddConfig.id') ?>

  <?php if(isset($addConfigDebug)):// リロードした際フォーム項目が変わっても登録されないようにするためのフラグ?>
  <h3>入力確認モード　※登録不可、入力チェック可</h3>
  <input type="hidden" name="AddConfigDebug" value="1">
  <?php endif;?>
  <?php foreach($formConfigs as $index => $formConfig):?>
    <?php if($isNewThemeAdmin): //新テーマのフォームテンプレート?>
      <?php echo $this->element('addConfigs/form_admin-third',['formConfig' => $formConfig ,'index' => str_pad($index + 1, 2 , "0" , STR_PAD_LEFT)]) ;?>
    <?php else: //旧テーマのフォームテンプレート?>
      <?php echo $this->element('addConfigs/form_normal',['formConfig' => $formConfig ,'index' => str_pad($index + 1, 2 , "0" , STR_PAD_LEFT)]) ;?>
    <?php endif ?>
  <?php endforeach;?>

  <?php //アップロード用
    $this->BcBaser->css('/uploader/css/uploader',false);
    $this->BcBaser->css('AddConfig.admin/style.css',false);
    $this->BcBaser->js('/js/admin/vendors/jquery.upload-1.0.0.min',false);
    $this->BcBaser->js('AddConfig.admin/common.js',false);
  ?>
  <script>$(function(){$("a[rel=AddConfig]").colorbox();});</script>
  <div id="modalView"><div id="modalViewResult"></div></div>

<?php if($isNewThemeAdmin): //新テーマのフォームテンプレート?>
<script>
  $(function(){
    //エラーが存在しているのアコーディオンを開く
    $('.addConfigItem.bca-section').each(function(){
      if($(this).find('.error-message').length > 0){
        $(this).find('.bca-collapse__btn').attr('data-bca-state','open');
        $(this).find('.bca-collapse').show().attr('data-bca-state','open');
      }
    })
  })
</script>
<?php endif ?>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<div class="submit bca-actions">
<?php echo $this->BcForm->submit(__d('baser', '保存'), ['div' => false, 'class' => 'button bca-btn', 'id' => 'BtnSave', 'data-bca-btn-type'=>'save', 'data-bca-btn-size'=>'lg', 'data-bca-btn-width'=>'lg']) ?>
</div>

<?php echo $this->BcForm->end() ?>

<?php else: ?>
	<p>フォーム項目が作成されていません。<br>AddConfig/Config/settings.phpにformを設定してください。</p>
<?php endif ?>