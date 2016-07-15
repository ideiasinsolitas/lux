
angular
    .module('app')
    .controller('TypePanelCtrl', TypePanelCtrl);

function TypePanelCtrl(typeService) {
    var vm = this;

    vm.models = typeService.findAll();

    ////////////

    function save(index) {
        typeService.save(vm.models[index]);
    }
}
