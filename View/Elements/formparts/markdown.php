<?php
/**
 * [ADMIN] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */
?>
<?php if(!empty($name)):?>

<div class="bca-textarea">
<?php echo $this->BcForm->input( $name , ['type' => 'textarea', 'rows' => 8, 'rows' => 40 ,'id'=>"md-editor-{$name}"]) ?>
<?php
$this->BcBaser->css('AddConfig.admin/simplemde.min', ['inline' => false]);
$this->BcBaser->js('AddConfig.admin/vendors/simplemde.min', false);
?>
<script>
$(function(){
    var simplemde_<?php echo $name?> = new SimpleMDE({
        element:document.getElementById('<?php echo "md-editor-{$name}" ?>'),
        forceSync: true,
        autofocus:true,
    });
});
</script>
</div>
<?php endif;?>