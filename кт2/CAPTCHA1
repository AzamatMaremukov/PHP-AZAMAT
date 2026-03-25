<?php
session_start();

// 1. Генерируем случайную строку (5-6 символов)
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
$length = rand(5, 6);
$captchaText = '';
for ($i = 0; $i < $length; $i++) {
    $captchaText .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_text'] = $captchaText;

// 2. Создаем изображение с шумовым фоном
$width = 350;
$height = 120;
$image = imagecreatetruecolor($width, $height);

// Создаем случайный фоновый цвет
$bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
imagefill($image, 0, 0, $bgColor);

// Добавляем шум в виде случайных точек на фон
for ($i = 0; $i < 500; $i++) {
    $noiseColor = imagecolorallocate($image, rand(150, 220), rand(150, 220), rand(150, 220));
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
}

// Добавляем случайные линии на фон
for ($i = 0; $i < 20; $i++) {
    $lineColor = imagecolorallocate($image, rand(180, 230), rand(180, 230), rand(180, 230));
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
}

// 3. Подключаем шрифт
$fontPath = 'C:/Windows/Fonts/arial.ttf';
if (!file_exists($fontPath)) {
    $fontPath = '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf'; // для Linux
    if (!file_exists($fontPath)) {
        $useFontFile = false;
    } else {
        $useFontFile = true;
    }
} else {
    $useFontFile = true;
}

// 4. Рисуем символы
$startX = 40;
$spacing = 45;

for ($i = 0; $i < $length; $i++) {
    $char = $captchaText[$i];
    $size = rand(20, 32);
    $angle = rand(-20, 20);
    
    // Первый символ красный
    if ($i == 0) {
        $color = imagecolorallocate($image, 255, 0, 0);
    } else {
        $r = rand(0, 200);
        $g = rand(0, 200);
        $b = rand(0, 200);
        $color = imagecolorallocate($image, $r, $g, $b);
    }
    
    $x = $startX + ($i * $spacing);
    $y = rand(50, 90);
    
    if ($useFontFile && file_exists($fontPath)) {
        imagettftext($image, $size, $angle, $x, $y, $color, $fontPath, $char);
    } else {
        // Встроенный шрифт как запасной вариант
        $fontSize = 5;
        imagestring($image, $fontSize, $x, $y - 20, $char, $color);
    }
}

// 5. Накладываем дополнительные шумы поверх символов
// Линии разного цвета и толщины
for ($i = 0; $i < rand(10, 20); $i++) {
    $lineColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
    $thickness = rand(1, 2);
    imagesetthickness($image, $thickness);
    $x1 = rand(0, $width);
    $y1 = rand(0, $height);
    $x2 = rand(0, $width);
    $y2 = rand(0, $height);
    imageline($image, $x1, $y1, $x2, $y2, $lineColor);
}
imagesetthickness($image, 1);

// Точки разного размера
for ($i = 0; $i < rand(300, 500); $i++) {
    $pointColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    $x = rand(0, $width);
    $y = rand(0, $height);
    $radius = rand(1, 2);
    imagefilledellipse($image, $x, $y, $radius, $radius, $pointColor);
}

// Добавляем случайные дуги/кривые
for ($i = 0; $i < rand(3, 6); $i++) {
    $arcColor = imagecolorallocate($image, rand(100, 180), rand(100, 180), rand(100, 180));
    imagearc($image, rand(0, $width), rand(0, $height), rand(50, 150), rand(30, 80), 0, 360, $arcColor);
}

// 6. Отправляем заголовок и выводим изображение
header('Content-Type: image/jpeg');
imagejpeg($image, null, 85);
imagedestroy($image);
?>
