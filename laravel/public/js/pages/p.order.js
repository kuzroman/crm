$(function () {
    pOrder.init();
});

// отключаем все консоли разом
//console.log = function() {};

pOrder = {

};

pOrder.init = function () {

    this.html.init();
    this.event();

    // в коллекцию обычно передается массив данных с сервера
    var view = new App.Views.Orders({collection: settings.cOrders});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    //console.log(view);

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.box.html(view.render().el);
};

pOrder.html = {
    init: function () {
        this.body = $('body');
        this.box = $('#ordersBox'); // список покупателей
    }

    ,vEdit: null
};

pOrder.event = function () {
    var self = this;

    vent.on('drawOrderEditor', function () {
        self.drawEditor(arguments[0]['view'], arguments[0]['model']);
        //console.log(arguments[0]['view'], arguments[0]['model']);
    })
};

pOrder.drawEditor = function (view, model) {
    //console.log(arguments);

    var innerModel = model ? model : new App.Models.Order;
    var vEditor = new App.Views.OrderEditor({model: innerModel});

    var top = view ? view.$el.offset().top + view.$el.height() : $('.vOrders').offset().top + 29;
    var left = view ? view.$el.offset().left : $('.vOrders').offset().left;
    vEditor.$el.css({top:top, left:left});

    if (pOrder.html.vEdit) pOrder.html.vEdit.remove();
    pOrder.html.vEdit = vEditor;
    $('body').append(vEditor.render().el);
};

//pOrder.startRouts = function () {
//    //console.log('startRouts');
//    new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
