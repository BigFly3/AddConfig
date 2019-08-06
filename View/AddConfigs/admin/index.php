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
 * [管理画面] オリジナル設定 一覧
 * @var BcAppView $this
 */

$this->BcBaser->js(array(
	'admin/libs/jquery.baser_ajax_data_list',
	'admin/libs/jquery.baser_ajax_batch',
	'admin/libs/baser_ajax_data_list_config',
	'admin/libs/baser_ajax_batch_config'
));
?>
<script type="text/javascript">
$(function(){
	$.baserAjaxDataList.init();
	$.baserAjaxBatch.init({ url: $("#AjaxBatchUrl").html()});
});
</script>

<div id="AjaxBatchUrl" style="display:none"><?php $this->BcBaser->url(['controller' => 'add_configs', 'action' => 'ajax_batch']) ?></div>
<div id="AlertMessage" class="message" style="display:none"></div>
<div id="MessageBox" style="display:none"><div id="flashMessage" class="notice-message"></div></div>
<div id="DataList"><?php $this->BcBaser->element('addConfigs/index_list') ?></div>