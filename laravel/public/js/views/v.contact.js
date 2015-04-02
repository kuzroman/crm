// вид одного
App.Views.Contact = Backbone.View.extend({
    tagName: 'ul'
    ,className: 'vContact'
    ,template: hp.tmpl('tmplContact')

    ,events: {
        'click .jEdit': function () {
            vent.trigger('drawContactEditor', {view:this, model:this.model} );
        }
    }
    ,initialize: function () {
        this.model.on('sync', this.render, this); // сработает после измения модели на сервере
        // при смене kindName в модели (делал чтобы менять из другого вида)
        this.model.on('change:kindName', this.render, this);

        //this.model.on('all', this.test, this);
        this.model.on('destroy', this.remove, this); // сработает после удаления на сервере

    }
    ,render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
    ,remove: function () {
        this.$el.remove();
    }
});

// список
App.Views.Contacts = Backbone.View.extend({
    tagName: 'div'
    ,className: 'vContacts'
    ,template: hp.tmpl('tmplContacts')

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawContactEditor', {});
        }
    }
    ,initialize: function () {
        log('init', 'view', 'Contacts', this);
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
        var model = new App.Views.Contact({model: modelBuyer});
        this.$el.find('#contactsList').append( model.render().el );
    }
});

App.Views.ContactEditor = Backbone.View.extend({
    tagName: 'form'
    ,className: 'vContactEditor editor'
    ,template: hp.tmpl('tmplContactEdit')

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
        settings.cContacts.create(this.model, {
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