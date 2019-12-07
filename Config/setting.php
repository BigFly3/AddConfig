<?php
/**
 * [Config] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

/**
 * サイドナビや見出しで表示する名称
 */
$config['AddConfig']['name'] = ''; //デフォルトは【オリジナル設定】 インストール時はsample-form.phpの中で【サンプル入力フォーム】と設定されています。

/**
 * admin-thirdテーマの初期表示を強制的に全部開くかどうか
 */
$config['AddConfig']['accordAllOpen'] = true; //falseだとエラーがあった部分のみ開きます。

/**
 * フォーム用セッティング
 */
$config['AddConfig']['debug'] = false; //trueにしておくとフォーム項目のテスト中にデータ更新が出来ないようにすることができます。バリデーションチェックは可能です。

/**
 * インストール直後のフォームサンプル
 * sample-form.phpの中で$config['AddConfigDebug'] = true;がセットされています。
 */
include "sample-form.php"; //使用時にコメントアウトするか削除してください。

/* テンプレート　記述の仕方はsample-form.phpを参考にしてください。
$config['AddConfig']['form'][] = [ 
    'titleBefore' => '', 
    'title' => '', //アコーディオン・見出し
    'titleAfter' => '', 
    'fields' => [
        'キー名' => [  //フォームのname
            'required' => false, //必須マークを表示したい場合につける
            'labelBefore' => '',
            'label' => '',
            'labelAfter' => '',
            'inputBefore' => '',
            'inputAfter' => '',
            'parts' => [ //フォームタイプ
                'type' => '', 
            ],
            'validate' => [  //バリデーションルール　必要な場合のみ追加
            ],
            'help' => '' //ヘルプテキスト
        ],
    ]
];
*/
