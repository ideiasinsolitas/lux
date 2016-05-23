
var EventHandler = function () {};

/* binded by jQuery */

/**
 * callback for click create button
 * @return {[type]} [description]
 */
EventHandler.prototype.saveAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    $('#save-button-container').append(PlaceApp.config.spinnerHtml);
    var payload = PlaceApp.serializeForm();
    if (PlaceApp.getCurrentPlaceId() > 0) {
        var request = model.postUpdate(payload);
    } else {
        var request = model.postStore(payload);
    }
    request.send({
        success : handler.setCurrentPlaceId,
        error : handler.handleError
    });
    console.log('store-action-done');
};

/**
 * callback for click delete button
 * @return {[type]} [description]
 */
EventHandler.prototype.deleteAction = function (ev) { 
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var id = $('#form-place_id').val();
    var request = model.getDelete(id);
    request.send({
        success : handler.afterDeletePlace,
        error : handler.handleError
    });
    console.log('delete-action-done');
    PlaceApp.clearCurrentPlaceId();
};

/**
 * [deleteManyAction description]
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.deleteManyAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var elements = $('#place-table td input:checked').parent().parent();
    var ids = [];
    for (var i = elements.length - 1; i >= 0; i--) {
        ids.push($(elements[i]).attr('data-id'));
    }
    var request = model.postDeleteMany(ids);
    request.send({
        success : handler.afterDeleteManyPlaces,
        error : handler.handleError
    });
    console.log('delete-action-done');
};

/**
 * /
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.loadDetailItemData = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var id = $(ev.currentTarget).parent().attr('data-id');
    routie('/show/' + id);
};

/**
 * callback for on() country selected ev
 * @return {[type]} [description]
 */
EventHandler.prototype.countrySelectedAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var request = model.getProvincesByCountry(ev.target.value);
    request.send({
        success : handler.appendFormProvinceOptions,
        error : handler.handleError
    });
    console.log('provinces-loaded');
};

/**
 * /
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.checkAllRows = function (ev) {
    var checked = $('#check-all').prop('checked');
    if (checked) {
        $('#place-table input[type=checkbox]').prop('checked', true);
    } else {
        $('#place-table input[type=checkbox]').prop('checked', false);
    }
};

/**
 * callback for on() province selected ev
 * @param  {[type]} ev [description]
 * @return {[type]}       [description]
 */
EventHandler.prototype.provinceSelectedAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var request = model.getCitiesByProvince(ev.target.value);
    request.send({
        success : handler.appendFormCityOptions,
        error : handler.handleError
    });
    console.log('cities-loaded');
};

/**
 * callback for on() city selected ev
 * @param  {[type]} ev [description]
 * @return {[type]}       [description]
 */
EventHandler.prototype.citySelectedAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    console.log('districts-loaded');
};

/**
 * /
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.completeAddressAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new GeocodingModel();
    var address = '';
    var request = model.listResults(address);
    request.send({
        success : handler.chooseCorrectAddress,
        error : handler.handleError
    });
    console.log('address-loaded');
};


/**
 * /
 * @param  {[type]}        [description]
 * @return {[type]}            [description]
 */
EventHandler.prototype.chooseCorrectAddress = function (ev) {
    ev.preventDefault();
};

/**
 * /
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.getZipcodeAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var address =  $('#form-street').val()  + ', ' + $('#form-number').val() || '' + ' - ' + $('#form-city_id').val() || ''  + ' - ' + $('#form-zipcode').val() || '' + ' - Brasil';
    console.log(address);
    var request = model.getFindZipcode(address);
    request.send({
        success : handler.appendFormZipcode,
        error : handler.handleError
    });
    console.log('zipcode-loaded');
};

/**
 * /
 * @param  {[type]} ev [description]
 * @return {[type]}    [description]
 */
EventHandler.prototype.getCoordinateAction = function (ev) {
    ev.preventDefault();
    var handler = new AjaxHandler();
    var model = new PlaceModel();
    var zipcode = $('#form-zipcode').val();
    console.log(zipcode);
    var request = model.getCompleteAddressUrl(zipcode);
    request.send({
        success : handler.appendFormCoordinate,
        error : handler.handleError
    });
    console.log('coordinate-loaded');
};
