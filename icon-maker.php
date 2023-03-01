<?php
$icon = $_GET['url'];
$size = $_GET['size'];


//==========画像サイズ変更==========
// 画像ファイルを読み込み
$src_image = imagecreatefrompng($icon);
// 元画像サイズ取得
$src_image_width = imagesx($src_image);
$src_image_height = imagesy($src_image);
// GDイメージの作成
$resizedImage = imagecreatetruecolor($size, $size);
imagecopyresampled($resizedImage, $src_image, 0, 0, 0, 0, $size, $size, $src_image_width, $src_image_height);
// 一旦出力(base64)
ob_start();
imagepng($resizedImage); // 画像をPNG形式で出力します。
$resizedImage = ob_get_contents();
ob_end_clean();
$resizedImage = base64_encode($resizedImage);
$resizedImage = base64_decode($resizedImage);

//==========円形加工==========
// ファイル読み込み
$src_image = imagecreatefromstring($resizedImage);
// 真ん中が透過色のマスク画像
$mask = imagecreatetruecolor($size, $size);
// 緑(0, 255, 0)塗りつぶし
$green = imagecolorallocate($mask, 0, 255, 0);
imagefill($mask, 0, 0, $green);
// マスクの透過色を指定(255, 0, 255)
$mask_transparent = imagecolorallocate($mask, 255, 0, 255);
imagecolortransparent($mask, $mask_transparent);
// 中央の円を透過色で塗りつぶし
imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, $mask_transparent);
// 元画像とマスク画像を重ね合わせ
imagecopymerge($src_image, $mask, 0, 0, 0, 0, $size, $size, 100);
// 背景色の緑(0, 255, 0)を透過色に指定
$src_transparent = imagecolorallocate($src_image, 0, 255, 0);
imagecolortransparent($src_image, $src_transparent);

//==========結果出力==========
header('Content-Type: image/png');
imagepng($src_image);