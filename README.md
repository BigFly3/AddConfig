# AddConfigプラグイン

CakePHPライクの設定ファイルを作成することでカスタムフィールドを追加することができます。
グループごとに項目を出し分けることが可能なので、見やすいフィールドを作成することが出来ます。

設定ファイルにCakePHPのformヘルパーやバリデーション形式の記述をするだけなので、
１度作成手順を覚えてしまえば画面設計書を作るよりも短い時間で、動く管理画面を作成することも可能になります。
baserCMSのコア知識が無くても、CakePHPの知識で色々カスタマイズがしやすいように作成しています。
JSを含めた高機能なフォームパーツを独自で作成することも可能です。色々お試しください。

## インストール方法
1. 使用したいthemeフォルダにPluginディレクトリを作成し、その中にAddConfigプラグインを追加する。※zipを解凍した場合はAddConfig-masterをAddConfigにリネームしてください。
2. テーマ管理からプラグインの入ったテーマを選択する。
3. プラグイン管理からAddConfigプラグインを選択してインストールする。




## 設定ファイルで作成できるパーツ
* BcFormヘルパーのinputのtypeで設定できる入力パーツ  
* baserCMSアップローダーへのファイルアップロード
* baserCMSのヴィジュアルエディタ(ckeditor)
* テーブルの見出し追加やヘルプ、フォーム前後へのテキスト表示など

## カスタムフィールド作成方法
**AddConfig/Config/settings.php**に、
$config['AddConfig']から始まる設定を記述していきます。  

実際記述する際は**settings.php**内の以下の部分のコメントアウト(// )してから進めていきます。
```
// include "sample-form.php"; //$config['AddConfigDebug'] = true;がセットされているので登録はしません。
```

このincludeされているファイルはプラグインのインストール直後に表示されているフォーム項目です。
記述の際は [**sample-form.php**](https://github.com/BigFly3/AddConfig/blob/master/Config/sample-form.php)の設定内容を参考にしてください。



```
$config['AddConfig']['form'][] = [ 
    'title' => 'ogp設定',
    'fields' => [
        'ogp_image' => [
            'required' => true,
            'label' => '画像',
            'parts' => [
                'type' => 'upload', //画像をアップロードする
            ],
            'validate' => [
                [
                    'rule' => ['notBlank'],
                    'message' => '画像を登録してください'
                ],
            ],
            'help' => 'ファイル形式 gif,jpg,png<br>推奨サイズは幅1200×高さ630です'
        ],
        'ogp_url' => [
            'required' => true,
            'label' => 'URL',
            'parts' => [
                'type' => 'text',
                'size'=>'70',
            ],
            'validate' => [
                [
                    'rule' => 'notBlank',
                    'message' => 'URLを入力してください'
                ],
                [
                    'rule' => 'url',
                    'message' => 'URLの形式で入力してください'
                ],
            ],
            'help' => 'OGPで表示される飛ばしたいURLを入力します'
        ]
    ]
];
```

記述した設定は  以下のページに反映されます。

    /admin/add_config/add_configs/form/  





※登録するデータは**key=>value**の形でする必要があります。  
配列で登録しようとすると、エラーでロールバックされます。  
複数選択のチェックボックスを使いたい場合は、formpartsにあるselect-textをお使いください。


## 登録されたデータ
登録されたデータはグローバル変数の$siteConfigと同じようにサイトの各場所から参照できるようになります。  
```
controller　→　$this->addConfigs  
view　→　$addConfig  
```

### ヘルパー
viewにセットされた$addConfigをそのまま出力してもよいのですが、
$addConfigの内容を使いやすくするためのヘルパー【 $this->AddConfig->関数名() 】もあります。


- field($key [ , $escape = true ])　キー名のデータを出力
- brfield($key [ , $escape = true ])　キー名のデータにある改行を&lt;br&gt;にして出力する
```
どちらもデフォルトはタグをエスケープします。値が文字列でない場合は無視されます。
f(),brf() の省略形もあります
```
- img($key [ , $options ])　uploadで登録した画像を表示します。
```
オプションの指定はBcBaser->imgの指定と同じ + 'noimage'=>画像パスで登録なし時の画像を表示できます。
'noimage'=>true にするとbaserCMS標準のnoimageが表示されます。
```

- get($key)　キー名のデータを取得
- set($key , $value )　キー名に任意の値をセット
- getData()　setData()に登録している内部データを取得
- setData([$array=$addConfig])　出力のベースになる配列をセット。初期値は$addConfig

```
setData()は他の配列データをセットするとaddConfigヘルパーのメソッドが使用できます。
$siteConfigやループの中でaddConfigヘルパーを使用するイメージです。
$addConfigのデータで初期化したいときは、引数無しのsetData()を呼びます。
```

- is($key)　キー名の値がそんざいするかどうか
- in($key , $needle )　select-text（複数選択で登録）したものに$needleがマッチするかどうか
- explodeArray($key)　select-textで登録した値を配列にして返す。
```
select-textで登録した値は、シングルクォートやカンマが値に含まれていると文字列に置換されています。
普通の値でもexplodeだけだとシングルクォートが残ってしまうのでexplodeArray()を使ってください。
```

- getKeysFilter($keys)　[key1,key2,key3,...] 指定したキーの配列のみを返す。
- getPrefixFilter($prefix[,$drop_prefix = false])　$prefixにマッチするキー名の配列を返す。
```
$drop_prefix = trueにするとsmtp_host,smtp_portなどが、取得した配列の中ではhost,portになります。
```





## FAQ
HTMLやCakePHPの知識があれば画面を色々カスタマイズ出来るようになっています。
修正するファイルもsetting.phpとelement以下なのでbaserCMSの知識はそこまで必要ありません。

#### Q オリジナルのフォームパーツを作りたい
A ['parts']['type']="element"にするとAddConfig/View/Element/formpartsからfileを読み込む仕組みにしています。  
formparts以下のフォームパーツを参考にして作成してください。

#### Q 管理画面から登録できる動的な選択項目を作りたい   
  A ブログカテゴリーやユーザーなどをfind('list')であらかじめ取得することで、権限グループみたいなものを作ったりすることもできます。

##### 店舗によって表示/非表示を出し分ける判別グループを作る場合

  ```
    $BlogCategory = ClassRegistry::init('Blog.BlogCategory');
    $store = $BlogCategory->find("list",['conditions' => ['BlogCategory.blog_content_id' => 2],  'fields' => ['BlogCategory.name','BlogCategory.title']]);
    $config['AddConfig'][] = [
        'fields' => [
            'stores' => [
                'required' => true,
                'label' => '○○を表示する店舗',
                'parts' => [
                    'type' => 'element',
                    'file' => 'select-text',
                    'options'=> $store,  //$BlogCategoryで取得したカテゴリ項目をプルダウンで表示
                ],
                'inputAfter' => '選択肢に表示されない場合はブログカテゴリーに追加してください。',
            ],
        ]
    ]
  ```
#### Q 独自ルールのバリデーションを作りたい  
A CakePHPのルールと同様にAddConfig/Model/AddConfig.phpにfunctionを作成して、ruleに追加すると独自のチェックが行えます。
バリデーションのルールなどは[こちら](https://book.CakePHP.org/2.0/ja/models/data-validation.html)を参考にしてください


#### Q デバッグモードを停止したのに登録できないことがある。
設定ファイルで色々出来る仕様上リロードした際にPOSTが残っていたり、フォームパーツを切り替えたときに意図しない登録が発生してしまう可能性があります。
その為デバッグ状態時に設定されたhiddenタグで登録をはじかれた可能性が高いです。
上手くいかない場合は改めてURLを叩きなおしたり、再度登録をお試しください。
