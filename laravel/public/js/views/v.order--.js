// вид одного заказа
App.Views.Order = Backbone.View.extend({
    tagName: 'ul'
    ,className: 'vOrder'
    ,template: hp.tmpl('tmplOrder')

    ,events: {
        'click .jEdit': 'clickEdit'
    }

    ,initialize: function () {}

    ,render: function () {
        this.model.setDateRus();
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }

    ,clickEdit: function () {
        vent.trigger('vOrder:drawOrderEditor', this);
    }

});

// список заказов
// родительский элемент управляет видами, слушает их события отрисовывает их
App.Views.Orders = Backbone.View.extend({
    tagName: 'div'
    ,className: 'vOrders silver'

    ,param: {
        currentEditingOrder: false // текущий редактируемый заказ
            // ,vOrderAdder: false // текущий добавляемый заказ
        ,vOrderEditor: false // вид редактируемого заказа
        ,mOrderHead: false // модель заголовка заказов
    }

    ,initialize: function () {
        var self = this;
        vent.on('vOrder:drawOrderEditor', function (view) { self.drawOrderEditor(view) } );
        vent.on('vOrder:drawOrderAdder', function (view) { self.drawOrderAdder(view) } );
        vent.on('vOrderEditor:reDrawOrder', function (view) { self.reDrawOrder(view) } );

        vent.on('cOrder:drawView', function(model) { self.drawAddedView(model) });

        this.param.mOrderHead = new App.Models.OrderHead(); // здесь - чтобы события этой модели сработали
    }

    ,render: function () {
        this.collection.each( this.addOne, this); // this - передает контекст
        this.addHead();
        return this;
    }
    ,addOne: function (mOrder) {
        var vOrder = new App.Views.Order({model: mOrder});
        this.$el.append( vOrder.render().el );
    }
    ,addHead: function () {
        var vOrderHead = new App.Views.OrderHead({model:this.param.mOrderHead});
        this.$el.prepend( vOrderHead.render().el );
    }

    ,drawOrderEditor: function (view) {
        vent.off('toChangeBuyerInOrder'); // удалим чтобы не множились
        if (this.param.vOrderEditor) this.param.vOrderEditor.remove(); // удалим прежний редактор
        this.param.currentEditingOrder = view;
        var vOrderEditor = this.param.vOrderEditor = new App.Views.OrderEditor({model: view['model']});
        var top = view.$el.offset().top + view.$el.height();
        var left = view.$el.offset().left;
        var obj = {top:top,left:left}; // сдвиг происходит из за правой полосы прокрутки
        home.html.editorBox.css(obj).append(vOrderEditor.render().el);
    }

    ,drawOrderAdder: function (view) {
        //console.log(view); // view указывает на шапку таблицы

        vent.off('toChangeBuyerInOrder'); // удалим чтобы не множились
        // вид одинаковый, так что фактически работаем с одним блоком vOrderEditor
        if (this.param.vOrderEditor) this.param.vOrderEditor.remove();
        var vOrderEditor = this.param.vOrderEditor = new App.Views.OrderAdder({model: new App.Models.Order });
        var top = view.$el.offset().top + view.$el.height();
        var left = view.$el.offset().left;
        var obj = {top:top,left:left}; // сдвиг происходит из за правой полосы прокрутки
        home.html.editorBox.css(obj).prepend(vOrderEditor.render().el);
    }

    ,reDrawOrder: function (view) {
//        console.log(view);
        var order = new App.Views.Order({model:view['model']});
        this.param.currentEditingOrder.$el.after( order.render().$el );
        this.param.currentEditingOrder.remove();
    }
    
    ,drawAddedView: function (mOrder) {
        var order = new App.Views.Order({model: mOrder});
        // todo необходимо разделение шапки и вида со списком, чтобы можно было делать preppend!
        home.html.ordersBox.append(order.render().el);
    }


});

App.Views.OrderHead = Backbone.View.extend({
    tagName:'ul'
    ,className:'vHead'
    ,template: hp.tmpl('tmplOrderHead')

    ,events: {
        'click .jAdd' : 'clickAdd'
    }

    ,initialize: function () {
        
    }

    ,render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }

    ,clickAdd: function () {
        // считаю что превиксы перед методом типа vOrderHead: могут сбить с толку
        // если мы переместим кнопку в другую область (вид)
        vent.trigger('vOrder:drawOrderAdder', this);
    }

});