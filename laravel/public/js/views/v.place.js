// вид одного
App.Views.Place = Backbone.View.extend({
    tagName: 'div'
    ,className: 'vOne'
    ,template: hp.tmpl('tmplPlace')
    ,templateEdit: hp.tmpl('tmplPlaceEdit')

    ,events: {
        'click .jEdit':   'drawEdit',
        'click .jChange': 'clickChange',
        'click .jDel':    'clickDel',
        'click .jCancel': 'clickCancel'
    }

    ,initialize: function () {
        log('init', 'view', 'Place', this);
        //this.model.on('sync', this.render, this); // сработает после измения модели на сервере
        //this.model.on('destroy', this.remove, this); // сработает после удаления на сервере
    }
    ,render: function () {
        log('render', 'view', 'Place', this.model.toJSON());
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
    ,remove: function () {
        log('remove', 'view', 'Place', this.$el);
        this.$el.remove();
    }
    ,drawEdit: function () {
        //console.log(this, arguments);
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
                vent.trigger('changedPlace', self.model);
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
            //,dataType:"text"
            ,success : function(model, data, obj) {
                // если потребуется можно вынести в отдельный метод!
                if (data.length) alert (hp.text.place.del);// если не могу удалить на сервере, возвращаю данные
                else self.remove();
            }
            ,error: function () {}
        });
        return false;
    }

    ,clickCancel: function (ev) {
        $(ev.target).val( this.model.get('name') );
        this.render();
    }

});

// список
App.Views.Places = Backbone.View.extend({
    tagName: 'div'
    ,className: 'vList'
    //,template: hp.tmpl('kindBuyerList')

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawBuyerEditor', {});
        }
    }
    ,initialize: function () {
        var self = this;
        //this.collection.on('all', this.test, this);
        this.collection.on('add', this.onSync , this); // сработает после добавление модели на сервер
    }

    ,test: function (model) {
        console.log(arguments);
    }

    ,onSync: function (model) {
        this.addOne(model);
    }

    ,render: function () {
        this.collection.each(this.addOne, this);
        return this;
    }
    ,addOne: function (model) {
        var view = new App.Views.Place({model: model});
        this.$el.append( view.render().el );
    }
});

// добавить - отдельный вид
App.Views.AddPlace = Backbone.View.extend({

    events: {
        'click .jAdd': 'clickAdd'
    }
    ,initialize: function () {

    }

    ,clickAdd: function () {
        log('add', 'view', 'AddPlace');
        var self = this;

        settings.cPlaces.create(this.newAttributes(), {
            wait:true
            ,success : function() {
                self.$el.find('[name="name"]').val('');
                log('addSuccess', 'view', 'AddPlace');
            }
            ,error: function () {}
        });

        return false;
    }

    ,newAttributes: function () {
        return {
            name: this.$el.find('[name="name"]').val()
            ,_token: hp.getToken()
        }
    }

});