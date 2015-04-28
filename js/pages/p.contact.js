$(function () {
    pContact.init();
});

pContact = {

};

pContact.init = function () {

    this.html.init();
    this.event();

    // в коллекцию обычно передается массив данных с сервера
    var view = new App.Views.Contacts({collection: settings.cContacts});

    // в роутах есть тригеры событий => подписка на них должна быть оформлена до их вызова.
    //this.startRouts(); // с этого момента срабатывают события в роутах!

    //console.log(view.render().el);

    // отрисовку делать в конце, когда все экземпляры инициализированы
    this.html.box.html(view.render().el);
};

pContact.html = {
    init: function () {
        this.body = $('body');
        this.box = $('#contactsBox'); // список покупателей
    }

    ,vEdit: null
};

pContact.event = function () {
    var self = this;

    vent.on('drawContactEditor', function () {
        self.drawEditor(arguments[0]['view'], arguments[0]['model']);
        //console.log(arguments[0]['view'], arguments[0]['model']);
    })
};

pContact.drawEditor = function (view, model) {
    //console.log(arguments);

    var innerModel = model ? model : new App.Models.Contact;
    var vEditor = new App.Views.ContactEditor({model: innerModel});

    var top = view ? view.$el.offset().top + view.$el.height() : $('.vContacts > div').offset().top + 29;
    var left = view ? view.$el.offset().left : $('.vContacts > div').offset().left;
    vEditor.$el.css({top:top, left:left});

    if (pContact.html.vEdit) pContact.html.vEdit.remove();
    pContact.html.vEdit = vEditor;
    $('body').append(vEditor.render().el);
};

//pContact.startRouts = function () {
//    //console.log('startRouts');
//    new App.Router.Buyer();
//    Backbone.history.start(); // после определения роутов обязательно запускаем запоминание истории в браузере HTML5
//};
