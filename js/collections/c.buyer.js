App.Collections.Buyers = Backbone.Collection.extend({
    //url: '/buyer',
    model: App.Models.Buyer // дефолтные данные, елси не будут переданы новые данные


    ,initialize: function () {
//        this.on('sync', function (cBuyers, objList) { console.log('sync', cBuyers, objList ) }); // сработает после fetch

        this.on('add', this.onModelAdd, this);

        //this.on('all', this.onError, this);
        //this.on('remove', this.onModelRemoved, this);
    }

    //,onError: function () {
    //    console.log(arguments);
    //    //alert ('Нет соединения с сетью, попробуйте позже.');
    //}

    ,onModelAdd: function (model, collection, options) {

    }

    ,onModelRemoved: function (model, collection, options) {
        //console.log("removeed, options:", arguments);

    }


});