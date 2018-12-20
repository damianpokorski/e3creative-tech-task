<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E3Creative Technical Test</title>

        <!-- Webpack references -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content" id="content">

                <div id="app" class="py-5">
                  <birthday-picker v-if="allow_submission" @submit="birthday_submitted($event)"></birthday-picker>

                  <exchange-viewer :api_result="api_result" v-if="api_result"></exchange-viewer>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
