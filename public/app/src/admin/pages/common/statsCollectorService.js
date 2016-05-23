// factory
angular
    .module('app')
    .factory('statsCollectorService', statsCollectorService);

function statsCollectorService() {
    var service = {
        collect: collect
    };
    return service;

    ////////////

    function collect() {
        /* */
    };
}
