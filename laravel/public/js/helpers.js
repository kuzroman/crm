var hp = {};

/* упощаем доступ к шаблонам */
hp.tmpl = function(id) {
    return _.template( $('#'+ id).html() );
};

hp.getToken = function () {
    return settings._token; // from header.blade
};

hp.text = {
    kindBuyer: {
        del: 'Есть связанные данные с таблицей Контрагенты' // с таблицей Buyer
    }
    ,kindCost: {
        del: 'Есть связанные данные с таблицей Взиморасчеты' // с таблицей Buyer
    }
    ,place: {
        del: 'Есть связанные данные с таблицей Продажи' // с таблицей Order
    }
    ,confirmDel: 'Вы точно хотите это удалить?'
    ,noConnection: 'Нет соединения с сетью, попробуйте позже.'
};