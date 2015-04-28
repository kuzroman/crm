// модель Buyer зависит от данных settings.kindBuyerJSON
App.Models.Order = Backbone.Model.extend({
    urlRoot: 'order'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        dateCreated: Date.create(new Date(), 'ru').format('{yyyy}-{MM}-{dd}')
        ,dateCreatedRus: ''
        ,id_buyer: ''
        ,buyerName: ''
        ,desc: ''
        ,id_place: ''
        ,placeName: ''
        ,cash: ''
        ,price: ''
        ,paid: ''
        ,dateCompleted: Date.create(new Date(), 'ru').format('{yyyy}-{MM}-{dd}')
        ,dateCompletedRus: ''
        ,finished: ''

        ,edit: true // если тру появится кнопка редактировать
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        var self = this;

        this.setDateRus();

        this.on('change:id_buyer', this.setBuyerName, this);
        this.on('change:id_place', this.setPlaceName, this);
        this.on('change:dateCreatedRus', this.setDateForBackend, this);
        this.on('change:dateCompletedRus', this.setDateForBackend, this);

        this.on('request', this.onChangeModel, this);
        this.on('add', this.onChangeModel, this);

        this.on('error', this.onError, this);
        this.on('invalid', this.onInvalid, this);
    }

    //,onChangeModel: function () {
    //    console.log('onChangeModel', this);
    //}

    ,setBuyerName: function () {
        var id = this.get('id_buyer')
            ,model = settings.cBuyers.get(id)
            ,field = model.get('name');
        this.set('buyerName', field);
    }

    ,setPlaceName: function () {
        var id = this.get('id_place')
            ,model = settings.cPlaces.get(id)
            ,field = model.get('name');
        this.set('placeName', field);
    }

    ,setDateRus: function () {
        var format = '{dd}.{MM}.{yyyy}';
        this.set('dateCreatedRus', Date.create(this.get('dateCreated')).format(format));
        this.set('dateCompletedRus', Date.create(this.get('dateCompleted')).format(format));
    }
    ,setDateForBackend: function () {
        var format = '{yyyy}-{MM}-{dd}';
        this.set('dateCreated', Date.create(this.get('dateCreatedRus'), 'ru').format(format));
        this.set('dateCompleted', Date.create(this.get('dateCompletedRus'), 'ru').format(format));
    }

    ,validate: function (attrs, options) {
        if (!$.trim(attrs.price) ) {
            return "Укажите цену работы";
        }
    }

    ,onError: function () {
        alert (hp.text.noConnection);
    }
    ,onInvalid: function (model, text, objValid) {
        alert(text);
    }

});