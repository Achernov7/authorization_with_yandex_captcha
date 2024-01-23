

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/common.css">
</head>
<body>
    <div class="_component">
        <div class="_component_rightUp">
            <div style="margin-top: 30px">

                <?php if (!isset($_SESSION['auth'])) { ?>
                    <span id="_btn_to_follow_to_register" class="_component_rightUp_text">
                        Регистрация
                    </span>
                    <span id="_btn_to_follow_to_login" class="_component_rightUp_text">
                        Логин
                    </span>
                <?php } else { ?>
                    <span id="_btn_to_follow_to_profile" class="_component_rightUp_text">
                        Личная страница
                    </span>
                    <span id="_btn_to_to_logout" class="_component_rightUp_text">
                        Логаут
                    </span>
                <?php } ?>

            </div>
        </div>
        <div class="_component_box">
            <div class="_component_box_content">
                <h1>
                    Сомнительный контент на главной странице
                </h1>
            </div>
        </div>
    </div>
</body>
</html>
<script type="module" src="/js/outsider/index.js" type="text/javascript"></script>