Данное приложение чрезвычайно простое, но несмотря на это я выбрал для его реализации микросервисную архитектуру,
потому что считаю её наиболее предпочтительной из-за большого количества преимуществ перед монолитной архитектурой,
например отказоустойчивость, независимость выбора технологий для использования в сервисах,
лёгкая масштабируемость и высокая производительность


Чтобы установить приложение надо запустить в корневой директории команду:
**composer install**

Чтобы запустить сервер API для SPA надо выполнить в основной директории приложения команду:
**symfony server:start -d**

Чтобы запустить SPA надо перейти из основной директории приложения в директорию /spa и 
выполнить ту же команду:
**symfony server:start -d**

Чтобы запустить тесты надо выполнить из основной директории приложения команду:
**symfony php bin/phpunit**