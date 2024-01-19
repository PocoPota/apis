<?php
// クロスサイト許可
header("Access-Control-Allow-Origin: *");

// キャッシュ無効化
header( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header( 'Last-Modified: '.gmdate( 'D, d M Y H:i:s' ).' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate,max-age=0' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

// パラメータ取得
$width = isset($_GET['w']) ? intval($_GET['w']) : 400;
$height = isset($_GET['h']) ? intval($_GET['h']) : 300;
$colors = isset($_GET['colors']) ? explode(',', $_GET['colors']) : null;

// 使用色定義
$presetColors = [
    ['FC5C7D', '6A82FB'],
    ['6DD5FA', '2980B9'],
    ['00b09b','96c93d'],
    ['f7ff00','db36a4']
];

// 画像生成
$image = imagecreatetruecolor($width, $height);

// 関数定義
function hexToRgb($hex){
    $red = hexdec(substr($hex, 0, 2));
    $green = hexdec(substr($hex, 2, 2));
    $blue = hexdec(substr($hex, 4, 2));
    return [$red, $green, $blue];
}

// 色未指定の場合プリセットから定義
if(!$colors){
    $colors = $presetColors[rand(0, count($presetColors) - 1)];
}

// 画像分割&塗り
if(count($colors) > 1){
    for($i = 0; $i < count($colors) - 1; $i++){
        // 1pxごとにどのくらい色を変えるか計算
        $steps = [
            (hexToRgb($colors[$i + 1])[0] - hexToRgb($colors[$i])[0]) / ($width / (count($colors) - 1)),
            (hexToRgb($colors[$i + 1])[1] - hexToRgb($colors[$i])[1]) / ($width / (count($colors) - 1)),
            (hexToRgb($colors[$i + 1])[2] - hexToRgb($colors[$i])[2]) / ($width / (count($colors) - 1))
        ];
        // 1pxごとに線を描画
        $startColor = hexToRgb($colors[$i]);
        for($j = 0; $j < $width / (count($colors) - 1); $j++){
            $color = imagecolorallocate($image, $startColor[0] + $steps[0] * $j, $startColor[1] + $steps[1] * $j, $startColor[2] + $steps[2] * $j);
            imageline($image, $j + $i * ($width / (count($colors) - 1)), 0, $j + $i * ($width / (count($colors) - 1)), $height, $color);
        }
    }
}else{
    $color = imagecolorallocate($image, hexToRgb($colors[0])[0], hexToRgb($colors[0])[1], hexToRgb($colors[0])[2]);
    // 一色で塗りつぶし
    imagefilltoborder($image, $width, $height, $color, $color);
}

// 画像出力
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);