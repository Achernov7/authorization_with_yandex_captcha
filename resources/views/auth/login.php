<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логин</title>
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
                    <h1 class="_auth_box_title">Введите для авторизации</h1>
                    <label class="_auth_box_text" for="login_email_phone">Телефон или электронная почта</label>
                    <input class="_auth_box_input" type="text" name="login" id="login_email_phone" placeholder="Телефон или электронная почта"/>
                    
                    <label class="_auth_box_text" for="login_password">Пароль</label>
                    <input class="_auth_box_input" type="text" placeholder="Пароль" name="login_password" id="login_password"/>
                    
                    <div class="_auth_box_content_block_buttonWrap">
                        <input type="submit" id="btn_login" hidden class="_auth_login_box_button" style="display: none;"/>
                        <div
                            id="captcha-container"
                            class="smart-captcha"
                            data-sitekey="<?php echo $frontKey;?>"
                            data-callback="onCaptchaReady"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="module" src="/js/auth/login.js"></script>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
