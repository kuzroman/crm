window.App = {
    Models: {}
    ,Views: {}
    ,Collections: {}
    ,Router: {}
};

window.settings = window.settings; // чтобы webStorm мог определить этот объект

var vent = _.extend({}, Backbone.Events); // глобальный объект, кастомных событий, наследует события // backbone версия паттерна наблюдатель