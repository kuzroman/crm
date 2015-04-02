{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="kindBuyer" class="kindBuyer">
        <form id="addKindBuyer" class="addKindBuyer">
            <input name="kind" type="text" placeholder="вид продавца" />
            <button class="jAdd">Добавить</button>
        </form>
        <div id="kindBuyersBox"></div>
    </div>

    <script type="text/template" id="tmplKindBuyer">
        <span><%=kind%></span>
        <button class="jEdit">Ред-ть</button>
    </script>

    <script type="text/template" id="tmplKindBuyerEdit">
        <input class="" name="kindBuyer" type="text" value="<%=kind%>" />
        <button class="jDel">Удалить</button>
        <button class="jChange">Изм-ть</button>
        <button class="jCancel">Отмена</button>
    </script>



    @if (isset($kind_buyer) && count($kind_buyer) )
    <script>
    $(function () {
        if (!settings.cKindBuyers)
            settings.cKindBuyers = new App.Collections.KindBuyers( {!! $kind_buyer !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.kindBuyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.kindBuyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.kindBuyer.js" language="javascript"></script>

    {{--<script type="text/javascript" src="js/router/r.buyer.js"></script>--}}
    <script type="text/javascript" src="js/pages/p.kindBuyer.js"></script>

@stop