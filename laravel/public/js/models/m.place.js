App.Models.Place = Backbone.Model.extend({
    urlRoot: 'place'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        name: ''
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        this.on('error', this.onError, this);
        this.on('invalid', this.onInvalid, this);
    }

    ,onError: function () {
        alert ('Нет соединения с сетью, попробуйте позже.');
    }
    ,onInvalid: function (model, text, objValid) {
        alert(text);
    }

    ,validate: function (attrs, options) {
        if (!$.trim(attrs.name) ) {
            return "Передано пустое значение";
        }
    }

});