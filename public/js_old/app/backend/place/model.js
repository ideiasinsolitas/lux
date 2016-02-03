
var PlaceModel = function (endpoint) {
    this.endpoint = endpoint || '/admin/geolocation/place';
};

PlaceModel.prototype.getAllCountries = function () {
    return new AjaxRequest({
        url: this.endpoint + '/countries',
        method: 'GET'
    });
};

PlaceModel.prototype.getProvincesByCountry = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/provinces/' + id,
        method: 'GET'
    });
};

PlaceModel.prototype.getCitiesByProvince = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/cities/' + id,
        method: 'GET'
    });
};

PlaceModel.prototype.getCitiesByCountry = function (id) {
    console.log(id);
    return new AjaxRequest({
        url: this.endpoint + '/cities/' + id + '/country',
        method: 'GET'
    });
};

PlaceModel.prototype.getDistrictsByCity = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/districts/' + id,
        method: 'GET'
    });
};

PlaceModel.prototype.getAddressesByCity = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/addresses/' + id,
        method: 'GET'
    });
};

PlaceModel.prototype.getAdressesByDistrict = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/addresses/' + id + '/district',
        method: 'GET'
    });
};

PlaceModel.prototype.getList = function (page) {
    return new AjaxRequest({
        url: this.endpoint + '/list/' + page,
        method: 'GET'
    });
};

PlaceModel.prototype.getListAll = function () {
    return new AjaxRequest({
        url: this.endpoint + '/all',
        method: 'GET'
    });
};

PlaceModel.prototype.getShow = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/' + id + '/show',
        method: 'GET'
    });
};

PlaceModel.prototype.getDelete = function (id) {
    return new AjaxRequest({
        url: this.endpoint + '/' + id + '/delete',
        method: 'GET'
    });
};

PlaceModel.prototype.postUpdate = function (input) {
    return new AjaxRequest({
        url: this.endpoint + '/' + input.id + '/update',
        method: 'POST',
        data: input
    });
};

PlaceModel.prototype.postStore = function (input) {
    return new AjaxRequest({
        url: this.endpoint + '/store',
        method: 'POST',
        data: input
    });
};

PlaceModel.prototype.postDeleteMany = function (ids) {
    return new AjaxRequest({
        url: this.endpoint + '/delete',
        method: 'POST',
        data: {'ids' : ids}
    });
};
