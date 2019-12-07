<?php
/**
 * [Config] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */

$config['AddConfig']['name'] = 'サンプル入力フォーム'; //ナビやタイトルで表示する名称
$config['AddConfig']['debug'] = true; //無駄なデータが誤って登録されないようにデバッグモードにしています。

$config['AddConfig']['form'][] = [ //['form'][0],['form'][1]のようにすれば表示順番を設定することもできます。
    'titleBefore' => 'titleBeforeは見出しの前に挿入され、アコーディオンに含まれない形で表示されます。',
    'title' => '使用できるformヘルパー(input)のパーツサンプル',
    'titleAfter' => '$addConfigに登録出来るものは、単一の値のみなので、配列データになってしまうマルチチェックボックスなどは使えません。<br>複数選択を使いたい場合はformpartsにあるselect-txtなどを使ってください。' ,
    'tableAfter' => 'テーブルの後に表示できる領域です。' ,
    'fields' => [
        'text01' => [ //フォームのnameになります 既存のconfig名と被らないよう注意する
            'required' => true, //フォームに必須項目のマークをつける 
            'label' => 'テキストフォーム', //テーブルの項目
            'inputAfter' => '"counter"=>trueを指定すると文字数がカウントできます。<br>maxlengthが指定されていると最大文字数も表示されます。<br>idが指定されているとカウンターの表示ができないみたいです。',
            'parts' => [
                'type' => 'text',
                'size'=>'55',
                'placeholder' => '例: 090-1111-1111',
                'counter' => true,
                'maxlength' => 20
            ],
            'validate' => [
                [
                    'rule' => 'notBlank',
                    'message' => '入力してください'
                ],
            ],
        ],
        'textarea01' => [
            'required' => true, //フォームに必須項目のマークをつける 
            'label' => 'テキストエリア',
            'labelAfter' => '必須マークはvalidateと紐づいていません。<br>"required"=>"true"をつけてください。',
            'parts' => [
                'type' => 'textarea',
                'rows' => '5',
                'cols' => '60',
                'counter' => true,
                //'maxlength' => 255,
                'placeholder' => '例: 渋谷区渋谷１－１－１ ○○ビル５階',
            ],
            'validate' => [
                [
                    'rule' => 'notBlank',
                    'message' => '入力してください'
                ],
                [
                    'rule' => ['maxLength', 255],
                    'message' => '255文字以内で入力してください'
                ],
            ],
        ],
        'select01' => [
            'label' => 'セレクト',
            'parts' => [
                'type' => 'select',
                //'default' => 'value03',　//デフォルトで選択する場合
                'empty' => "選択してください", //空要素
                'options' => [
                    'value01' => '選択１',
                    'value02' => '選択２',
                    'value03' => '選択３',
                    'value04' => '選択４'
                ],
            ],
            'validate' => [
                [
                    'rule' => ['notBlank'],
                    'message' => '選択してください'
                ],
            ],
        ],
        'radio01' => [
            'label' => 'ラジオ',
            'parts' => [
                'type' => 'radio',
                'default' => 'value04',
                'options' => [
                    'value01' => '選択１',
                    'value02' => '選択２',
                    'value03' => '選択３',
                    'value04' => '選択４'
                ],
            ],
        ],
        'checkbox01' => [
            'label' => '単一チェックボックス',
            'labelAfter' => '※複数選択チェックはできない',
            'parts' => [
                'type' => 'checkbox',
                'label' => 'メルマガ配信を希望します',
                'style' => 'padding:5px;height:auto;',
                'hidden' => false
            ],
            'inputAfter' => 'ヘルパーのデフォルトだと未選択はvalue=0のhiddenが埋め込まれています。<br>必要ない場合はhidden=>falseを入れる必要があります。',
        ],
        'file01' => [
            'label' => 'ファイル',
            'inputAfter' => 'ファイルを選択するとファイル名が登録されるますが、画像はアップロードされないのでここでは基本使いません。<br>拡張して実装してある"type"=>"upload"の方を使ってください。',
            'parts' => [
                'type' => 'file',
            ],
        ],
        'editor01' => [
            'label' => 'エディタ',
            'inputBefore' => '$siteConfig["editor"]で設定しているエディタを指定できます。',
            'inputAfter' => '草稿は使用出来ません',
            'parts' => [
                'type' => 'editor',
            ],
        ],
        'datepicker01' => [
            'label' => '日付入力',
            'inputBefore' => 'BcFormで拡張されたパーツです',
            'inputAfter' => 'フォーカスをあてるとウィジェットが表示されます',
            'parts' => [
                'type' => 'datepicker',
            ],
            'validate' => [
                [
                    'rule' => '/^\d{4}\/\d{2}\/\d{2}$/',
                    'message' => '日付フォーマットが正しくありません'
                ],
            ],
        ],
        'dateTimePicker01' => [
            'label' => '日付時刻入力',
            'inputBefore' => 'BcFormで拡張されたパーツです',
            'inputAfter' => 'フォーカスをあてるとウィジェットが表示されます<br>このフォームは日付/時刻/日時のそれぞれ3パターンのデータが保存されるみたいです。',
            'parts' => [
                'type' => 'dateTimePicker',
            ],
        ],
    ]
];

$config['AddConfig']['form'][] = [ 
    'title' => '拡張系のフォームパーツ',
    'tableAfter' => 'ここに表示しているフォームパーツは/AddConfig/Config/sample-form.phpの設定で作成されたものです。' ,
    'fields' => [
        'upload01' => [
            'label' => 'アップロード',
            'inputBefore' => 'baserCMSのアップロード機能を使ってアップロードできます。',
            'inputAfter' => '既存で登録されているファイルを選択することもできます。<br>',
            'parts' => [
                'type' => 'upload',
            ],
            'help' => 'ファイル形式 gif,jpg,png<br>推奨サイズは幅1200×高さ630です。<br>削除などはアップロード管理から行ってください。'
        ],
        'multicheck01' => [
            'label' => 'マルチ選択',
            'inputBefore' => '配列系のデータを登録したいときに使います<br>\'1\',\'2\',\'3\'のような登録形式になります。',
            'inputAfter' => 'ヘルパーの$this->AddConfig->explodeArray("キー名")で配列に変換して使用してください。',
            'parts' => [
                'type' => 'element', 
                'file' => 'select-text',
                //'options' => ['1' => '山田','2' => '佐藤', '5' => '高橋','7' => '橋本']
                //'options' => ['山田','佐藤', '高橋','橋本']
                'options' => ['山田' => '山　田','佐藤' => '佐　藤', '高橋' => '高　橋','橋本' => '橋　本']
            ],
        ],
        'pref01' => [
            'label' => '都道府県',
            'inputBefore' => 'BcForm->prefTag()をaddConfigで使えるようにしたものです。',
            'inputAfter' => 'デフォルトだとoptionsは id=>県名 の形ですが、convertKey=>trueにすると 県名=>県名 になります。',
            'parts' => [
                'type' => 'element',
                'file' => 'pref',
                'convertKey' => true
            ],
        ],
        'colorpicker01' => [
            'label' => 'カラーピッカー',
            'inputBefore' => 'テーマ設定にあるカラーピッカーを移植したものです',
            'inputAfter' => '',
            'parts' => [
                'type' => 'element',
                'file' => 'colorpicker',
                'size' => 8,
            ],
        ],
        'markdown01' => [
            'label' => 'マークダウンエディタ',
            'inputBefore' => '',
            'inputAfter' => 'ヘルパーは$this->AddConfig->md("キー名")を使用してください。',
            'parts' => [
                'type' => 'element',
                'file' => 'markdown',
            ],
        ],
    ],
];