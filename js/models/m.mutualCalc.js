// модель Buyer зависит от данных settings.kindBuyerJSON
App.Models.MutualCalc = Backbone.Model.extend({
    urlRoot: 'mutualcalc'

    ,defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post)
        // при вызове метода save. Id должен добавляться SQL автоматически.
        id_order: ''
        // дата фактического поступления/списания средств
        ,date: Date.create(new Date(), 'ru').format('{yyyy}-{MM}-{dd}')
        ,dateRus: ''
        ,sum: ''
        ,desc: ''

        ,id_buyer: ''
        ,id_employee: ''
        ,id_kindcost: ''

        ,orderDateCreated: ''
        ,orderDateCreatedRus: ''
        ,buyerName: ''
        ,employeeName: ''
        ,kindCostName: ''
        ,recipientName: ''

        ,edit: true // если тру появится кнопка редактировать
        ,_token: hp.getToken()
    }

    ,initialize : function () {
        var self = this;

        this.setDateRus();
        this.setRecipient();
        this.setKindCostName();

        this.on('change:dateRus', this.setDateForBackend, this);
        this.on('change:id_kindcost', this.setKindCostName, this);

        this.on('change:id_buyer', this.setRecipient, this);
        this.on('change:id_employee', this.setRecipient, this);

        this.on('error', this.onError, this);
        this.on('invalid', this.onInvalid, this);
    }

    ,setKindCostName: function () {
        var id = this.get('id_kindcost')
            ,model = settings.cKindCosts.get(id)
            ,field = model.get('name');
        this.set('kindCostName', field);
    }

    ,setDateRecipient: function (p1, id, obj) {
        //console.log(id);
        //var model = settings.cBuyers.get(id)
        //    ,field = model.get('name');
        //this.set('recipientName', field);
    }

    ,setRecipient: function () {
        if ( this.get('id_buyer') ) {
            var id = this.get('id_buyer')
            ,model = settings.cBuyers.get(id)
            ,field = model.get('name');
        }
        else if ( this.get('id_employee') ) {
            id = this.get('id_employee');
            model = settings.cEmployees.get(id);
            field = model.get('name');
        }
        this.set('recipientName', field);

        //var buyerName = this.get('buyerName')
        //    ,employeeName = this.get('employeeName')
        //;
        //this.set('recipientName', (buyerName || employeeName || '') );
    }

    ,setDateRus: function () {
        var format = '{dd}.{MM}.{yyyy}';
        this.set('dateRus', Date.create(this.get('date')).format(format));
        this.set('orderDateCreatedRus', Date.create(this.get('orderDateCreated')).format(format));
    }
    ,setDateForBackend: function () {
        var format = '{yyyy}-{MM}-{dd}';
        this.set('date', Date.create(this.get('dateRus'), 'ru').format(format));
        //this.set('orderDateCreated', Date.create(this.get('orderDateCreatedRus'), 'ru').format(format));
    }

    ,validate: function (attrs, options) {
        if (!$.trim(attrs.sum) ) {
            return "Укажите сумму";
        }
    }

    ,onError: function () {
        alert (hp.text.noConnection);
    }
    ,onInvalid: function (model, text, objValid) {
        alert(text);
    }

});