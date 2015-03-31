var hp = {};

/* упощаем доступ к шаблонам */
hp.tmpl = function(id) {
    return _.template( $('#'+ id).html() );
};

hp.getToken = function () {
    return settings._token; // from header.blade
};

hp.text = {
    buyer: {
        del: 'Есть связанные данные с таблицей Покупателей'
    }
};