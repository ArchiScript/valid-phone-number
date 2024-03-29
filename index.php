<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="favicon.svg" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>HI TECH test phone validator</title>
</head>

<body>
  <div class="main">
    <div class="logo-container">
      <div class="logo">

        <?php echo file_get_contents("favicon.svg");?>
      </div>
    </div>

    <div class="description">
      <h3>HI TECH: Проверка номера телефона</h3>
      Допустимо начинать номер с +, 0, 00; </br> Для распознавания локации необходимо ввести код страны. </br> При вводе
      мобильного телефона распознается страна, при вводе стационарного номера распознается регион или город.
    </div>
    <form action="validator.php" method="post" class="form">
      <input type="tel" name="phone" class="form__input" placeholder="Введите номер телефона">
      <button type="submit" class="form__btn">Проверить</button>
      <div class="result"></div>
    </form>
  </div>
  <script src="sendform.js" type="text/javascript"></script>
</body>

</html>