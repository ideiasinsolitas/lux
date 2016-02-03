
/* App */
var PlaceApp = {};

/**
 * [state description]
 * @type {Object}
 */
PlaceApp.state = {
    doingAutosave : false,
    detailBrowserLoaded : false,
    currentPlaceId : 0,
    activeSectionId : '',
    userId : 0
};

/**
 * [config description]
 * @type {Object}
 */
PlaceApp.config = {
    autosave : false,
    autosaveInterval : 15 * 1000,
    messageFadeOut : 4 * 1000,
    endpoint : '',
    templatePath: '/js/templates',
    spinnerHtml : '<img class="loading-image" src="/images/loading.svg">'
};

PlaceApp.templates = {
    detail : 'geolocation/detail.mustache',
    selectOptions : 'geolocation/select-options.mustache',
    table : 'geolocation/table.mustache',
    message : 'message.mustache',
    detailItem : 'geolocation/detail.mustache',
    detailBrowser : 'geolocation/browser-table.mustache',
    addressSelector : 'geolocation/address-selector.mustache'
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.clearCurrentPlaceId = function () {
    $('#form-place_id').val(0);
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.getCurrentPlaceId = function () {
    return $('#form-place_id').val() || 0;
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.autosave = function () {
    var config = this.config;
    var autosaveLoop = function() {
        console.log('autosave loop!');
        if (config.autosave === true && $('#place-form-container').hasClass('autosave-form-active') && $('#form-place_id').val() > 0) {
            $('#form-save-button').trigger('click');
            console.log('autosaving...')
        }
    };
    setInterval(autosaveLoop, config.autosaveInterval);
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.init = function () {
    this.bindEvents();
    if (this.config.autosave === true) {
        this.autosave();
    }
    var handler = new RouteHandler();
    routie({
        '/create' : handler.createAction,
        '/edit/:id' : handler.editAction,
        '/show/:id' : handler.detailAction,
        '/delete/:id' : handler.confirmDeleteAction,
        '/list/:page' : handler.listAction,
        'addresses/choose' : handler.chooseCorrectAddressAction
    });

    routie('/list/1');
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.bindEvents = function () {
    var handler = new EventHandler();
    $('body')
        .on(
            "change", 
            "#form-country_id", 
            handler.countrySelectedAction
            )
        .on(
            "change", 
            "#form-province_id", 
            handler.provinceSelectedAction
            )
        .on(
            "click", 
            "#form-save-button", 
            handler.saveAction
            )
        .on(
            "click", 
            "#form-delete-button", 
            handler.deleteAction
            )
        .on("click", '#unknown-zipcode-button', function (ev) { 
            ev.preventDefault();
            $('#' + ev.target.id).parent().parent().parent().hide();
        })
        .on(
            'click',
            '#complete-address-button',
            handler.getZipcodeAction
        );
};

/**
 * /
 * @param  {[type]} value [description]
 * @return {[type]}       [description]
 */
PlaceApp.formatDate = function (value) {
    var date = new Date(value);
    return date.getHours() + ':' + date.getTime() + ':' + date.getMinutes();
};

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.serializeForm = function () {
    return {
        id : $('#form-place_id').val(),
        name : $('#form-name').val(),
        description : $('#form-description').val(),
        street : $('#form-street').val(),
        number : $('#form-number').val(),
        additional_info : $('#form-additional_info').val(),
        zipcode : $('#form-zipcode').val(),
        address_id : $('#form-address_id').val(),
        city_id : $('#form-city_id').val(),
        user_id : $('#form-user_id').val()
    };
}

/**
 * /
 * @return {[type]} [description]
 */
PlaceApp.clearForm = function () {
    $('#form-created_at').text('');
    $('#form-updated_at').text('');
    $('#form-address_id').val(0);
    $('#form-place_id').val(0);
    $('#place-form')[0].reset();
};

/**
 * /
 * @param  {[type]} target [description]
 * @param  {[type]} view   [description]
 * @param  {[type]} data   [description]
 * @return {[type]}        [description]
 */
PlaceApp.render = function (target, view, data) {
    Util.render(target, this.config.templatePath, view, data);
};

PlaceApp.changeSection = function (section) {
    Util.changeSection(section);
};

PlaceApp.init();
