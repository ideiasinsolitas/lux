
var RouteHandler = function () {};


/* binded by routie */

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.listAllAction = function () {
    var model = new PlaceModel();
    var handler = new AjaxHandler();
    $('#table-target').empty().append(PlaceApp.config.spinnerHtml);
    Util.changeSection('#place-table-container');
    var request = model.getListAll();
    request.send({
        success : handler.renderTable,
        error : handler.handleError
    });
    console.log('list-all-action-done');
};

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.listAction = function (page) {
    var model = new PlaceModel();
    var handler = new AjaxHandler();
    $('#table-target').empty().append(PlaceApp.config.spinnerHtml);
    Util.changeSection('#place-table-container');
    var request = model.getAllCountries();
    request.send({
        success : handler.appendFormCountryOptions,
        error : handler.handleError
    });
    var request = model.getList(page);
    request.send({
        success : handler.renderTable,
        error : handler.handleError
    });
    console.log('list-action-done');
};

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.createAction = function () {
    $('.hide-on-edit').show();
    $('.hide-on-create').hide();
    Util.changeSection('#place-form-container');
    PlaceApp.clearForm();
    console.log('create-action-done');
};

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.editAction = function (id) {
    var model = new PlaceModel();
    var handler = new AjaxHandler();
    $('.hide-on-edit').hide();
    $('.hide-on-create').show();
    Util.changeSection('#place-form-container');
    var request = model.getShow(id);
    request.send({
        success : handler.appendDataToForm,
        error : handler.handleError
    });            
    console.log('edit-action-done');
};

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.detailAction = function (id) {
    var model = new PlaceModel();
    var handler = new AjaxHandler();
    if (PlaceApp.state.browserLoaded === false) {
        var request = model.getList(1);
        $('#browser-target').empty().append(PlaceApp.config.spinnerHtml);
        request.send({
            success : handler.loadDetailBrowser,
            error : handler.handleError
        });
        PlaceApp.state.browserLoaded = true;
    }
    $('#detail-target').empty().append(PlaceApp.config.spinnerHtml);
    Util.changeSection('#place-detail-container');
    var request = model.getShow(id);
    request.send({
        success : handler.loadDetailItem,
        error : handler.handleError
    });            
};

/**
 * /
 * @return {[type]}            [description]
 */
RouteHandler.prototype.confirmDeleteAction = function (id) {
    Util.changeSection('#place-delete-container');
    $('#form-place_id').val(id);
    $('#form-delete-cancel').attr('href', '#/edit/' + id);
    console.log('confirm-delete-action-done');
};

RouteHandler.prototype.chooseCorrectAddressAction = function () {
    Util.changeSection('#');
    console.log('confirm-delete-action-done');
};
