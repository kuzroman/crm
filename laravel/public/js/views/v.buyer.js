// вид одного
App.Views.Buyer = Backbone.View.extend({
    tagName: 'ul'
    ,className: 'vBuyer'
    ,template: hp.tmpl('tmplBuyer')

    ,events: {
        'click .jEdit': function () {
            vent.trigger('drawBuyerEditor', {view:this, model:this.model} );
        }
    }
    ,initialize: function () {
        this.model.on('sync', this.render, this); // сработает после измения модели на сервере
        // при смене kindName в модели (делал чтобы менять из другого вида)
        this.model.on('change:kindName', this.render, this);

        //this.model.on('all', this.test, this);
        this.model.on('destroy', this.remove, this); // сработает после удаления на сервере

        //vent.on('changeKindBuyer', function (mKindBuyer) {
        //    console.log('changeKindBuyer', mKindBuyer);
        //});
    }
    ,render: function () {
        //console.log('render vBuyer');
        //console.log('render', this, arguments);
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
    ,remove: function () {
        this.$el.remove();
    }
    //,onSync:function () {
    //    this.render();
    //    vent.trigger('changeKindBuyer', this);
    //}
});

// список
App.Views.Buyers = Backbone.View.extend({
    tagName: 'div'
    ,className: 'vBuyers'
    ,template: hp.tmpl('tmplBuyers')

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawBuyerEditor', {});
        }
    }
    ,initialize: function () {
        log('init', 'view', 'Buyers', this);
        var self = this;
        this.collection.on('add', this.onSync , this); // сработает после добавление модели на сервер
    }
    ,onSync: function (model) {
        //console.log('onSync', model);
        this.addOne(model);
    }
    ,render: function () {
        this.$el.html( this.template() );
        this.collection.each(this.addOne, this);
        return this;
    }
    ,addOne: function (modelBuyer) {
        var viewBuyer = new App.Views.Buyer({model: modelBuyer});
        this.$el.find('#buyersList').append( viewBuyer.render().el );
    }
});

App.Views.BuyerEditor = Backbone.View.extend({
    tagName: 'form'
    ,className: 'vBuyerEditor editor'
    ,template: hp.tmpl('tmplBuyerEdit')

    ,events: {
        'click .jClose': 'clickClose',
        'click .jAdd': 'clickAdd',
        'click .jChange': 'clickChange',
        'click .jDel': 'clickDel'
    }

    ,initialize: function () {
        //console.log(this, arguments);
    }
    ,render: function () {
        this.$el.html( this.template( this.model.toJSON() ) );
        return this;
    }
    ,clickClose: function () {
        this.remove();
    }

    ,clickAdd: function () {
        var self = this;
        this.setData();
        settings.cBuyers.create(this.model, {
            wait:true
            ,success : function() { self.remove() }
            ,error: function () {}
        });
        return false;
    }

    ,clickChange: function () {
        var self = this;
        this.setData();
        this.model.save([], {
            wait:true, dataType:"text"
            ,success : function() { self.remove() }
            ,error: function () {}
        });
        return false;
    }

    ,setData: function () {
        var dataForm = this.$el.serializeArray();
        for (var num in dataForm) {
            if (dataForm.hasOwnProperty(num)) {
                var obj = dataForm[num];
                // может быть стоит обновлять объекст а потом его передавать в save модели?
                // будет ли в таком случае работать валидация?
                this.model.set(obj['name'], obj['value']);
            }
        }
    }

    ,clickDel: function () {
        var self = this;
        this.model.destroy({
            data: { _token: hp.getToken() }, processData: true,
            wait:true, dataType:"text"
            ,success : function() { self.remove() }
            ,error: function () {}
        });
        return false;
    }
});