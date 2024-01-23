

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/profile/show.css">
</head>
<body>
    <div class="_component">
        <div class="_component_rightUp">
            <div style="margin-top: 30px">
                <span id="_btn_to_follow_to_main" class="_component_rightUp_text">
                    На главную
                </span>
                <span id="_btn_to_to_logout" class="_component_rightUp_text">
                    Логаут
                </span>
            </div>
        </div>
        <div class="_component_box">
            <div class="_component_box_content">
                <div class="_component_box_content_profile">
                    <h1>Ваш профиль</h1>
                    <div class="_component_box_content_text">
                        <div class="_component_box_content_text_inline">
                            Ваше имя
                        </div>
                        <div id="_name" class="toShow">
                            <?php echo $user['NAME']; ?>
                        </div>
                        <input type="text" class="_component_box_content_input toEdit" value="<?php echo $user['NAME']; ?>" id="_name_input" style="display: none;">
                    </div>
    
                    <div class="_component_box_content_text">
                        <div class="_component_box_content_text_inline"> 
                            Ваша почта
                        </div>
                        <div id="_email" class="toShow">
                            <?php echo $user['EMAIL']; ?>
                        </div>
                        <input type="text" class="_component_box_content_input toEdit" value="<?php echo $user['EMAIL']; ?>" id="_email_input" style="display: none;">
                    </div>
    
                    <div class="_component_box_content_text">
                        <div class="_component_box_content_text_inline">
                            Ваш номер
                        </div>
                        <div id="_phone" class="toShow">
                            +7<?php echo $user['PHONE']; ?>
                        </div>
                        <input type="text" class="_component_box_content_input toEdit" value="+7<?php echo $user['PHONE']; ?>" id="_phone_input" style="display: none;">
                    </div>

                    <div class="_component_box_content_text_password" style="display: none;" id="_change_password">
                        <div class="_component_box_content_text_inline">
                            Ваш старый пароль
                        </div>
                        <input type="text" class="_component_box_content_input" id="_old_password_input">

                        <div class="_component_box_content_text_inline">
                            Ваш новый пароль
                        </div>
                        <input type="text" class="_component_box_content_input" id="_new_password_input">
                    </div>
                    <div class="_component_box_content_btns">
                        <input type="submit" class="_component_box_content_submit" id="_btn_edit_profile" value="Редактировать профиль">
                        <input type="submit" class="_component_box_content_btn _cancel_btn" id="_btn_edit_profile_cancel" value="Отмена редактирования" style="display: none;">
                        <input type="submit" class="_component_box_content_btn _send_btn" id="_btn_edit_profile_send" value="Отправить" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="module" src="/js/profile/index.js" type="text/javascript"></script>