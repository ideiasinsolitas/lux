
angular
    .module('app')
    .controller('FormCtrl', FormCtrl);

function FormCtrl(userService) {
    var vm = this;

    vm.models = userService.findAll();

    ////////////

    function save(index) {
        userService.save(vm.models[index]);
    }
}
