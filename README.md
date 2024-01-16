# apis
開発中に必要になった機能をapiでまとめたモノ

## icon-maker API
画像のリサイズ・円形切り取りを行うAPI.  
出力はpng
### 使用方法
``https://api.pocopota.com/icon-maker?size={size}&url={icon url}``
### パラメータ
|name|required|description|
|----|----|----|
|size|◯|リサイズしたいサイズを指定|
|url|◯|編集したい画像URLを指定|

## hue-maker API
任意のグラデーション画像を生成するAPI.  
出力png
### 使用方法
``https://api.pocopota.com/hue-maker?w={width}&h={height}&colors={colors}``
### パラメータ
|name|required|description|
|----|----|----|
|width||画像の横幅. 初期は400|
|height||画像の縦幅. 初期は300|
|colors||グラデーションに使用する色をコンマ「,」区切りで指定. カラーコードで#は除く. 複数色指定可|
