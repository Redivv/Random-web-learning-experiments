<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>

        <div id="app">
            {{-- <input type="text" v-model="coupon">
                ==
            <input type="text" :value="coupon" @input="coupon = $event.target.value"> --}}

            <coupon v-model="code"></coupon>
        </div>
       
        <div id="one">
            <h1>
                @{{user.name}}
            </h1>
        </div>
       
        <div id="two">
            <h1>
                @{{user.name}}
            </h1>
        </div>


    <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
