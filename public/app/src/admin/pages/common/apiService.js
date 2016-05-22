// factory
angular
    .module('BlurAdmin.pages')
    .factory('apiService', Service);

apiService.$inject = ['$http', '$location', '$q'];

function apiService($http, $location, $q) {
    var service = {
        save: save,
        findOne: findOne,
        findAll: findAll,
        destroy: destroy,
        validate: validate,
        setEndpoint: setEndpoint
    };
    return service;

    ////////////

    function setEndpoint(endpoint) {
        service.endpoint = endpoint;
    }

    function save(model) {
        return $http.post(service.endpoint)
            .then(apiSaveSuccess)
            .catch(apiSaveFail);

        function apiSaveSuccess(data, status, headers, config) {
            return data.data;
        }

        function apiSaveFail(e) {
            var newMessage = 'XHR Failed for getCustomer'
            return $q.reject(e);
        }
    }

    function findOne(pk) {
        return $http.get(service.endpoint + '/' + pk)
            .then(apifindOneSuccess)
            .catch(apifindOneFail);

        function apifindOneSuccess(data, status, headers, config) {
            return data.data;
        }

        function apifindOneFail(e) {
            var newMessage = 'XHR Failed for getCustomer'
            return $q.reject(e);
        }
    }

    function findAll() {
        return $http.get(service.endpoint)
            .then(apifindAllSuccess)
            .catch(apifindAllFail);

        function apifindAllSuccess(data, status, headers, config) {
            return data.data;
        }

        function apifindAllFail(e) {
            var newMessage = 'XHR Failed for getCustomer'
            return $q.reject(e);
        }
    }

    function destroy(pk) {
        return $http.delete(service.endpoint + '/' + pk)
            .then(apiDestroySuccess)
            .catch(apiDestroyFail);

        function apiDestroySuccess(data, status, headers, config) {
            return data.data;
        }

        function apiDestroyFail(e) {
            var newMessage = 'XHR Failed for getCustomer'
            return $q.reject(e);
        }
    }
}
