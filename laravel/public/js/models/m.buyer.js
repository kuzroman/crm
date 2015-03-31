// модель Buyer зависит от данных settings.kindBuyerJSON
App.Models.Buyer = Backbone.Model.extend({
    urlRoot: 'buyer'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        name: ''
        ,id_kind: ''
        ,email: ''
        ,kindName: ''
        ,edit: true // если тру появится кнопка редактировать
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        log('init', 'model', 'mBuyer', this);
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
        var id_kind = this.get('id_kind')
            ,mKindBuyer = settings.cKindBuyers.get(id_kind)
            ,kind = mKindBuyer.get('kind');
        this.set('kindName', kind);
    }

    ,changeKind: function (mKindBuyer) {
        //console.log('changeKindBuyer', this.get('kind'), mKindBuyer );
        if (this.get('id_kind') == mKindBuyer.id ) {
            this.set('kindName', mKindBuyer.get('kind') )
        }
    }

    ,onError: function () {
        alert ('Нет соединения с сетью, попробуйте позже.');
    }

    ,validate: function (attrs, options) {

    }

});