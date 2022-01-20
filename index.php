<?php

session_start();

include 'cls\global_class.php';

$open_page = new Page;
$open_page->checkCookie();
$user_status = $open_page->user_status;

?>

<!DOCTYPE HTML>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Главная страница сайта</title>
    <meta name="description" content="Описание страницы" />
        
    <link rel="stylesheet" type="text/css" href="css\style.css" />  <!-- URL -->
    <link rel="icon" href="">
    <script type="text/javascript" src="js\formfetch.js"></script>  <!-- URL -->

  </head>
  <body>
    <header>

      <?php if($user_status == "login"): ?>
      <!-- Form Logout -->
      <div class="welcom">
        <form name="logout" method="post" action="">
          <span style="margin-left: 15px">Hello:</span>
          <span><?php echo $_COOKIE['name']; ?></span>
          <span><input id="logout" type="submit" name="logout" value="Выход" class="out" /></span>
        </form>
      </div>
      <!-- End Form Logout -->
      
      <?php elseif($user_status == "logout"): ?>
      <button onclick="document.querySelector('#openlogin').style.display='block'" style="width:auto;">Авторизация</button>
      <button onclick="document.querySelector('#opensignup').style.display='block'" style="width:auto;">Регистрация</button>
      
      <!-- Form Login -->
      <div id="openlogin" class="modform">
        <form action="php\login.php" class="login" id="login">  <!-- URL -->
          <div class="conteiner">
            <span class="close" onclick="closeLogin()">Закрыть</span>
          </div>

          <label for="login">Логин (мин. 6 символов)</label>
          <input name="login" type="text">
          <div class="error"></div>

          <label for="password">Пароль (мин. 6 символов)</label>
          <input name="password" type="password">
          <div class="error"></div>

          <input name="login" type="submit" value="Авторизоваться">
        </form>
      </div>
      <div class="login_success">
        <div class="message">
          <div>Вы успешно авторизованны.</div>
          <button type="button" class="window_close" onclick="document.querySelector('.login_success').style.display='none'; window.location.href=' '">Ok</button>
        </div>
      </div>
      <!-- End Form Login -->
      
      <!-- Form Signup -->
      <div class="modform" id="opensignup">
        <form action="php\signup.php" class="signup" id="signup"> <!-- URL -->
          <div class="conteiner">
            <span class="close" onclick="closeSignup()">Закрыть</span>
          </div>

          <label for="login">Логин (мин. 6 символов)</label>
          <input name="login" type="text">
          <div class="error"></div>

          <label for="password">Пароль (мин. 6 символов)</label>
          <input name="password" type="password">
          <div class="error"></div>

          <label for="confirm_password">Повторите пароль</label>
          <input name="confirm_password" type="password">
          <div class="error"></div>

          <label for="email">E-mail</label>
          <input name="email" type="email">
          <div class="error"></div>

          <label for="name">Имя (2 буквы латинского алфавита)</label>
          <input name="name" type="text" maxlength="2">
          <div class="error"></div>

          <input name="signup" type="submit" value="Зарегистрироваться">
        </form>
      </div>
      <div class="signup_success">
        <div class="message">
          <div>Вы успешно зарегистрированы. Для просмотра содержимого сайта необходимо авторизоваться.</div>
          <button type="button" class="window_close" onclick="document.querySelector('.signup_success').style.display='none'">Ok</button>
        </div>
      </div>
      <!-- End Form Signup -->
      <?php endif; ?>

    </header>
    <nav>
      Навигация
    </nav>
    <main>

      <?php

      $show_content = new Page;
      $show_content->page = "html\main.txt";  // URL
      $show_content->page_err = "html\logout.txt";  // URL
      $show_content->user_status = $open_page->user_status;
      $show_content->getPage();
     
      ?>
      

    </main>
    <aside>
      <p>Боковая колонка (сайдбар)</p>
      <p>Здесь могла быть ваша реклама</p>
    </aside>
    <footer>
      <p>Служебная информация</p>
    </footer>

    <script>
      if (document.body.querySelector('#opensignup') !== null) {
        document.forms.signup.onsubmit = (e) => {
          e.preventDefault();
          sendNewUser();
        }
      }

      if (document.body.querySelector('#opensignup') !== null) {
        document.forms.login.onsubmit = (e) => {
          e.preventDefault();
          loginUser();
        }
      }
    </script>
  </body>
</html>
