$(function () {
    pKindCost.init();
});

// отключаем все консоли разом
//console.log = function() {};

pKindCost = {
    //cKindBuyers: {} // коллекция - всегда доступна
};

pKindCost.init = function () {

    this.html.init();
    this.event();

    var model = new App.Models.KindCost();
    new App.Views.AddKindCost({el:'#addKindCost',model:model}); // связываем панель добавления вида продавкца в DOM

    // в коллекцию обычно передается массив данных с сервера
    //this.cKindBuyers = new App.Collections.KindBuyers(settings.kindBuyerJSON);
    var vList = new App.Views.KindCosts({collection: settings.cKindCosts});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.list.html(vList.render().el);

};

pKindCost.html = {
    init: function () {
        //this.body = $('body');
        this.list = $('#kindCostsBox'); // список
    }

    //,vEdit: null
};

pKindCost.event = function () {

};


//pKindCost.startRouts = function () {
//    //console.log('startRouts');
//    //new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
