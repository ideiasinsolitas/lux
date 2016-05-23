/**
 * @author a.demeshko
 * created on 1/12/16
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.core.user', [])
    .config(routeConfig);

  /** @ngInject */
function routeConfig($stateProvider) {
    $stateProvider
        .state('core.user', {
            url: '/user',
            templateUrl: 'app/pages/core/user/panel/panel.html',
            title: 'Users',
        })
        .state('core.user.profile', {
            url: '/user/profile',
            templateUrl: 'app/pages/core/user/profile/profile.html',
            title: 'Profile',
        })
        ;
    }
})();
