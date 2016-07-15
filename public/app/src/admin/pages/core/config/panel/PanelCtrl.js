
angular
    .module('app')
    .controller('PanelCtrl', PanelCtrl);

function PanelCtrl(configService) {
    var vm = this;

    vm.models = configService.findAll();

    ////////////

    function save(index) {
        configService.save(vm.models[index]);
    }
}
