# SymfonyComponent

Конфиг:
1) Для бд
  "dbname" =>"doctrine",
  "user" => "root",
  "password" => "example",
  "host" => "db",
  "driver" =>"pdo_mysql"
  
Инициализация проекта:
1) docker-compose up --build -d
2) docker-compose exec php-cli composer install
3) docker-compose exec php-fpm bash ( дальше в консоле контейнера)
  3.1) php bin/console.php diff
  3.2) php bin/console.php migrate
  3.3) В Adminere создаем БД "doctrine" - по ссылке localhost:8080
  
 Роуты:
 1) /product/generate - создает 20 продуктов для таблицы products
 2) /order/create - создает заказ. Используется JSON Для обращения 
  2.1) Пример: {"ids": [1,2,3] }
 3) /order/payment - оплата заказа. Используется JSON для обращения
  3.1) Пример: {"id": 18,"price": 11453}
  
