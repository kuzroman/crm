$(function () {
    pKindBuyer.init();
});

// отключаем все консоли разом
//console.log = function() {};

pKindBuyer = {
    //cKindBuyers: {} // коллекция - всегда доступна
};

pKindBuyer.init = function () {

    this.html.init();
    this.event();

    var model = new App.Models.KindBuyer();
    new App.Views.AddKindBuyer({el:'#addKindBuyer',model:model}); // связываем панель добавления вида продавкца в DOM

    // в коллекцию обычно передается массив данных с сервера
    //this.cKindBuyers = new App.Collections.KindBuyers(settings.kindBuyerJSON);
    var vList = new App.Views.KindBuyers({collection: settings.cKindBuyers});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.list.html(vList.render().el);

};

pKindBuyer.html = {
    init: function () {
        this.body = $('body');
        this.list = $('#kindBuyersBox'); // список
    }

    //,vEdit: null
};

pKindBuyer.event = function () {

};


//pKindBuyer.startRouts = function () {
//    //console.log('startRouts');
//    //new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
