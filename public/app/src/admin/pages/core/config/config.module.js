/**
 * @author a.demeshko
 * created on 1/12/16
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.core.config', [])
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider) {
    $stateProvider
      .state('core.config', {
        url: '/config',
        templateUrl: 'app/pages/core/config/panel.html',
        title: 'Config'
      });
  }
})();
