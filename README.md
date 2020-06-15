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
  
  
  Задание: Необходимо написать упрощённое REST API.

Каркас приложения, должен быть стандартный MVC, реализованный через Controller, Entity, Repository, Service.
API должно содержать несколько методов:
1) Сгенерировать стартовый набор данных, генерируется 20 сущностей "товар", у которых есть идентификатор, название и цена.
2) Создать заказ. Метод принимает набор идентификаторов существующих товаров. У заказа есть статус, который может быть в 2 состаяниях: новый, оплачено. При создании заказа, по умолчанию выставляется статус "новый". При успешном создании заказа, метод должен возвращать этот номер в ответе на запрос.
3) Оплатить заказ. Метод принимает на вход сумму и идентификатор заказа. Если сумма совпадает с суммой заказа и статус заказа "новый", то отправляем http запрос на сайт ya.ru, если статус запроса 200, то меняем статус заказа на "оплачено" (таким образом имитируем работу платёжки).

Таблицу пользователей делать не нужно, считаем что пользователь всегда авторизирован под id=1, login=admin.
Количесвто товаров в рассчёт не берём, считаем, что их у нас беcконечное количество.
Задачу нужно реализовать без фреймворков, никаких триггеров, процедур в mysql использовать нельзя, только обычные sql запросы и транзакции. ORM использовать можно.
Использовать сторонние отдельные библиотеки можно (например symfony router).
Решение необхоимо выложить на github или аналогичный сервис с системой контроля версий.
Проект должен быть оформлен так, как будто выкладываете его в продакшн (никакого закомментированного кода, переменные называем сразу как надо и т.п.).
!!!Обязательно использование docker'а!!!

Есть два уровня сложности.
1) Только бэкенд, никакого GUI.
2) Вы делаете Rest API на php и весь фронт делаете на reactJs или vue (с webpack!), для фуллстак разработчиков.

Можно сделать каркас на этих компонентах (для примера, можно и другие):
# symfony/http-kernel
# symfony/http-foundation
# symfony/routing
# symfony/dependency-injection
# doctrine/orm
# guzzlehttp/guzzle

  
