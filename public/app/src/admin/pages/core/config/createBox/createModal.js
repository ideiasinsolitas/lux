/**
 * @author a.demeshko
 * created on 12/24/15
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.config.dashboard')
    .service('createModal', createModal);

  /** @ngInject */
  function composeModal($uibModal) {
      this.open = function(options){
        return $uibModal.open({
          animation: false,
          templateUrl: 'app/pages/config/dashboard/createBox/create.html',
          controller: 'createBoxCtrl',
          controllerAs: 'boxCtrl',
          size: 'create',
          resolve: {
            subject: function () {
              return options.subject;
            },
            to: function () {
              return options.to;
            },
            text: function () {
              return options.text;
            }
          }
        });
      }
  }

})();