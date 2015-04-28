// роуты начинают работать в момент создания экзепляра роутов в page.js
// роуты - что то вроде контроллеров, события можно прописывать в них.
// должен быть один экземпляр роута на страницу.

App.Router.Buyer = Backbone.Router.extend({

    routes: {
        '': 'index'
        //, '*other': 'default' // other - тоже любой текст
    },

    index: function () {
        //console.log('start route buyer');
    }


    //homeEdit: function () {
    //    //console.log('route trigger rHome:edit');
    //    vent.trigger('rHome:edit');
    //},
    //
    //// 404 обрабатывается в Laravel, но без #. Поэтому обрабатываем здесь отдельно!
    //default: function (other) {
    //    console.log('404 ошибка ' + other);
    //}

});


