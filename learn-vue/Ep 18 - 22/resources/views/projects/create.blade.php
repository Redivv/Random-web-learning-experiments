<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.css">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <style>
        body{
            padding-top: 40px;
        }
    </style>
    <body>
        <div id="app" class="container">
            @include('projects.list')

            <form action="/projects" method="post" @submit.prevent="fuckYeah" @keydown="form.errors.clear($event.target.name)">
                <div class="control">
                    <label for="name" class="label">Project Name</label>
                    <input type="text" id="name" name="name" class="input" v-model="form.name">
                    <span v-if="form.errors.has('name')" class="help is-danger"> @{{form.errors.get('name')}} </span>
                </div>
                <div class="control">
                    <label for="desc" class="label">Opis</label>
                    <input type="text" id="desc" name="desc" class="input" v-model="form.desc">
                    <span class="help is-danger"> @{{form.errors.get('desc')}} </span>
                </div>
                <div class="control">
                    <button class="button is-primary" :disabled="form.errors.any()">Chuj</button>
                </div>
            </form>
        </div>


    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.6.11/dist/vue.js"></script> --}}
    <script src="/js/app.js"></script>
    </body>
</html>
