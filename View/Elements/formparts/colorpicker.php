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
<?php
$this->BcBaser->css('admin/colpick', ['inline' => false]);
$this->BcBaser->js('admin/vendors/colpick', false);
$size = isset($options['size']) ? $options['size'] : 6; 
?>

<div class="bca-textbox-color">
#<?php echo $this->BcForm->input( $name , [
    'type' => 'text',
    'size' => $size, 
    'class' => 'color-picker bca-textbox__input'
]) ?>
</div>
<?php endif;?>