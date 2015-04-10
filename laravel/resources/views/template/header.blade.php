<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/layout.css"/>

    <script>
        window.settings = {};
    </script>


    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>--}}
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>

    <script type="text/javascript" src="bower_components/underscore/underscore.js"></script>
    <script type="text/javascript" src="bower_components/backbone/backbone.js"></script>
    {{--sugarjs bower не нашел--}}
    <script type="text/javascript" src="js/lib/sugar.js" language="javascript"></script>

    <script type="text/javascript" src="js/helpers.js" language="javascript"></script>
    <script type="text/javascript" src="js/core.js" language="javascript"></script>

    <script type="text/javascript" src="js/devTest.js" language="javascript"></script>

    <script>settings._token = '{{ csrf_token() }}';</script>

</head>
<body>