
var AjaxHandler = function () {};

/* form widgets (country, state and city selects) */

/**
 * callback for ajax success
 * @param  {[type]} data [description]
 * @return {[type]}      [description]
 */
AjaxHandler.prototype.appendDataToForm = function (data, textStatus, jqXHR) {
    PlaceApp.clearForm();
    if (data.result === undefined) {
        var message = new Message('algo deu errado');
        message.displayMessages();
    } else {
        $('#form-delete-confirm').attr('href', '#/delete/' + data.result.id);

        // input fields
        $('#form-place_id').val(data.result.id);
        $('#form-name').val(data.result.name);
        $('#form-description').val(data.result.description);
        $('#form-street').val(data.result.address.street);
        $('#form-number').val(data.result.address.number);
        $('#form-additional_info').val(data.result.additional_info);
        $('#form-zipcode').val(data.result.address.zipcode);
        $('#form-address_id').val(data.result.address_id);
        $('#form-city_id').val(data.result.address.city_id);
        $('#form-user_id').val(data.result.user_id);
        $('#form-country_id').val(data.result.address.country_id);
        $('#form-province_id').val(data.result.address.province_id);

        $('#form-user_name').text(data.result.user_name);

        var created = PlaceApp.formatDate(data.result.created_at);
        var updated = PlaceApp.formatDate(data.result.updated_at);

        $('#form-created_at').text(data.result.created_at);
        $('#form-updated_at').text(data.result.updated_at);

        console.log('appended data to form: ' + data);
    };
};

/**
 * /
 * @param {[type]} data       [description]
 * @param {[type]} textStatus [description]
 * @param {[type]} jqXHR      [description]
 */
AjaxHandler.prototype.setCurrentPlaceId = function (data, textStatus, jqXHR) {
    $('#form-place_id').val(data.id);
    var message = new Message(data.message);
    //message.displayMessages();
    console.log('current id is set');
    $('.loading-image').remove();
    routie('/edit/' + data.id);
    // aqui precisa mudar a data de modificação do item

};

/**
 * /
 * @param  {[type]} data       [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.afterDeletePlace = function (data, textStatus, jqXHR) {
    var message = new Message(data.message);
    message.displayMessages();
    console.log('redirecting to table');
    routie('/list/1');
    $('#table-place-' + data.id).parent().parent().remove();
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.afterDeleteManyPlaces = function (data, textStatus, jqXHR) {
    var message = new Message(data.message);
    message.displayMessages();
    console.log('redirecting to table');
    routie('/list/1');
    $('#place-table td input:checked').parent().parent().remove();
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.loadDetailItem = function (data, textStatus, jqXHR) {
    PlaceApp.render("#detail-target", PlaceApp.templates.detailItem, data);
    $('.loading-image').remove();
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.loadDetailBrowser = function (data, textStatus, jqXHR) {
    var handler = new EventHandler();
    PlaceApp.render("#browser-target", PlaceApp.templates.detailBrowser, data);
    $("#browser-target")
        .on('click', 'td .browser-view-button', handler.loadDetailItemData);
    $('.loading-image').remove();
};

/**
 * callback for ajax success
 * @param  {[type]} controller [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.appendFormCountryOptions = function (data, textStatus, jqXHR) {
    PlaceApp.render('#form-country_id', PlaceApp.templates.selectOptions, data);
};

/**
 * callback for ajax success
 * @param  {[type]} controller [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.appendFormProvinceOptions = function (data, textStatus, jqXHR) {
    PlaceApp.render('#form-province_id', PlaceApp.templates.selectOptions, data);
};

/**
 * callback for ajax success
 * @param  {[type]} controller [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.appendFormCityOptions = function (data, textStatus, jqXHR) {
    var province_id = $('#province_id');
    PlaceApp.render('#form-city_id', PlaceApp.templates.selectOptions, data);
};

/* action callbacks */

/**
 * callback for ajax success
 * @param  {[type]} controller [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.renderTable = function (data, textStatus, jqXHR) {
    PlaceApp.render(
        '#table-target', 
        PlaceApp.templates.table, 
        data
    );
    var handler = new EventHandler();
    $('#table-target')
        .on('click', '#check-all', handler.checkAllRows)
        .on('click', '#delete-many', handler.deleteManyAction);
    $('.loading-image').fadeOut('slow').remove();
    console.log('rendering table');
};

/**
 * [renderResultList description]
 * @param  {[type]} data       [description]
 * @return {[type]}            [description]
 */
AjaxHandler.prototype.renderResultList = function  (data, textStatus, jqXHR) {
    PlaceApp.render(
        '#complete-address-target', 
        PlaceApp.templates.addressSelector, 
        data
    );
    var handler = new EventHandler();
    $('complete-address-target').on('click', '.address-item', handler.chooseCorrectAddress);
};


AjaxHandler.prototype.chooseCorrectAddress = function (data, textStatus, jqXHR) {

    var country, province, city, district, street, number, zipcode;
    
    for (var i = data.results.address_components.length - 1; i >= 0; i--) {
        var item = data.results.address_components[i]
        if (item.types.indexOf('postal_code')) {
            zipcode = item.long_name;
        };
        if (item.types.indexOf('country')) {
            country = item.long_name;
        };
        if (item.types.indexOf('administrative_area_level_1')) {
            province = item.long_name;
        };
        if (item.types.indexOf('locality')) {
            city = item.long_name;
        };
        if (item.types.indexOf('sublocality_level_1')) {
            district = item.long_name;
        };
        if (item.types.indexOf('route')) {
            street = item.long_name;
        };
        if (item.types.indexOf('street_number')) {
            number = item.long_name;
        };
    };

    var lat = data.results.geometry.location.lat;
    var lon = data.results.geometry.location.lng;

    $('#form-zipcode').val(zipcode);
    $('#form-country').val(country);
    $('#form-province').val(province);
    $('#form-city').val(city);
    $('#form-district').val(district);
    $('#form-street').val(street);
    $('#form-number').val(number);
    $('#form-lat').val(lat);
    $('#form-lon').val(lon);
};

/* system callbacks */

/**
 * callback for ajax error
 * @param  {[type]} xhr    [description]
 * @param  {[type]} error  [description]
 * @param  {[type]} status [description]
 * @return {[type]}        [description]
 */
AjaxHandler.prototype.handleError = function (xhr, error, status) {
    var message = new Message(error + ': ' + status);
    message.displayErrorMessages();
};

/**
 * callback for ajax success
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 */
AjaxHandler.prototype.handleMessage = function (data, textStatus, jqXHR) {
    var message = new Message(data.message);
    message.displayMessages();
};
