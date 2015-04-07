$(function () {
    pEmployee.init();
});

// отключаем все консоли разом
//console.log = function() {};

pEmployee = {
    //cKindBuyers: {} // коллекция - всегда доступна
};

pEmployee.init = function () {

    this.html.init();
    this.event();

    // модель добавления
    //var model = new App.Models.Employee();
    //new App.Views.AddEmployee({model:model});

    // в коллекцию обычно передается массив данных с сервера
    //this.cKindBuyers = new App.Collections.KindBuyers(settings.kindBuyerJSON);
    var vList = new App.Views.Employees({collection: settings.cEmployees});
    vList.render();

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    // отрисовку делать в конце, когда все экземпляры инициализированы
    //this.html.list.html(vList.render().el);
};

pEmployee.html = {
    init: function () {
        //this.body = $('body');
        //this.list = $('#employeesBox'); // список
    }

    //,vEdit: null
};

pEmployee.event = function () {

};


//pEmployee.startRouts = function () {
//    //console.log('startRouts');
//    //new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
