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
<?php if(!empty($name) && count($options['options']) > 0 ):?>

<div id="SelectText<?php echo ucfirst($name); ?>_">
<?php foreach($options['options'] as $key => $value):?>
    <div class="bca-checkbox">
    <input type="checkbox" name="<?php echo "{$name}{$key}"?>" value="<?php echo $key?>" id="<?php echo "SelectText".ucfirst($name).$key; ?>" class="bca-checkbox__input">&nbsp;<label for="SelectText<?php echo ucfirst($name); ?><?php echo $key?>" class="bca-checkbox-label"><?php echo $value?></label>
    </div>
<?php endforeach;?>
</div>
<?php echo $this->BcForm->hidden("AddConfig.{$name}",['id' => "SelectText".ucfirst($name) ]);?>

<script>
$(document).ready(function() {
    var aryValue = $("#SelectText<?php echo ucfirst($name); ?>").val().replace(/\'/g,"").split(",");
    for(key in aryValue){
        var value = aryValue[key];
        $("#"+camelize("SelectText<?php echo ucfirst($name); ?>_"+value)).prop('checked',true);
    }
    $("#SelectText<?php echo ucfirst($name); ?>_ input[type=checkbox]").change(function(){
        var aryValue = [];
        $("#SelectText<?php echo ucfirst($name); ?>_ input[type=checkbox]").each(function(key,value){
            if($(this).prop('checked')){
                aryValue.push("'"+$(this).val()+"'");
            }
        });
        $("#SelectText<?php echo ucfirst($name); ?>").val(aryValue.join(','));
    });
});
</script>
<?php endif;?>