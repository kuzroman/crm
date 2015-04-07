App.Models.Employee = Backbone.Model.extend({
    urlRoot: 'employee'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        name: ''
        ,salary: ''
        ,isWork: ''

        ,edit: ''
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        this.on('error', this.onError, this);
        this.on('invalid', this.onInvalid, this);
    }

    ,onError: function () {
        alert (hp.text.noConnection);
    }

    ,validate: function (attrs, options) {
        if (!$.trim(attrs.name) ) {
            return "Передано пустое значение";
        }
    }
    ,onInvalid: function (model, text, objValid) {
        alert(text);
    }

});