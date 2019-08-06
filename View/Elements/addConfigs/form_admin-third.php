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
<?php if(!empty($formConfig['title'])):?>
<section class="bca-section addConfigItem" data-bca-section-type="form-group" id="addConfigSection<?php echo $index?>">
  <?php if(!empty($formConfig['titleBefore'])) echo '<div class="table-title-before">'.$formConfig['titleBefore'].'</div>'; //アコーディオン 見出し前領域 アコーディオンに含まれません?>
  <div class="bca-collapse__action">
    <button type="button" class="bca-collapse__btn" data-bca-collapse="collapse" data-bca-target="#<?php echo 'addConfigContent' . $index;?>" aria-expanded="false" aria-controls="<?php echo 'addConfigContent' . $index;?>"><?php echo $formConfig['title']; //アコーディオン見出し ?>&nbsp;&nbsp;<i class="bca-icon--desc bca-collapse__btn-icon"></i></button>
  </div>
  <div id="<?php echo 'addConfigContent' . $index;?>" class="bca-collapse">
    <?php if(!empty($formConfig['titleAfter'])) echo '<div class="table-title-after">'.$formConfig['titleAfter'].'</div>';//アコーディオン 見出し後領域 ?>
    <?php if(!empty($formConfig['fields'])):?>
      <table cellpadding="0" cellspacing="0" class="form-table bca-form-table">
      <?php foreach($formConfig['fields'] as $key => $value):?>
        <tr>
          <th class="col-head bca-form-table__label">
              <?php if(!empty($value['labelBefore'])) echo '<div class="label-before">'.$value['labelBefore'].'</div>'; //フォーム項目前 領域?>
              <?php echo $value['label'];//フォーム項目?><?php if(!empty($value['required'])) echo '<span class="required bca-label" data-bca-label-type="required">必須</span>'; //必須マーク表示?>
              <?php if(!empty($value['labelAfter'])) echo '<div class="label-after">'.$value['labelAfter'].'</div>'; //フォーム項目後 領域?>
          </th>
          <td class="col-input bca-form-table__input">
            <?php if(!empty($value['inputBefore'])) echo '<div class="input-before">'.$value['inputBefore'].'</div>';?>
            <span class="form-parts clearfix">
              <?php if($value['parts']['type'] == 'element')://element読み込み?>
                <?php if(!empty($value['parts']['file']) && $this->elementExists("formparts/".$value['parts']['file'])){
                  echo $this->element("AddConfig.formparts/".$value['parts']['file'],["name"=> $key , "options" => $value['parts']]);
                }?>
              <?php elseif($value['parts']['type'] == 'upload')://アップロードの場合?>
                <span class="upload-file">
                  <?php echo $this->BcForm->hidden('AddConfig.'. $key ,["class" => "upload-file-path"]);?>
                  <input type="button" value="ファイルを選択" class="upload-file-open">
                  <span class="upload-file-delete"<?php if(empty($this->request->data['AddConfig'][$key])):?> style="display:none"<?php endif;?>>× このファイルを使用しない</span>
                  <div class="upload-select-file"></div>
                </span>
              <?php else: // BcForm->inputで作成できるフォームパーツ ?>
                  <?php if($value['parts']['type'] == 'editor'){ //エディタの場合は設定を追加
                    $value['parts'] = array_merge([
                    'editor' => @$siteConfig['editor'],
                    'editorWidth' => 'auto',
                    //'editorHeight' => '480px',
                    'editorEnterBr' => @$siteConfig['editor_enter_br']
                    ], $value['parts']);
                  }
                  echo $this->BcForm->input('AddConfig.' . $key, $value['parts']);?>
              <?php endif;?>
              <?php if(!empty($value['help'])): //ヘルプアイコン表示?>
                <i class="bca-icon--question-circle btn help bca-help"></i>
                <span class="helptext"><?php echo $value['help'];?></span>
              <?php endif;?>
            </span>
            <?php echo $this->BcForm->error('AddConfig.' . $key);//エラー表示 ?>
            <?php if(!empty($value['inputAfter'])) echo '<div class="input-after">'.$value['inputAfter'].'</div>';//フォーム後の説明などを入れる領域?>
          </td>
        </tr>
      <?php endforeach;?>
      </table>
    <?php else:?>
      <p>フォーム項目が作成されていません</p>
    <?php endif;?>
  </div>
  <?php if(!empty($formConfig['tableAfter'])) echo '<div class="table-after">'.$formConfig['tableAfter'].'</div>'; //テーブルの後の領域　アコーディオンに含まれません。 ?>
</section>
<?php endif;?>
