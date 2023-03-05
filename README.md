# apis
開発中に必要になった機能をapiでまとめたモノ

## icon-maker API
画像のリサイズ・円形切り取りを行うAPI.  
出力はpng
### 使用方法
``https://api.pocopota.com/icon-maker?size={size}&url={icon url}``
### パラメータ
|name|description|
|----|----|
|size|リサイズしたいサイズを指定|
|url|編集したい画像URLを指定|

## Line Break API (開発中)
### 禁則表現
|禁則|詳細|具体例|
|----|----|----|
|行頭禁則文字|行の頭においてはいけない文字|終わり括弧類、拗促音、中点、音引、句読点、その他約物（ゝ々！？：；など）|
|行末禁則文字|行の末尾においてはいけない文字|始め括弧類|
|分離禁止文字|行をまたいで分離してはいけない文字|つなぎ罫(……、――)、連数字や組数字（10,000、3/5）、英単語|

※参考・引用：[禁則処理とは何か　～文字組版の基本（前半）～](https://www.tairapromote.co.jp/column/284/)、[禁則処理 - Wikipedia](https://ja.wikipedia.org/wiki/%E7%A6%81%E5%89%87%E5%87%A6%E7%90%86)
