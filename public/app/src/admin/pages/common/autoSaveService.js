// factory
angular
    .module('app')
    .factory('autoSaveService', autoSaveService);

function autoSaveService() {
    var service = {
        state: state,
        start: start,
        stop: stop,
        stopExecution: stopExecution
    };
    return service;

    ////////////

    var delay = 40;
    var state = 0;
    var isChanged = 0;
    var dataService;
    var model;

    function start(s) {
        if (s) {
            dataService = s;
        }
        setTimeout(save, delay);
        state = 1;
    }

    function change(m) {
        model = m;
        isChanged = 1;
    }

    function stop() {
        state = 0;
    }

    function save() {
        if (isChanged === 1) {
            dataService.save(model);
            isChanged = 0;
        }
        if (state === 1) {
            run();
        }
    }
}
