<?php
/**
 * [Model] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

/**
 * システム設定モデル
 *
 * @package Baser.Model
 */
class AddConfig extends AppModel {

/**
 * ビヘイビア
 * 
 * @var array
 */
	public $actsAs = ['BcCache'];

/**
 * プラグイン名
 *
 * @var		string
 * @access 	public
 */
public $plugin = 'AppConfig';


/**
 * AddConfig constructor.
 *
 * @param bool $id
 * @param null $table
 * @param null $ds
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->validate = [];
	}
	

/**
 * 指定したフィールドの値がDBのデータと比較して変更状態か確認
 * 
 * @param string $field フィールド名
 * @param string $value 値
 * @return bool
 */
	public function isChange($field, $value) {
		$addConfig = $this->findExpanded();
		if(isset($addConfig[$field])) {
			return !($addConfig[$field] === $value);
		} else {
			return false;
		}
	}


/**
 * 登録するキーが別IDのキーに存在しないかどうか
 * 
 * @param string $field フィールド名
 * @param string $value 値
 * @return bool
 */
	public function isUniqueKey($check,$id) {
		$ret = $this->find('count',['conditions' => 
			[
				'NOT' => [
					'id' => $id,
					'name' => key($check)
				],
				'AND' => [
					'name' => $check
				]
			]
		]);
		return $ret > 0 ? false : true;
	}

}
