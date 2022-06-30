# Project setup

```
git clone https://github.com/nrgsourcecode/TestWork-009-
```

## back-end

```
cd back-end
cp .env.example .env
php artisan make:database
php artisan migrate --seed
php artisan serve
```

## front-end

```
cd front-end
npm run serve
```
