App.Models.OrderHead = Backbone.Model.extend({
    defaults: {
        adding: false // есть ли кнопка добавление
    }

    ,initialize : function () {
        var self = this;

        // прослушка роута
        vent.on('rHome:edit', function () { self.set({adding:true}); });
    }

});

App.Models.Order = Backbone.Model.extend({
    defaults: {
        //id: '', // backbone, видя айдишник автоматически добавляет его в урл и меняет запрос на put (вместо post) , при вызове метода save. Id должен добавляться SQL автоматически.
        created: '' // дата начала для базы
        ,created_rus: '' // для сайта
        ,id_buyer: false
        ,b_name: 'Название'
        ,desc: 'Описание'
        ,cash: false
        ,price: 0
        ,paid: false
        ,completed: ''
        ,completed_rus: ''
        ,finished: false

        ,editing: false // если тру появится кнопка редактировать
    },

    url: '/order',

    setDateRus: function () {
        var format = '{dd}.{MM}.{yyyy}';
        this.set('created_rus', Date.create(this.get('created')).format(format));
        this.set('completed_rus', Date.create(this.get('completed')).format(format));
    },
    setDateForBackend: function () {
        var format = '{yyyy}-{MM}-{dd}';
        this.set('created', Date.create(this.get('created_rus'), 'ru').format(format));
        this.set('completed', Date.create(this.get('completed_rus'), 'ru').format(format));
    },

    initialize : function () {
        var self = this;

        // прослушка роута
        vent.on('rHome:edit', function () { self.set({editing:true}); });
    }

    ,validate: function (attrs, options) {
        // выполняется при save (для set: order.set({'price':0}, {validate : true}); )
        var errors = {};

        if (!attrs.created_rus) {
            errors.created_rus = 'Введите дату';
        }
        if (!attrs.completed_rus) {
            errors.completed_rus = 'Введите дату';
        }

        //console.log('App.Models.Order.validate.error - ', errors);

        if(_.keys(errors).length > 0) {
            // вывести текс напротив input где есть ошибка
            vent.trigger('mOrder:errorAdding', errors);
            return errors;
        }

//        if (!attrs.buyer.length) {
//            errors.buyer = 'Введите название компании.';
//        }
//        if (!attrs.desc.length) {
//            errors.desc = 'Введите описание компании.';
//        }
//
//        var price = attrs.price;
//        if (!price.length || price <= 0) {
//            errors.price = 'Введите цену';
//        }
//
//        console.log('App.Models.Order.validate.error - ', errors);
//
//        if(_.keys(errors).length > 0) {
//            return errors;
//        }

    }

});