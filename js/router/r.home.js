// роуты начинают работать в момент создания экзепляра роутов в page.js
// роуты - что то вроде контроллеров, события можно прописывать в них.
// должен быть один экземпляр роута на страницу.

App.Router.Home = Backbone.Router.extend({

  routes: {
    //'': 'home'
    'homeEdit(/)': 'homeEdit'

//        ,'read'                   : 'read'
//        ,'page/:id/*arg'          : 'page'// arg - может быть любой текс, не играет роли, но должен быть хотя бы символ
//        ,'search/:query'          : 'search'
    //,'specialTask/:id'        : 'showSpecialTask'
    , '*other': 'default' // other - тоже любой текст
  },

  //home: function () {
  //  console.log('route home');
  //},


  homeEdit: function () {
    //console.log('route trigger rHome:edit');
    vent.trigger('rHome:edit');
  },

//    page: function(id, simbo) {
//        console.log(id, simbo);
//    },

//    search: function(query) {
//        console.log('роут search с запросом ' + query);
//    },

//    showSpecialTask: function (id) {
//        console.log('роут showSpecialOrder с id = ' + id);
//        //new App.Views.SpecialTask({ collection: tasksCollection }); // специальная задача //
//        vent.trigger('specialOrder:show', id); // файрим событие specialTask:show которое отлавливается в View
//    },

  // 404 обрабатывается в Laravel, но без #. Поэтому обрабатываем здесь отдельно!
  default: function (other) {
    console.log('404 ошибка ' + other);
  }

});


