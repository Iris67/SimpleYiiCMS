# SimpleYiiCMS
Описание:
Простая CMS на основе Yii фреймворка (1.1.16).

Используемые расширения:
1. captcha-extended
2. CKEditor
3. KCFinder

Установка:

1. Загрузите Yii CMS на сервер.
2. Создайте базу данных.
3. Импортируйте таблицы в БД, выполнив SQL-выражения из файла /protected/data/yiicms_host.sql.
4. В /protected/main.php пропишите имя хоста, имя созданной БД, имя пользователя БД, пароль пользователя БД.

Пользователи, которые уже есть в устанавливаемой CMS:
Пользователь	Пароль		Роль
admin			admin		admin
editor			editor		editor
author			author		author
demo			demo		subscriber
