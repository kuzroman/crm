$(function() {
    var vList = new App.Views.KindCosts({collection: settings.cKindCosts});
    vList.render();
});

// вид одного
App.Views.KindCost = Backbone.View.extend({
    tagName: 'tr'
    ,className: 'vOne'
    ,template: hp.tmpl('tmplKindCost')
    ,templateEdit: hp.tmpl('tmplKindCostEdit')

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
                vent.trigger('changedKindCost', self.model);
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
                if (data.length) alert (hp.text.kindCost.del);// если не могу удалить на сервере, возвращаю данные
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
App.Views.KindCosts = Backbone.View.extend({
    el: '#kindCostsBox'
    ,className: 'vList'

    ,events: {
        'click .jAdd': function () {
            vent.trigger('drawCostEditor', {});
        }
    }
    ,initialize: function () {
        // приципить модель добавления
        var model = new App.Models.KindCost();
        new App.Views.AddKindCost({el:'#addKindCost',model:model});

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
        var view = new App.Views.KindCost({model: model});
        this.$el.append( view.render().el );
    }
});

// добавить - отдельный вид
App.Views.AddKindCost = Backbone.View.extend({
    el: '#addKindCost'
    ,events: {
        'click .jAdd': 'clickAdd'
    }
    ,initialize: function () {}

    ,clickAdd: function () {
        var self = this;

        settings.cKindCosts.create(this.newAttributes(), {
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