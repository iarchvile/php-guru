<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{mix('/css/app.css')}}">

</head>
<body>
<div id="app">

    <section class="pt-md-5 text-center">
        <div class="container">
            <h1>JSON API для интернет-магазина</h1>
            <p class="lead text-muted">Сервис для хранения, обработки и создания товаров. Товары должны храниться в базе данных. Сервис должен предоставлять API, работающее поверх HTTP в формате JSON.</p>
        </div>
    </section>

    <router-view></router-view>

</div>

<script src="{{mix('/js/app.js')}}"></script>
</body>
</html>
