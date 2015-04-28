// модель Buyer зависит от данных settings.kindBuyerJSON
App.Models.Buyer = Backbone.Model.extend({
    urlRoot: 'buyer'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        name: ''
        ,id_kind: ''
        ,about: ''
        ,contact: ''
        ,cell_1: ''
        ,cell_2: ''
        ,email: ''
        ,kindName: '' // данные из др табл

        ,edit: true // если тру появится кнопка редактировать
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        var self = this;
        //this.on('invalid', function (model, error) {console.log(error);});
        //this.on('sync', this.onModelAll, this);
        //this.on('request', this.onChange, this);
        this.on('error', this.onError, this);

        vent.on('changedKindBuyer', function (mKindBuyer) {
            self.changeKind(mKindBuyer);
        });

        this.on('change:id_kind', this.setKindName, this);
    }

    ,setKindName: function () {
        var id = this.get('id_kind')
            ,mKindBuyer = settings.cKindBuyers.get(id)
            ,model = mKindBuyer.get('name');
        this.set('kindName', model);
    }

    ,changeKind: function (mKindBuyer) {
        if (this.get('id_kind') == mKindBuyer.id ) {
            this.set('kindName', mKindBuyer.get('name') )
        }
    }

    ,onError: function () {
        alert (hp.text.noConnection);
    }

    ,validate: function (attrs, options) {
        if (!$.trim(attrs.name) ) {
            return "Передано пустое значение";
        }
    }

});