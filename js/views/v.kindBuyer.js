$(function() {
    var vList = new App.Views.KindBuyers({collection: settings.cKindBuyers});
    vList.render();
});

// вид одного
App.Views.KindBuyer = Backbone.View.extend({
    tagName: 'tr'
    ,className: 'vOne'
    ,template: hp.tmpl('tmplKindBuyer')
    ,templateEdit: hp.tmpl('tmplKindBuyerEdit')

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
                vent.trigger('changedKindBuyer', self.model);
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
                if (data.length) alert (hp.text.kindBuyer.del);// если не могу удалить на сервере, возвращаю данные
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
App.Views.KindBuyers = Backbone.View.extend({
    el: '#kindBuyersBox'
    ,className: 'vList'

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawBuyerEditor', {});
        }
    }
    ,initialize: function () {
        // приципить модель добавления
        var model = new App.Models.KindBuyer();
        new App.Views.AddKindBuyer({el:'#addKindBuyer',model:model});

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
        var view = new App.Views.KindBuyer({model: model});
        this.$el.append( view.render().el );
    }
});

// добавить - отдельный вид
App.Views.AddKindBuyer = Backbone.View.extend({
    el: '#addKindBuyer'
    ,events: {
        'click .jAdd': 'clickAdd'
    }
    ,initialize: function () {}

    ,clickAdd: function () {
        var self = this;
        settings.cKindBuyers.create(this.newAttributes(), {
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