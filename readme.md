<h2>
    Авторизация и редактирование профиля на нативном js,php c яндекс капчей.
</h2>

Установить пакет:
sudo apt install php-mbstring

Сервер должен смотреть в папку public.

В консоли в папке с проектом прописать:

1) Создать симлинки:
php command symlinks

2) Создаем таблицы:
php command migrate

даем права на запись в бд.

3) Устанавливаем композер:
composer install

4) Вставляем ключи в массив в папке config в файле capctha от yandexCapctha.
