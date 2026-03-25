
<?php
session_start();

// Создаем изображение
$width = 200;
$height = 70;
$image = imagecreatetruecolor($width, $height);

// Цвета
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 100, 100, 100);

// Заливка фона
imagefill($image, 0, 0, $bg_color);

// Получаем код из сессии
$code = $_SESSION['captcha_code'] ?? '12345';

// Добавляем линии для усложнения распознавания
for ($i = 0; $i < 5; $i++) {
    $x1 = rand(0, $width);
    $y1 = rand(0, $height);
    $x2 = rand(0, $width);
    $y2 = rand(0, $height);
    imageline($image, $x1, $y1, $x2, $y2, $line_color);
}

// Добавляем текст с искажением
for ($i = 0; $i < strlen($code); $i++) {
    $char = $code[$i];
    $x = 20 + $i * 30;
    $y = rand(30, 50);
    $angle = rand(-15, 15);
    $font_size = 20;
    
    // Случайный цвет для каждой цифры
    $char_color = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
    
    // Используем встроенный шрифт (если нет TrueType)
    imagestring($image, 5, $x, $y, $char, $char_color);
}

// Добавляем шум (точки)
for ($i = 0; $i < 100; $i++) {
    $x = rand(0, $width);
    $y = rand(0, $height);
    $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($image, $x, $y, $color);
}

// Отправляем заголовок и изображение
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
