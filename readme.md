# Instrukcja uruchomienia

## 1. Pobranie repozytorium i skonfigurowanie środowiska oraz hosta
  - wersja PHP >= 7.1.3
  - baza danych MySQL 5.7
  - serwer nginx lub Apache (root strony ustawić na public)
  - ustawić prawo do zapisu dla katalogów: bootstrap/cache i storage 

## 2. Instalacja zależności przez composer
```sh
$ composer install
```

## 3. Konfiguracja - plik .env
```sh
APP_URL=http://simple-book-system.local
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simple_book_system
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## 4. Migracja tabel bazy danych
```sh
$ php artisan migrate
```

## 5. Uruchomienie