/**
 * @author k.danovsky
 * created on 15.01.2016
 */
(function () {
  'use strict';

  angular.module('Lux.pages.core', [
    'Lux.pages.core.config',
    'Lux.pages.core.type',
    'Lux.pages.core.user',
  ]).config(routeConfig);

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
