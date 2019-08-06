<?php
/**
 * [Controller] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

/**
 * オリジナル設定コントローラー
 *
 * @package Baser.Controller
 * @property BcManagerComponent $BcManager
 * @property AddConfig $AddConfig
 * @property CakeRequest $request
 */
class AddConfigsController extends AppController {

/**
 * クラス名
 *
 * @var string
 */
	public $name = 'AddConfigs';

/**
 * モデル
 *
 * @var array
 */
	public $uses = ['AddConfig'];

/**
 * コンポーネント
 *
 * @var array
 */
	public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure', 'BcManager'];

/**
 * サブメニューエレメント
 *
 * @var array
 */
	public $subMenuElements = [];

/**
 * ヘルパー
 * @var array
 */
	public $helpers = ['BcForm'];

/**
 * コンテンツタイトル
 * @var array
 */
public $contentName = 'オリジナル設定';

/**
 * beforeFilter
 */
	public function beforeFilter() {
		$this->BcAuth->allow('jquery_base_url');
		parent::beforeFilter();
		$this->crumbs = [['name' => $this->contentName, 'url' => ['plugin' => 'add_config', 'controller' => 'add_configs', 'action' => 'form']]];

		//新管理画面テーマの対応
		$isNewThemeAdmin = isset($this->siteConfigs['admin_theme']) && $this->siteConfigs['admin_theme'] === 'admin-third';
		$this->set('isNewThemeAdmin',$isNewThemeAdmin);
	}

/**
 * [ADMIN] 設定フォーム
 */
	public function admin_form() {
		$contentName = Configure::read('AddConfig.name');
		if($contentName)
			$this->contentName = $contentName;	//名称変更
		$isDebug = Configure::read('AddConfig.debug');
		if($isDebug) 
			$this->set('addConfigDebug', 1 );	//登録不可、デバッグ可

		$formConfigs = Configure::read('AddConfig.form');
		if(!empty($formConfigs)){
			foreach($formConfigs as $index => $formConfig){
				if(!empty($formConfig['fields'])){
					foreach($formConfig['fields'] as $key => $value){
						//挙動がおかしくなる可能性があるフォームタイプは除外
						if(empty($value['parts']['type']) || in_array($value['parts']['type'],['create','end','submit','button','hidden','label'])){
							$this->setMessage( '使用不可のフォームを無効にしました。', true);
							unset($formConfigs[$index]['fields'][$key]);
							break;
						}
						if(!empty($value['validate'])){
							$this->AddConfig->validate[$key] = $value['validate'];
							unset($formConfigs[$index]['fields'][$key]['validate']);
						}
					}
				}
			}
			$this->set('formConfigs', $formConfigs );
			if (empty($this->request->data)) {
				$this->request->data['AddConfig'] = $this->AddConfig->findExpanded();
			} else {
				$this->AddConfig->set($this->request->data);
				if (!$this->AddConfig->validates()) {
					$this->setMessage(__d('baser', '入力エラーです。内容を修正してください。'), true);
				} else if($isDebug || isset($this->request->data["AddConfigDebug"])){
					//強制的にバリデーションエラーにする
					$this->AddConfig->invalidate('AddConfigDebug');
					$this->setMessage('入力チェックはOKです。AddConfigの設定で更新されないようになっています。', true);
				} else {
					unset($this->request->data['AddConfig']['id']);
					$dataSource = $this->AddConfig->getDataSource();
					$dataSource->begin();
					try{
						// DBに保存
						if ($this->AddConfig->saveKeyValue($this->request->data)) {
							$dataSource->commit();
							$this->setMessage(__d('baser', 'システム設定を保存しました。'));
							$this->redirect(['action' => 'form']);
						}
					} catch (Exception $ex) {
						$dataSource->rollback();
						$this->setMessage('データに問題があるため登録をキャンセルしました');
					}
				}
			}

			$baseUrl = str_replace('/index.php', '', BC_BASE_URL);
			$this->set(compact(
				'baseUrl'
			));
			$this->pageTitle = $this->contentName;
		}
	}

	
/**
 * [ADMIN] 設定フォーム
 */
	public function admin_index() {
		$default = array('named' => array('num' => $this->siteConfigs['admin_list_num']));
		$this->setViewConditions('AddConfig', array('default' => $default));
		$this->paginate = array(
			'fields' => array(),
			'order' => 'AddConfig.id ASC',
			'limit' => $this->passedArgs['num']
		);
		$AddConfigData = $this->paginate('AddConfig');
		$this->set(compact(
			'AddConfigData'
		));
		$this->pageTitle = $this->contentName . '｜登録一覧';
	}

/**
 * [ADMIN] 設定一括削除
 *
 * @param int $ids
 * @return true
 */
	protected function _batch_del($ids) {
		if ($ids) {
			foreach ($ids as $id) {
				$this->_del($id);
			}
		}
		return true;
	}

/**
* [ADMIN] 項目削除　(ajax)
*
* @param int $id
* @return void
*/
	public function admin_ajax_delete($id = null) {
		$this->_checkSubmitToken();
		if (!$id) {
			$this->ajaxError(500, __d('baser', '無効な処理です。'));
		}
		if ($this->_del($id)) {
			exit(true);
		} else {
			exit();
		}
	}

/**
* 項目削除
*
* @param int $id
* @return boolean
*/
	protected function _del($id = null) {
		if ($this->AddConfig->delete($id)) {
			return true;
		} else {
			return false;
		}
	}

}
