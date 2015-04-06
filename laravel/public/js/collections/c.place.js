App.Collections.Places = Backbone.Collection.extend({
    model: App.Models.Place // дефолтные данные, елси не будут переданы новые данные

    ,initialize: function () {
        //this.on('add', this.onModelAdd, this);

        //vent.on('cKindBuyer_changed', function () {
        //    console.log(123);
        //});

        //this.on('add remove', vent.trigger('cKindBuyer_changed', this), this);
        this.on('add remove', this.onchange, this);
    }

    ,onchange: function (model, collection, options) {

        //console.log( collection, settings.cKindBuyers );
    }

});