$(function () {
    pPlace.init();
});

// отключаем все консоли разом
//console.log = function() {};

pPlace = {
    //cKindBuyers: {} // коллекция - всегда доступна
};

pPlace.init = function () {

    this.html.init();
    this.event();

    var model = new App.Models.Place();
    new App.Views.AddPlace({el:'#addPlace',model:model}); // связываем панель добавления вида продавкца в DOM

    // в коллекцию обычно передается массив данных с сервера
    //this.cKindBuyers = new App.Collections.KindBuyers(settings.kindBuyerJSON);
    var vList = new App.Views.Places({collection: settings.cPlaces});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.list.html(vList.render().el);

};

pPlace.html = {
    init: function () {
        this.body = $('body');
        this.list = $('#placesBox'); // список
    }

    //,vEdit: null
};

pPlace.event = function () {

};


//pPlace.startRouts = function () {
//    //console.log('startRouts');
//    //new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
