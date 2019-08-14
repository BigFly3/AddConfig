<?php
/**
 * [ADMIN] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 * 
 * BcForm->prefTagのラッパー
 * デフォルトは ID ⇒ 県名
 * $options['convertKey'] = trueをセットすると 県名⇒県名 
 */
?>
<?php if(!empty($name)):?>
<?php 
unset($options['type']);
unset($options['element']);
$options['class'] = 'bca-select__select';

$selected = isset($options['selected']) ? $options['selected'] : null; 
unset($options['selected']);
$convertKey = isset($options['convertKey']) ? $options['convertKey'] : false; 
unset($options['convertKey']);
?>

<div class="bca-select">
<?php echo $this->BcForm->prefTag($name, $selected, $options, $convertKey);?>
</div>
<?php endif;?>