/**
 * [ADMIN] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */
$(function(){
  $("a[rel=f-modal]").colorbox();

  var baseUrl = $.baseUrl + '/';
  var adminPrefix = $.bcUtil.adminPrefix;
  var uploadBaseUrl = baseUrl + adminPrefix + '/uploader/uploader_files/';
  var listItemCount = 10;
  //画像サイズの埋め込み
  $.map($(".upload-file"),function(item){
    var $elem = $(item);
    var saveurl = $(item).find(".upload-file-path").val();
    if(saveurl){
      setFileInfo($elem, saveurl);
    }
  });
  //アップロードリストの表示
  $(".upload-file-open").on("click",function(e){
    $(".upload-file").removeClass("upload-file-active");
    $(e.target).closest(".upload-file").addClass("upload-file-active");
    open_upload_list();
  });
  //アップロードリストの取得
  function open_upload_list(){
    $.bcUtil.ajax( uploadBaseUrl +  "ajax_list/num:" + listItemCount , open_upload_modal , { type: 'GET'});
  }
  //モーダルの表示
  function open_upload_modal(data){
    $("#modalViewResult").html(data);
    $('#modalView').dialog({
      height: 'auto',
      width : 780,
      modal: true,
      buttons: {
        '閉じる': function() {
          $(".upload-file-active").removeClass("upload-file-active");
          return $(this).dialog('close');
        }
      }
    });
  }
  //アップロードリストのページャー切り替え
  $('#modalView').on("click","#DivPanelList .page-numbers a",function(e){
    e.preventDefault();
    var url = $(e.target).attr("href");
    $.bcUtil.ajax(url, open_upload_modal);
  });
  //ファイルをアップロード
  $('#modalView').on("change",'#UploaderFileFile',uploaderFileFileChangeHandler);

  /**
   * アップロードファイル選択時イベント
   */
  function uploaderFileFileChangeHandler(){
    var url = uploadBaseUrl + 'ajax_upload/';
    var form = $(this);
    $("#Waiting").show();
    if($('#UploaderFileFile').val()){
      $.bcToken.check(function(){
        var data = {'data[_Token][key]': $.bcToken.key};
        if($("#UploaderFileUploaderCategoryId").length) {
          data = $.extend(data, {'data[UploaderFile][uploader_category_id]':$("#UploaderFileUploaderCategoryId").val()});
        }
        form.upload(url, data, uploadSuccessHandler, 'html');
      }, {useUpdate: false, hideLoader: false});
    }
  }

  /**
   * アップロード完了後イベント
   */
  function uploadSuccessHandler(res){
    if(res){
      open_upload_list();
    }else{
      $("#Waiting").hide();
    }
    // フォームを初期化
    // セキュリティ上の関係でvalue値を直接消去する事はできないので、一旦エレメントごと削除し、
    // spanタグ内に新しく作りなおす。
    $(this).remove();
    $("#SpanUploadFile").append('<input id="UploaderFileFile'+'" type="file" value="" name="data[UploaderFile][file]" class="uploader-file-file" />');
    $('#UploaderFileFile').change(uploaderFileFileChangeHandler);
    $.bcToken.key = null;
  }

  //ファイルリストからファイル選択時
  $('#modalView').on("click",".selectable-file",function(e){
    var fileurl = $(e.target).closest(".selectable-file").find(".url").text();
    var saveurl = fileurl.replace(baseUrl ,"");
    var $activelem = $(".upload-file-active");
    $activelem.find(".upload-file-path").val(saveurl);
    $activelem.find(".upload-file-delete").show();
    setFileInfo($activelem,saveurl);
    $activelem.removeClass("upload-file-active");
    $('#modalView').dialog('close');
  });

  //選択ファイルを未選択化
  $(".upload-file-delete").on("click",function(){
    $(this).closest(".upload-file").find(".upload-select-file").empty();
    $(this).closest(".upload-file").find(".upload-file-path").val("");
    $(this).hide();
  });

  //ファイル情報をセット
  function setFileInfo($elm,saveurl){
    if(saveurl){
      var fileurl = baseUrl + saveurl;
      var extention = fileurl.split(".").pop().toLowerCase(); 
      if($.inArray(extention,["gif","png","jpg","jpeg"]) > -1){
        $("<img>").attr("src", fileurl ).bind("load", function(){
          $.colorbox.remove();
          var imgtag = '<a href="' + fileurl + '" rel="f-modal"><img src="' + fileurl + '" class="select-image"></a>';
          $elm.find(".upload-select-file").html(imgtag + '<p class="iteminfo"></p>');
          //サムネ画像の実際サイズをセットする
          $elm.find(".iteminfo").html('<span class="iteminfo-path iteminfo-image iteminfo-ext-' + extention + '">' + fileurl +  '</span><span class="iteminfo-size">( w' + this.naturalWidth + " × h" + this.naturalHeight + " )</span>");
          $("a[rel=f-modal]").colorbox();
        });
      }else{
        $elm.find(".upload-select-file").html('<p class="iteminfo"><a href="' + fileurl +  '" class="iteminfo-link" target="_blank"><span class="iteminfo-path iteminfo-file iteminfo-ext-' + extention + '">' + fileurl +  '</span></a></p>')
      }
    }
  }

  $(".color-picker").each(function() {
    var color;
    if($(this).val()) {
      $(this).css('border-right','36px solid #'+$(this).val());
      color = $(this).val();
    } else {
      color = 'ffffff';
    }
    $(this).colpick({
      layout:'hex',
      color:color,
      onSubmit:function(hsb,hex,rgb,el) {
        $(el).val(hex).css('border-right','36px solid #'+hex);
        $(el).colpickHide();
      }
    });
  });    
});

