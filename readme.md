Eltech-database-library
=

Проект сделан в рамках дисциплины "База данных" в СПБ ГЭТУ ЛЭТИ. Носит демонстративный характер, показывается базовые операции CRUD (create, read, update и delete) при работе с базой данных.

Развертывание проекта
--
1. Для начала нужно развенуть репозиторий
```bash
git@github.com:Sadykh/eltech-database-library.git
``` 
2. Затем нужно запустить систему виртуализации (docker) для создания нужного окружения. Для этого в директории проекта нужно выполнить следующую команду:
```bash
docker-compose up -d
```
3. Создаем файл **.env** и заполняем его данными доступа к базе данных (аналог файла .env-dist)
4. Затем нужно установить все пакеты и применить миграции. Для этого нам нужно зайти в изолированный контейнер и выполнить ряд команд. Если нас спросят режим работы, выбираем 0 - development.
```bash
docker exec -it eltech_library_php bash
cd /www
composer install
php init
```
5. У нас появится ряд скрытых от git файлов. В файле common/config/main-local.php вносим актуальные реквизиты базы данных (из файла .env)
6. Выполняем следующую команду для применения миграций базы данных:
```bash
php yii migrate
php yii util/add-publication
php yii util/transfer-journals
```
4. Далее в файле hosts (пути в Windows и Linux могут различаться) нужно добавить запись:
```
127.0.0.1	local.eltech-library.ru
```
5. Проект запущен и доступен по адресу local.eltech-library.ru

P.S Не забывайте про порты веб-сервера. В docker-compose по умолчанию для веб-сервера указан порт 1886. Вы можете создать файл **docker-compose.override.yml** и переписать нужные вам секции контейнеров. Пример файла **docker-compose.override.yml** можно увидеть в файле **docker-compose.override.sample.yml**