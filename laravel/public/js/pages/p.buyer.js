$(function () {
    pBuyer.init();
});

// отключаем все консоли разом
//console.log = function() {};

pBuyer = {

};

pBuyer.init = function () {

    this.html.init();
    this.event();

    // в коллекцию обычно передается массив данных с сервера
    var view = new App.Views.Buyers({collection: settings.cBuyers});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.box.html(view.render().el);
};

pBuyer.html = {
    init: function () {
        this.body = $('body');
        this.box = $('#buyersBox'); // список покупателей
    }

    ,vEdit: null
};

pBuyer.event = function () {
    var self = this;

    vent.on('drawBuyerEditor', function () {
        self.drawEditor(arguments[0]['view'], arguments[0]['model']);
        //console.log(arguments[0]['view'], arguments[0]['model']);
    })
};

pBuyer.drawEditor = function (view, model) {
    //console.log(arguments);

    var innerModel = model ? model : new App.Models.Buyer;
    var vEditor = new App.Views.BuyerEditor({model: innerModel});

    var top = view ? view.$el.offset().top + view.$el.height() : $('.vBuyers').offset().top + 29;
    var left = view ? view.$el.offset().left : $('.vBuyers').offset().left;
    vEditor.$el.css({top:top, left:left});

    if (pBuyer.html.vEdit) pBuyer.html.vEdit.remove();
    pBuyer.html.vEdit = vEditor;
    $('body').append(vEditor.render().el);
};

//pBuyer.startRouts = function () {
//    //console.log('startRouts');
//    new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
