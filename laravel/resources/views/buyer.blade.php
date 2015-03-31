<div id="buyersBox"></div>

<script type="text/template" id="tmplBuyers">
    <div class="buyers silver">
        <ul class="head">
            <li class="num">#
            <li class="name">Название
            <li class="kind">Вид
            <li class="email">E-mail
            <li class="add"><div class="jAdd">Добавить</div>
        </ul>
    </div>
    <div class="buyers silver" id="buyersList"></div>
</script>

<script type="text/template" id="tmplBuyer">
    <li class="num"><%=id%>
    <li class="name"><%=name%>
    <li class="kind"><%=kindName%>
    <li class="email"><%=email%>
    <% if (edit) { %>
        <li class="btn jEdit">Редакция
    <% } %>
</script>

<script type="text/template" id="tmplBuyerEdit">
    <div class="jClose close">X</div>
    <ul>
        <li><input name="name" value="<%=name%>"/>
        <li>
        <select name="id_kind">
            <% _.each(settings.cKindBuyers, function(x,index) {
                    var model = settings.cKindBuyers.at(index)
                        ,kind = model.get('kind')
                        ,id = model.get('id');

                    var selected = (id_kind == id) ? 'selected' : '';
            %>
             <option <%=selected%> value="<%=id%>"><%=kind%></option>
            <% }); %>
        </select>
        <li><input name="email" value="<%=email%>">
        <li>
            <%  if (name == '' && email == '' && id_kind == '') { %>
                <button class="jAdd">Добавить</button>
            <% } else { %>
                <button class="jChange mr18">Изменить</button>
                <button class="jDel">Удалить</button>
            <% } %>
    </ul>
</script>


@if (isset($buyers) && count($buyers) )
<script>
$(function () {
    if (!settings.cBuyers)
        settings.cBuyers = new App.Collections.Buyers( {!! $buyers !!} )
})
</script>
@endif


<script type="text/javascript" src="js/models/m.kindBuyer.js" language="javascript"></script>
<script type="text/javascript" src="js/collections/c.kindBuyer.js" language="javascript"></script>
{{--понадобится если захочу отобразить шаблон buyer.blade без kindBuer.blade--}}
@if (isset($kind_buyer) && count($kind_buyer) )
<script>
$(function () {
    if (!settings.cKindBuyers)
        settings.cKindBuyers = new App.Collections.KindBuyers( {!! $kind_buyer !!} )
})
</script>
@endif


<script type="text/javascript" src="js/models/m.buyer.js" language="javascript"></script>
<script type="text/javascript" src="js/collections/c.buyer.js" language="javascript"></script>
<script type="text/javascript" src="js/views/v.buyer.js" language="javascript"></script>

<script type="text/javascript" src="js/router/r.buyer.js"></script>
<script type="text/javascript" src="js/pages/p.buyer.js"></script>