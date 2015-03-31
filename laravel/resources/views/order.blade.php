<html>
<head>
    <title></title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/layout.css"/>

    {{--<link rel="icon" href="http://i.auto.ru/favicon.ico" type="image/x-icon">--}}
    {{--<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>--}}
</head>
<body>

<div class="center" id="ordersBox"></div>
<div class="" id="editorBox"></div>

{{--шаблоны dot js--}}
<!--li не закрываем чтобы небыло пробелов между inline-block элементами-->
<script type="text/template" id="tmplOrderHead">
    <li class="num">#
    <li class="date">Начало
    <li class="buyer">Покупатель
    <li class="desc">Описание
    <li class="cash">Нал
    <li class="price">Цена
    <li class="paid">Оплатил
    <li class="completed">Конец
    <li class="finished">Готово
    <% if (adding) { %>
        <li class="btn"><span class="jAdd">Добавить</span>
    <% } %>
</script>

<script type="text/template" id="tmplOrder">
    <li class="num"><%=id%>
    <li class="date"><%=created_rus%>
    <li class="buyer" title="<%=b_name%>"><%=b_name%>
    <li class="desc" title="<%=desc%>"><%=desc%>
    <li class="cash"><% if (cash == 1) { %>нал<% } else { %>безнал<% } %>
    <li class="price"><%=price%>
    <li class="paid"><% if (paid ==  1) { %>оплатил<% } else { %>не оплачено<% } %>
    <li class="completed"><%=completed_rus%>
    <li class="finished"><% if (finished) { %>готово<% } else { %>не готово<% } %>
    <% if (editing) { %>
        <li class="btn"><span class="edit jEdit">Редакция</span>
    <% } %>
</script>


@if (isset($data['orders']) && count($data['orders']) )
<script>
    var ordersJSON = {{ $data['orders'] }};
    console.log(ordersJSON);
</script>
@endif





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

<script type="text/javascript" src="bower_components/underscore/underscore.js"></script>
<script type="text/javascript" src="bower_components/backbone/backbone.js"></script>
{{--<script type="text/javascript" src="js/lib/sugar.js"></script>--}}

<script type="text/javascript" src="js/helpers.js" language="javascript"></script>
<script type="text/javascript" src="js/core.js" language="javascript"></script>



<script type="text/javascript" src="js/models/m.order.js" language="javascript"></script>
<script type="text/javascript" src="js/views/v.order.js" language="javascript"></script>
{{--<script type="text/javascript" src="js/views/v.orderEdit.js" language="javascript"></script>--}}
<script type="text/javascript" src="js/collections/c.order.js" language="javascript"></script>

<script type="text/javascript" src="js/router/r.home.js"></script>
<script type="text/javascript" src="js/pages/p.home.js"></script>



</body>
</html>
