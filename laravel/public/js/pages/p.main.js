$(function () {
    pMain.init();
});

pMain = {
    cBuyers: {} // коллекция - всегда доступна
};

pMain.init = function () {
    this.html.init();
    this.event();

};

pMain.html = {
    init: function () {
        this.body = $('body');

    }

    ,vEditBuyer: null
};

pMain.event = function () {
    var self = this;


};




pMain.startRouts = function () {
    //console.log('startRouts');
    //new App.Router.Buyer();
    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
};
