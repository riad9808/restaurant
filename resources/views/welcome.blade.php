<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <title>App Name - @yield('title')</title>

    </head>
   <body>
    <a href="/Acompte">ajouter un utilisateur</a>

   @section('sidebar')

   @show

   <div class="container">
       @yield('content')
       <ul class="list-group ">
           @foreach($data as $d)
               <li class="list-group-item" style="margin : 10px ">
                   <h4 >Plat :  {{ $d->id }}-- quantite : {{ $d->id }}</h4>
               </li>
           @endforeach
       </ul>
   </div>
   </body>
</html>
