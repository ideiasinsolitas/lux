/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.components.mail')
      .controller('ConfigDashboardCtrl', ConfigDashboardCtrl);

  /** @ngInject */
  function ConfigDashboardCtrl(composeModal, mailMessages) {

    var vm = this;
    vm.navigationCollapsed = true;
    vm.showCompose = function(subject, to , text){
      composeModal.open({
        subject : subject,
        to: to,
        text: text
      })
    };

    vm.tabs = mailMessages.getTabs();
  }

})();
