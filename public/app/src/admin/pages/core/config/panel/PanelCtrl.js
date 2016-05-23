
angular
    .module('app')
    .controller('PanelCtrl', PanelCtrl);

function PanelCtrl(confingService) {
    var vm = this;

    vm.models = confingService.findAll();

    ////////////

    function save(index) {
        confingService.save(vm.models[index]);
    }
}
