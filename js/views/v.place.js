$(function() {
    var vList = new App.Views.Places({collection: settings.cPlaces});
    vList.render();
});

// вид одного
App.Views.Place = Backbone.View.extend({
    tagName: 'tr'
    ,className: 'vOne'
    ,template: hp.tmpl('tmplPlace')
    ,templateEdit: hp.tmpl('tmplPlaceEdit')

    ,events: {
        'click .jEdit':   'drawEdit',
        'click .jChange': 'clickChange',
        'click .jDel':    'clickDel',
        'click .jCancel': 'clickCancel'
    }
    ,initialize: function () {}

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
            ,success : function(model, data, obj) {
                // если потребуется можно вынести в отдельный метод!
                if (data.length) alert (hp.text.place.del);// если не могу удалить на сервере, возвращаю данные
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
App.Views.Places = Backbone.View.extend({
    el: '#placesBox'
    ,className: 'vList'

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawBuyerEditor', {});
        }
    }
    ,initialize: function () {
        // приципить модель добавления
        var model = new App.Models.Place();
        new App.Views.AddPlace({el:'#addPlace',model:model});

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
        var view = new App.Views.Place({model: model});
        this.$el.append( view.render().el );
    }
});

// добавить - отдельный вид
App.Views.AddPlace = Backbone.View.extend({
    el: '#addPlace'
    ,events: {
        'click .jAdd': 'clickAdd'
    }
    ,initialize: function () {}

    ,clickAdd: function () {
        var self = this;
        settings.cPlaces.create(this.newAttributes(), {
            wait:true
            ,success : function() {
                self.$el.find('[name="name"]').val('');
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