$(function () {
  home.init();
});

// отключаем все консоли разом
//console.log = function() {};

home = {
  ordersJSON: ordersJSON // ordersJSON from app\views\template\order.blade.php
  , cOrders: null

  //,buyersJSON: buyersJSON // buyersJSON from app\views\template\buyer.blade.php
  , cBuyers: null
};

home.init = function () {

  this.html.init();
  this.event();

  // в коллекцию обычно передается массив данных с сервера
  this.cOrders = new App.Collections.Orders(this.ordersJSON);
  var viewOrders = new App.Views.Orders({collection: this.cOrders});

  // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
  this.startRouts(); // с этого момента срабатывают события в роутах!

  // отрисовку делать в конце, когда все экземпляры инициализированы
  this.html.ordersBox.html(viewOrders.render().el);

};

home.html = {
  init: function () {
    this.body = $('body');
    this.editorBox = $('#editorBox');
    this.ordersBox = $('#ordersBox'); // список заказов
    //this.buyersBox = $('#buyersBox'); // список покупателей
  }
};

home.event = function () {
  var self = this;

  // показать данные о покупателях
  vent.on('vOrderEditor:drawBuyers', function () {
    // если к данным уже обращались то показываем их
    if (self.cBuyers) {
      vent.trigger('showBuyers');
    }
    // иначе запрашиваем
    else {
      self.fetchBuyers();
    }
  });

  // данные покупателей получены
  vent.on('pHome:fetchBuyersDone', function () {
    self.drawBuyers();
  });
};

home.fetchBuyers = function () {
  this.cBuyers = new App.Collections.Buyers();
  var deferred = this.cBuyers.fetch();

  deferred.done(function () {
    vent.trigger('pHome:fetchBuyersDone');
  });
};

home.drawBuyers = function () {
  var viewBuyers = new App.Views.Buyers({collection: this.cBuyers});
  this.html.editorBox.append(viewBuyers.render().el);
};

home.startRouts = function () {
  console.log('startRouts');
  new App.Router.Home();
  Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
};
