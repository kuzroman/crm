// вид одного
App.Views.MutualCalc = Backbone.View.extend({
    tagName: 'tr'
    ,className: 'vMutualCalc'
    ,template: hp.tmpl('tmplMutualCalc')

    ,events: {
        'click .jEdit': function () {
            vent.trigger('drawMutualCalcEditor', {view:this, model:this.model} );
        }
    }
    ,initialize: function () {
        this.model.on('sync', this.render, this); // сработает после измения модели на сервере
        // при смене kindName в модели (делал чтобы менять из другого вида)
        //this.model.on('change:kindName', this.render, this);

        this.model.on('destroy', this.remove, this); // сработает после удаления на сервере
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
});

// список
App.Views.MutualCalcs = Backbone.View.extend({
    tagName: 'table'
    ,className: 'vMutualCalcs silver'
    ,template: hp.tmpl('tmplMutualCalcs')

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawMutualCalcEditor', {});
        }
    }
    ,initialize: function () {
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
    ,addOne: function (model) {
        var view = new App.Views.MutualCalc({model: model});
        this.$el.find('#mutualCalcsList').append( view.render().el );
    }
});

App.Views.MutualCalcEditor = Backbone.View.extend({
    tagName: 'form'
    ,className: 'vMutualCalcEditor editor'
    ,template: hp.tmpl('tmplMutualCalcEdit')
    ,events: {
        'click .jClose': 'clickClose',
        'click .jAdd': 'clickAdd',
        'click .jChange': 'clickChange',
        'click .jDel': 'clickDel',

        'change .jChangeRecipient': 'changeRecipient'
    }

    ,initialize: function () {
        //console.log(this, arguments);
    }
    ,render: function () {
        this.$el.html( this.template( this.model.toJSON() ) );
        this.$el.find('[type="ui_date"]').datepicker({dateFormat: "dd.mm.yy", language: "ru"});
        return this;
    }
    ,clickClose: function () {
        this.remove();
    }

    ,clickAdd: function () {
        var self = this;
        this.setData();
        settings.cMutualCalcs.create(this.model, {
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
    
    ,changeRecipient: function (event) {
        var buyer = this.$el.find('.jEditIdBuyer')
            ,employee = this.$el.find('.jEditIdEmployee')
        ;

        if ($(event.target).hasClass('jEditIdBuyer') ) employee.val('');
        else buyer.val('');
    }


});