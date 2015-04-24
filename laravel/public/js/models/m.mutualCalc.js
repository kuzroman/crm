// модель Buyer зависит от данных settings.kindBuyerJSON
App.Models.MutualCalc = Backbone.Model.extend({
    urlRoot: 'mutualcalc'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        date: Date.create(new Date(), 'ru').format('{yyyy}-{MM}-{dd}')
        ,dateRus: ''
        ,sum: ''
        ,id_order: ''
        ,id_buyer: ''
        ,id_employee: ''
        ,id_kindCost: ''

        ,edit: true // если тру появится кнопка редактировать
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        var self = this;

        this.setDateRus();

        this.on('change:id_buyer', this.setBuyerName, this);
        this.on('change:id_place', this.setPlaceName, this);
        this.on('change:dateRus', this.setDateForBackend, this);

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
        this.set('dateRus', Date.create(this.get('date')).format(format));
    }
    ,setDateForBackend: function () {
        var format = '{yyyy}-{MM}-{dd}';
        this.set('date', Date.create(this.get('dateRus'), 'ru').format(format));
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