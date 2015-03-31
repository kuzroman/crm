test = {
    init: {
        show: 0
        ,model: 0
        ,view: 1
        ,controller: 1
    }

    ,render: 0
    ,remove: 0

    ,setData: 1
    ,add: 0
    ,addSuccess: 0
    ,del: 0
    ,change: 0

};

var log = function () {

    //console.log(test.init.model);

    if (!test.init.show && arguments[0] == 'init' ||
        !test.init.model && arguments[1] == 'model' ||
        !test.init.view && arguments[1] == 'view' ||
        !test.init.controller && arguments[1] == 'controller' ||

        !test.render && arguments[0] == 'render' ||
        !test.remove && arguments[0] == 'remove' ||

        !test.setData && arguments[0] == 'setData' ||

        !test.add && arguments[0] == 'add' ||
        !test.addSuccess && arguments[0] == 'addSuccess'

    ) return;

    console.log(arguments);
};