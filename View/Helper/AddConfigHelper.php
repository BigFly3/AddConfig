<?php
/**
 * [Helper] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 * 
 * $addConfigに登録したデータを出力するためのヘルパー
 * 出力時はデフォルトでエスケープを設定している
 * 出力に使用するデータは$addConfigそのものではなく、内部にセットした$_setDataを使用。初期値は$addConfig
 * setData($array)を使って$siteConfigなどの別の変数をセットしてヘルパーを使用することも可能
 * setData() 引数を未設定で呼ぶと$addConfigを再度セットしなおす
 */

class AddConfigHelper extends AppHelper {
    public $helpers = ['BcBaser'];
    protected $_setData = [];

    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
        $this->_setData = $this->_View->get('addConfig');
    }

    /**
     * keyデータのセット
     * @params string $key セットするキー
     * @params string | array $value セットするデータ
     * @access public
     * 
     * 元データにないものもセット可能。setData()実行時に全てリセットされる
     */
    public function set($key = "",$value = "") {
        $data = $this->getData();
        $data[$key] = $value;
        $this->_setData = $data;
    }

    /**
     * keyデータの取得
     * @params string $key 取得するキー
     * @return string | array 取得データ
     * @access public
     */
    public function get($key = "") {
        $data = $this->getData();
        return isset($data[$key]) ? $data[$key] : false ;
    }

    /**
     * 指定文字列が先方一致しているキーを配列で取得
     * @params string $prefix
     * @params boolean $drop_prefix  キー名のprefix部分を消し込むかどうか
     * @return array 取得データ
     * @access public
     * 
     * $keyがsmtp_ならsmtp_XXXXがマッチ
     * $drop_prefixがtrueならsmtp_hostがhostになる
     */
    public function getPrefixFilter($prefix = "",$drop_prefix = false) {
        $filterArray = [];
        $data = $this->getData();
        foreach( $data as $k=>$v ) {
            if ( strpos( $k, $prefix ) === 0 ) {
                if ( $drop_prefix ) {
                    $k = substr( $k, strlen( $prefix ) );
                }
                $filterArray[ $k ] = $v;
            }
        }
        return $filterArray;
    }

    /**
     * 指定したキーのみの配列を取得
     * @params array $keys [key1,key2,key3,...]
     * @return array キーにマッチした配列
     * @access public
     */
    public function getKeysFilter($keys) {
        $baseArray = $this->getData();
        if(!is_array($baseArray)) $baseArray = [];
        $filterArray = array_intersect_key($baseArray, array_flip($keys));
        return $filterArray;
    }


    /**
     * ループ内や$siteConfigなどの他データをヘルパーで利用するためのセットメソッド
     * @params array $data 
     * @access public
     * 
     * ヘルパーを利用したいデータをセットする。引数がない場合は$addConfigの内容にリセットされる
     */
    public function setData($data = []) {
        $this->_setData = !empty($data) && is_array($data) ? $data : $this->_View->get('addConfig');
    }

    /**
     * ヘルパー内部で保持しているデータの取得
     * @params array $data 
     * @access public
     * 
     * setData()で設定したデータ。初期値は$addConfig
     */
    public function getData() {
        $data = $this->_setData;
        if(!is_array($data)) $data = [];
        return $data;
    }

    /**
     * 出力用メソッド（デフォルトはエスケープする）
     * @params string $key 出力するキー
     * @params bool $escape エスケープするかどうか
     * @access public
     * 
     * 配列データの場合何もしない。
     */
    public function field($key = "",$escape = true) {
        $text = $this->get($key);
        if($text && is_string($text)){
            echo $escape ? h($text):$text;
        }
    }
    //fieldのラッパー
    public function f($key = "",$escape = true) {
        $this->field($key,$escape);
    }

    /**
     * 出力用メソッド（デフォルトはエスケープする）
     * @params string $key 出力するキー
     * @params bool $escape エスケープするかどうか
     * @access public
     * 
     * 配列データの場合何もしない。
     * エスケープ時は、エスケープした後改行コードを<br>に変換する。
     */
    public function brfield($key = "",$escape = true) {
        $text = $this->get($key);
        if($text && is_string($text)){
            echo nl2br($escape ? h($text):$text);
        }
    }
    //brfieldのラッパー
    public function brf($key = "",$escape = true) {
        $this->brfield($key,$escape);
    }



    /**
     * キーの値があるかどうか
     * @params string $key チェックするキー
     * @return bool
     * @access public
     */
    public function is($key){
        return $this->get($key);
    }

    /**
     * select-text配列の中にチェックする値があるかどうか
     * @params string $key select-textで登録したキー
     * @params string $needle チェックする文字列
     * @return bool
     * @access public
     */
    public function in($key,$needle){
        $array = $this->explodeArray($key);
        if(is_array($array)){
            return in_array($needle,$array);
        }
        return false;
    }

    /**
     * select-textで登録したデータ '1','2','3' の配列化
     * @params string $key select-textで登録したキー
     * @return bool
     * @access public
     * 
     * 普通にexplodeしただけだと、データに関係ないクォートが残ってしまうのでヘルパーを利用する
     * ※select-textで登録したデータは、value値にシングルクォートとカンマあった場合ACQUOTE、ACCOMMAに変換されています。
     */
    public function explodeArray($key){
        $array = explode(',',$this->get($key));
        foreach($array as $key => $value){
            $value = trim($value,'\'');
            $value = str_replace('ACQUOTE','\'',$value);
            $array[$key] = str_replace('ACCOMMA',',',$value);
        }
        return $array;
    }

    /**
     * upload用画像出力メソッド
     * @params string $key 出力するキー
     * @params array $options baser->imgのオプション + noimage => オリジナル画像のパス or true(baserCMSのnoimage) 
     * @access public
     */
    public function img($key,$options = []){
        $options = array_merge(['alt' => ''],$options);
        $url = '/' . $this->get($key);
        if($url !== ""){ //登録された画像を出す場合
            echo $this->BcBaser->img($url,$options);
        }else if(isset($options['noimage'])){ //画像登録が任意でnoimageがセットされている場合
            if(is_string($options['noimage'])){
                $url = $options['noimage'];
            }else if($options['noimage'] === true){
                $url = 'admin/noimage.png';
            }
            unset($options['noimage']);
            echo $this->BcBaser->img($url ,$options);
        }
    }
}
