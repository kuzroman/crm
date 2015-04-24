$(function () {
    pMutualCalc.init();
});

pMutualCalc = {};

pMutualCalc.init = function () {
    this.html.init();
    this.event();

    var view = new App.Views.MutualCalcs({collection: settings.cMutualCalcs});
    //console.log('view', view);
    this.html.box.html(view.render().el);
};

pMutualCalc.html = {
    init: function () {
        this.body = $('body');
        this.box = $('#mutualCalcsBox'); // список покупателей
    }

    ,vEdit: null
};

pMutualCalc.event = function () {
    var self = this;

    vent.on('drawOrderEditor', function () {
        self.drawEditor(arguments[0]['view'], arguments[0]['model']);
        //console.log(arguments[0]['view'], arguments[0]['model']);
    })
};

pMutualCalc.drawEditor = function (view, model) {
    //console.log(arguments);

    var innerModel = model ? model : new App.Models.Order;
    var vEditor = new App.Views.OrderEditor({model: innerModel});

    var top = view ? view.$el.offset().top + view.$el.height() : $('.vOrders').offset().top + 29;
    var left = view ? view.$el.offset().left : $('.vOrders').offset().left;
    vEditor.$el.css({top:top, left:left});

    if (pMutualCalc.html.vEdit) pMutualCalc.html.vEdit.remove();
    pMutualCalc.html.vEdit = vEditor;
    $('body').append(vEditor.render().el);
};

//pMutualCalc.startRouts = function () {
//    //console.log('startRouts');
//    new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
