
var GeocodingModel = function () {};

GeocodingModel.prototype.getCompleteAddress = function (address) {
    return new AjaxRequest({
        url: this.endpoint + '/address/' + address,
        method: 'GET'
    });
};
