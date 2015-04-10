$(function() {
    var vList = new App.Views.Orders({collection: settings.cOrders});
    vList.render();
});

// вид одного
App.Views.Order = Backbone.View.extend({
    tagName: 'tr'
    ,className: 'vOne'
    ,template: hp.tmpl('tmplOrder')
    ,templateEdit: hp.tmpl('tmplOrderEdit')

    ,events: {
        //'click .jEdit': function () {
        //    vent.trigger('drawOrderEditor', {view:this, model:this.model} );
        //}
        'click .jEdit':   'drawEdit',
        'click .jChange': 'clickChange',
        'click .jDel':    'clickDel',
        'click .jCancel': 'clickCancel'
    }
    ,initialize: function () {
        //this.model.on('sync', this.render, this); // сработает после измения модели на сервере
        //this.model.on('destroy', this.remove, this); // сработает после удаления на сервере
    }
    ,render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
    ,remove: function () {
        this.$el.remove();
    }


    ,drawEdit: function () {
        this.$el.html(this.templateEdit(this.model.toJSON()));
        return this;
    }
    ,clickChange: function () {
        var self = this;
        this.model.set('name', this.$el.find('input').val() );
        this.model.save([], {
            wait:true, dataType:"text"
            ,success : function() {
                self.render();
                vent.trigger('changedOrder', self.model);
            }
            ,error: function () {}
        });
        return false;
    }
    ,clickDel: function () {
        if (!confirm(hp.text.confirmDel)) return;

        var self = this;
        this.model.destroy({
            data: { _token: hp.getToken },processData: true,
            wait:true
            ,success : function(model, data, obj) {
                // если потребуется можно вынести в отдельный метод!
                if (data.length) alert ('Какой то текст');// если не могу удалить на сервере, возвращаю данные
                else self.remove();
            }
            ,error: function () {}
        });
        return false;
    }
    ,clickCancel: function () {
        this.render();
    }
});

// список
App.Views.Orders = Backbone.View.extend({
    el: '#ordersBox'
    ,className: 'vList'

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawOrderEditor', {});
        }
    }
    ,initialize: function () {
        // приципить модель добавления
        var model = new App.Models.Order();
        console.log('model', model);
        new App.Views.AddOrder({el:'#addOrder',model:model});

        this.collection.on('add', this.onSync , this); // сработает после добавление модели на сервер
    }

    ,onSync: function (model) {
        this.addOne(model);
    }
    ,render: function () {
        this.collection.each(this.addOne, this);
        return this;
    }
    ,addOne: function (model) {
        var view = new App.Views.Order({model: model});
        this.$el.append( view.render().el );
    }
});

// добавить - отдельный вид
App.Views.AddOrder = Backbone.View.extend({
    el: '#addOrder'
    ,templateEdit: hp.tmpl('tmplOrderEdit')

    ,events: {
        'click .jAdd': 'clickAdd'
    }
    ,initialize: function () {
        this.render();
    }

    ,render: function () {
        this.$el.html(this.templateEdit(this.model.toJSON()));
        return this;
    }
    ,clickAdd: function () {
        var self = this;
        settings.cPlaces.create(this.newAttributes(), {
            wait:true
            ,success : function() {
                self.$el.find('input, textarea').val('');
            }
            ,error: function () {}
        });
        return false;
    }
    ,newAttributes: function () {
        return {
            dateCreatedRus: this.$el.find('[name="dateCreatedRus"]').val()
            ,buyerName: this.$el.find('[name="buyerName"]').val()
            ,desc: this.$el.find('[name="desc"]').val()
            ,placeName: this.$el.find('[name="placeName"]').val()
            ,cash: this.$el.find('[name="cash"]').val()
            ,price: this.$el.find('[name="price"]').val()
            ,paid: this.$el.find('[name="paid"]').val()
            ,dateCompletedRus: this.$el.find('[name="dateCompletedRus"]').val()
            ,finished: this.$el.find('[name="finished"]').val()
            ,_token: hp.getToken()
        }
    }
});


App.Views.BuyersSelect = Backbone.View.extend({

});