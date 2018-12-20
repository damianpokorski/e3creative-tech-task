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

                  <div v-if="api_down">
                      <h1>Error</h1>
                      <h3>Apologies but it looks like we encountered some issues.</h3>
                      <h5>Please try again later.</h5>
                  </div>

                  <div v-if="!api_down">

                      <exchange-viewer :api_result="api_result" v-if="api_result" @go_back="restart">
                      </exchange-viewer>

                      <birthday-picker v-if="allow_submission" @submit="birthday_submitted($event)">
                      </birthday-picker>

                      <past-response-list :api_result="past_submissions_result" v-if="past_submissions_result && api_result == null"
                      @open="open($event)">
                      </past-response-list>
                  </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
