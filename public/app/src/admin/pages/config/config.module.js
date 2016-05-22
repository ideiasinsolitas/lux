/**
 * @author k.danovsky
 * created on 15.01.2016
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.config', [
    'BlurAdmin.pages.config.dashboard',
  ])
      .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider) {
    $stateProvider
        .state('config-dashboard', {
          url: '/config/dashboard',
          template : '<ui-view></ui-view>',
          abstract: true,
          title: 'Config Dashboard',
          sidebarMeta: {
            icon: 'ion-gear-a',
            order: 100,
          },
        });
  }

})();
