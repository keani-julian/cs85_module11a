# Module 11A: API Data (json-playground)

GitHub Repo: https://github.com/keani-julian/cs85_module11a

### Summary: 
For this assignment I simulated an API response using a static JSON file. The app reads
`weather.json` from Laravel's storage, decodes it into a PHP array, passes it to a Blade view, and displays it as an HTML table. 

## How it works

The data flows through three files:

1. **`storage/app/private/weather.json`** — the static file standing in for an API response.
   Three days of forecast data (day, high, low, condition).

2. **`app/Http/Controllers/WeatherController.php`** — reads the file with the `Storage`
   facade, then converts the JSON string into a PHP associative array with
   `json_decode($json, true)`. The `true` is what makes it an array instead of an object.
   It then hands the array to the view.

3. **`resources/views/weather/index.blade.php`** — loops the array with `@foreach` and
   prints one table row per day.

The route lives in `routes/web.php`:

```php
Route::get('/weather', [WeatherController::class, 'index']);
```

## Setup Instructions

You need PHP 8.5 and Composer. 

Run the follwing in Laravel Herd.

```bash
git clone https://github.com/keani-julian/cs85_module11a
cd cs85_module11a/json-playground
composer install
cp .env.example .env
php artisan key:generate
```

Then open the site:

- In Herd, if the folder is in your directory, it is available automatically at
  http://json-playground.test

Go to **`/weather`** to see the forecast table 
http://json-playground.test/weather

No database setup is needed. 

## Important context on weather.json

`storage/app/private/` is ignored by Laravel's default `.gitignore`, because that folder is
normally where a running app writes user uploads. Since `weather.json` is source data that
the whole assignment depends on, I added an exception so it is tracked:

```
*
!.gitignore
!weather.json
```

Without that, cloning this repo will likely lead the app to crash on `/weather`, because `Storage::get('weather.json')` would not be able to see the file.

I also put the file in `storage/app/private/` rather than `storage/app/`. In Laravel 11 and later the default `local` disk points at `storage/app/private`, so that is where `Storage::get()` checks.

## Screenshot of tablet

![Weekly Weather Forecast table with the rainy day highlighted](module11a-sc.png)
