
var GeocodingHandler = function () {};

GeocodingHandler.prototype.listResults = function (address) {

};

GeocodingHandler.prototype.listResults = function (address) {
    var address = encodeURIComponent(address);
    var model = new GeoLocationModel();
    var request = model.getCompleteAddress(address);
    var handler = new AjaxHandler();
    request.send({
        success : handler.chooseCorrectAddress,
        error : handler.handleError,
    });
    console.log('list-address-results');
};
