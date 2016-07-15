/**
 * @author a.demeshko
 * created on 1/12/16
 */
(function () {
  'use strict';

  angular.module('Lux.pages.core.type', [])
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider) {
    $stateProvider
      .state('core.type', {
        url: '/type',
        controller: 'TypePanelCtrl',
        controllerAs: 'vm',
        templateUrl: 'app/pages/core/type/panel.html',
          title: 'Types',
          sidebarMeta: {
            icon: 'ion-ios-pulse',
            order: 100,
          },
      });
  }
})();
