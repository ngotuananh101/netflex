<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Netflex</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
<noscript>
    <strong>
        We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work
        properly without JavaScript enabled. Please enable it to
        continue.
    </strong>
</noscript>
<div id="app" class="g-sidenav-show"></div>
@vite('resources/js/app.js')
<!-- Ybug code start (https://ybug.io) -->
<script type='text/javascript'>
    (function() {
        window.ybug_settings = {"id":"sa3kzfn6t2a6ckk42x1g"};
        var ybug = document.createElement('script'); ybug.type = 'text/javascript'; ybug.async = true;
        ybug.src = 'https://widget.ybug.io/button/'+window.ybug_settings.id+'.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ybug, s);
    })();
</script>
<!-- Ybug code end -->
</body>
</html>
