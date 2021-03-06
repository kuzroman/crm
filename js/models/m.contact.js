App.Models.Contact = Backbone.Model.extend({
    urlRoot: 'contact'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        name: ''
        ,cell_1: ''
        ,cell_2: ''
        ,email: ''

        ,edit: true
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        this.on('error', this.onError, this);
        this.on('invalid', this.onInvalid, this);
    }

    ,onError: function () {
        alert (hp.text.noConnection);
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