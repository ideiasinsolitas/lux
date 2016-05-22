/**
 * @author k.danovsky
 * created on 15.01.2016
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.core', [
    'BlurAdmin.pages.core.config',
    'BlurAdmin.pages.core.type',
    'BlurAdmin.pages.core.user',
  ])
      .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider) {
    $stateProvider
        .state('core-dashboard', {
          url: '/core/dashboard',
          template : '<ui-view></ui-view>',
          abstract: true,
          title: 'Core Dashboard',
          sidebarMeta: {
            icon: 'ion-gear-a',
            order: 100,
          },
        });
  }

})();
