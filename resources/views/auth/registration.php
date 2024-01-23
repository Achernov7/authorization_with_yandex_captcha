<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/auth/loginAndRegistration.css">
    <link rel="stylesheet" href="/css/common.css">
</head>
<body>
    <div class="_component">
        <div class="_component_rightUp">
            <div style="margin-top: 30px">
                <div id="_btn_to_follow_to_main" class="_component_rightUp_text">
                    На главную
                </div>
            </div>
        </div>
        <div class="_component_box">
            <div class="_component_box_content">
                <div class="_auth_box_content_block">
                    <h1 class="_auth_box_title">Регсистрация нового пользователя</h1>
    
                    <label class="_auth_box_text" for="login">Имя пользователя</label>
                    <input class="_auth_box_input" type="text" id="login" placeholder="Имя пользователя"/>
    
                    <label class="_auth_box_text" for="email">Электронная почта</label>
                    <input class="_auth_box_input" type="text" id="email" placeholder="Электронная почта"/>
    
                    <label class="_auth_box_text" for="phone">Телефон</label>
                    <input class="_auth_box_input" type="text" id="phone" placeholder="Телефон"/>
    
                    <label class="_auth_box_text" for="password">Пароль</label>
                    <input class="_auth_box_input" type="text" id="password" placeholder="Пароль"/>
    
                    <label class="_auth_box_text" for="password_confirm">Повторите пароль</label>
                    <input class="_auth_box_input" type="text" id="password_confirm" placeholder="Пароль"/>
    
                    <input type="submit" id="btn_registration" class="_auth_login_box_button"/>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="module" src="/js/auth/registration.js" type="text/javascript"></script>
