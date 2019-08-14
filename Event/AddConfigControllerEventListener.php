<?php
/**
 * [ControllerEventListener] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

class AddConfigControllerEventListener extends BcControllerEventListener {
    public $events = [
        'startup',
        'beforeRender'
    ];

    public function startup(CakeEvent $event) {
        $Ctrl = $event->subject();
        $Ctrl->helpers[] = 'AddConfig.AddConfig';

        //タイトル名をconfigから設定できるようにしたいのでここで追加する。
        $contents = Configure::read('BcApp.adminNavigation.Contents');
        $navititle = !empty(Configure::read('AddConfig.name')) ? Configure::read('AddConfig.name') : 'オリジナル設定';
        $contents['AddConfig'] = [
            'title' => $navititle,
            'type' => 'add_config',
            'icon' => 'bca-icon--setting',
            'url' => ['admin' => true, 'plugin' => 'add_config', 'controller' => 'add_configs', 'action' => 'form']
        ];
        if(BcUtil::isAdminUser()){
            $contents['AddConfig']['menus']= [
                'AddConfigForm' => ['title' => '編集' , 'url' => ['admin' => true, 'plugin' => 'add_config', 'controller' => 'add_configs', 'action' => 'form']],
                'AddConfigList' => ['title' => '登録一覧', 'url' => ['admin' => true, 'plugin' => 'add_config', 'controller' => 'add_configs', 'action' => 'index']],
            ];
        }
        Configure::write('BcApp.adminNavigation.Contents',$contents);

        if($Ctrl->name !== 'AddConfig'){
            try {
                $AddConfig = ClassRegistry::init('AddConfig');
                $addConfigs = $AddConfig->findExpanded();
                $Ctrl->addConfigs = $addConfigs;
            } catch (Exception $ex) {
				$Ctrl->addConfigs = [];
			}                
        }
    }
    public function beforeRender(CakeEvent $event) {
        $Ctrl = $event->subject();
        if($Ctrl->name !== 'AddConfig'){
            $Ctrl->set('addConfig', $Ctrl->addConfigs);
        }
    }
}