PlaceComponent = {};

// interface helpers
PlaceComponent.helper || PlaceComponent.helper = {};

PlaceComponent.helper.setId = function (id) {

};

PlaceComponent.helper.getId = function () {
    var id = ;
    return id;
};

PlaceComponent.helper.setIds = function (ids) {

};

PlaceComponent.helper.getIds = function () {
    var ids = ;
    return ids;
};

PlaceComponent.helper.setFormData = function(data) {
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
};

PlaceComponent.helper.getFormData = function() {
    var data = {};
    
    // input fields
    data.id = $('#form-place_id').val();
    data.name = $('#form-name').val();
    data.description = $('#form-description').val();
    data.street = $('#form-street').val();
    data.number = $('#form-number').val();
    data.additional_info = $('#form-additional_info').val();
    data.zipcode = $('#form-zipcode').val();
    data.address_id = $('#form-address_id').val();
    data.city_id = $('#form-city_id').val();
    data.user_id = $('#form-user_id').val();
    data.country_id = $('#form-country_id').val();
    data.province_id =  $('#form-province_id').val();

    data.user_name = $('#form-user_name').text();

    data.created_at = $('#form-created_at').text();
    data.updated_at = $('#form-updated_at').text();
    return data;
};

// create models if not exists
PlaceComponent.models || PlaceComponent.models = {};

// geolocation model
/**
 * /
 */
PlaceComponent.models.Geolocation = function () {
    MVC.Model.call(this, '/geolocation/services/address');
};
PlaceComponent.models.Geolocation.prototype = new MVC.Model();
PlaceComponent.models.Geolocation.prototype.constructor = PlaceComponent.models.Geolocation;

PlaceComponent.models.Geolocation.prototype.complete = function (address) {
    this.payload = {
        'url' : this.endpoint + '/' + address
    };
    return this.getRequestData();
};

// create controllers if not exists
PlaceComponent.controllers || PlaceComponent.controllers = {

};

// ajax handler
/**
 * /
 */
PlaceComponent.controllers.GeolocationAjaxHandler = function () {
    MVC.EventHandler.call(this);
};

PlaceComponent.controllers.GeolocationAjaxHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.GeolocationAjaxHandler.prototype.constructor = PlaceComponent.controllers.GeolocationAjaxHandler;

// event handler
PlaceComponent.controllers.GeolocationEventHandler = function () {
    MVC.EventHandler.call(this);
};

PlaceComponent.controllers.GeolocationEventHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.GeolocationEventHandler.prototype.constructor = PlaceComponent.controllers.GeolocationEventHandler;

// route handler
PlaceComponent.controllers.GeolocationRouteHandler = function () {
    MVC.EventHandler.call(this);
};

PlaceComponent.controllers.GeolocationRouteHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.GeolocationRouteHandler.prototype.constructor = PlaceComponent.controllers.GeolocationRouteHandler;

// application bootstrap
PlaceComponent.application.GeolocationApp = function () {};
    var geolocation = new PlaceComponent.models.Geolocation();

    var ajaxHandler = new PlaceComponent.controllers.GeolocationAjaxHandler();
    var routeHandler = new PlaceComponent.controllers.GeolocationRouteHandler(geolocation);
    var eventHandler = new PlaceComponent.controllers.GeolocationEventHandler(geolocation);

    var routes = {};
    var events = [];

    Component.base.Application.call(this, routes, events);
};

PlaceComponent.application.GeolocationApp.prototype = new Component.base.Application();
PlaceComponent.application.GeolocationApp.prototype.constructor = PlaceComponent.application.GeolocationApp;


// place model
PlaceComponent.models || PlaceComponent.models = {};

PlaceComponent.models.Place = function () {
    MVC.Model.call(this, '/geolocation/place');
};

PlaceComponent.models.Place.prototype = new MVC.Model();
PlaceComponent.models.Place.prototype.constructor = PlaceComponent.models.Place;

PlaceComponent.models.Place.prototype.listAll = function () {
    this.payload = {
        'url' : this.endpoint + '/list/all'
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.list = function (page) {
    this.payload = {
        'url' : this.endpoint + '/list/' + page
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.show = function (id) {
    this.payload = {
        'url' : this.endpoint + '/' + id + '/show'
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.insert = function (post) {
    this.payload = {
        'method' : 'POST',
        'url' : this.endpoint + '/create',
        'data' : post
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.save = function (post, id) {
    this.payload = {
        'method' : 'POST',
        'url' : this.endpoint + '/' + id + '/update',
        'data' : post
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.delete = function (id) {
    this.payload = {
        'url' : this.endpoint + '/' + id + '/delete'
    };
    return this.getRequestData();
};

PlaceComponent.models.Place.prototype.deleteMany = function (ids) {
    this.payload = {
        'method' : 'POST',
        'url' : this.endpoint + '/delete',
        'data' : { ids : ids }
    };
    return this.getRequestData();
};

// create controllers if not exist
PlaceComponent.controllers || PlaceComponent.controllers = {};

// ajax handler
PlaceComponent.controllers.PlaceAjaxHandler = function () {
    MVC.EventHandler.call(this);
};
PlaceComponent.controllers.PlaceAjaxHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.PlaceAjaxHandler.prototype.constructor = PlaceComponent.controllers.PlaceAjaxHandler;

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderTable = function (data, textStatus, jqXHR) {
    this.view.render(
        '#table-target', 
        '', 
        data
    );

    var events = [
        {
            scope : '#table-target',
            event : 'click',
            target : '#check-all',
            callback : this.eventHandler.checkAllRows.bind(this.eventHandler)
        },
        {
            scope : '#table-target',
            event : 'click',
            target : '#delete-many',
            callback : this.eventHandler.deleteManyAction.bind(this.eventHandler)
        }
    ];

    Component.base.EventBinder.bindEvents(events);

    $('.loading-image').fadeOut('slow').remove();
    console.log('rendering table');
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderAddForm = function (data, textStatus, jqXHR) {

};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderEditForm = function (data, textStatus, jqXHR) {
    
    // trigger event clear form HERE!!!
    
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

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderDetail = function (data, textStatus, jqXHR) {
    this.view.render("#detail-target", '', data);
    $('.loading-image').remove();
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.redirectToEditForm = function (data, textStatus, jqXHR) {
    routie(data.id + '/edit');
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderAddressChoices = function (data, textStatus, jqXHR) {

    var resultList = [];
    var country, province, city, district, street, number, zipcode;
    
    for (var i = data.results.length - 1; i >= 0; i--) {
        for (var i = data.results[i].address_components.length - 1; i >= 0; i--) {
            var item = data.results[i].address_components[i]
            var resultItem = {};

            if (item.types.indexOf('postal_code')) {
                resultItem.zipcode = item.long_name;
            };
            if (item.types.indexOf('country')) {
                resultItem.country = item.long_name;
            };
            if (item.types.indexOf('administrative_area_level_1')) {
                resultItem.province = item.long_name;
            };
            if (item.types.indexOf('locality')) {
                resultItem.city = item.long_name;
            };
            if (item.types.indexOf('sublocality_level_1')) {
                resultItem.district = item.long_name;
            };
            if (item.types.indexOf('route')) {
                resultItem.street = item.long_name;
            };
            if (item.types.indexOf('street_number')) {
                resultItem.number = item.long_name;
            };
        };

        var resultItem.lat = data.results[i].geometry.location.lat || null;
        var resultItem.lon = data.results[i].geometry.location.lng || null;

        resultList.push(resultItem);
    };
    this.view.render('', '', resultList);
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderConfirmation = function (data, textStatus, jqXHR) {

};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.renderBatchConfirmation = function (data, textStatus, jqXHR) {

};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.setCurrentPlaceId = function (data, textStatus, jqXHR) {
    $('#form-place_id').val(data.id);
    var message = new SystemMessage(data.message);
    //message.displayMessages();
    console.log('current id is set');
    $('.loading-image').remove();
    routie('/edit/' + data.id);
    // aqui precisa mudar a data de modificação do item
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.displayDeletedMessage = function (data, textStatus, jqXHR) {
    var message = new SystemMessage(data.message);
    message.displayMessages();
    console.log('redirecting to table');
    routie('/list/1');
    $('#table-place-' + data.id).parent().parent().remove();
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.displayDeletedManyMessage = function (data, textStatus, jqXHR) {
    var message = new SystemMessage(data.message);
    message.displayMessages();
    console.log('redirecting to table');
    routie('/list/1');
    $('#table-place-' + data.id).parent().parent().remove();
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.appendFormCountryOptions = function (data, textStatus, jqXHR) {
    this.view.render('#form-country_id', '', data);
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.appendFormProvinceOptions = function (data, textStatus, jqXHR) {
    this.view.render('#form-province_id', '', data);
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.appendFormCityOptions = function (data, textStatus, jqXHR) {
    this.view.render('#form-city_id', '', data);
};

PlaceComponent.controllers.PlaceAjaxHandler.prototype.appendFormDistrictOptions = function (data, textStatus, jqXHR) {
    this.view.render('#form-district_id', '', data);
};

// event handler
PlaceComponent.controllers.PlaceEventHandler = function (place, geolocation) {
    this.ajaxHandler = new PlaceAjaxHandler();
    this.place = place;
    this.geolocation = geolocation;
    MVC.EventHandler.call(this);
};
PlaceComponent.controllers.PlaceEventHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.PlaceEventHandler.prototype.constructor = PlaceComponent.controllers.PlaceEventHandler;

PlaceComponent.controllers.PlaceEventHandler.prototype.save = function (ev) {
    var params = this.place.save(post, id);
    params.success = this.ajaxHandler.redirectToEditForm;
    this.ajax.sendRequest(params);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.insert = function (ev) {
    var post = {};
    var params = this.place.insert(post);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.clearForm = function (ev) {

};

PlaceComponent.controllers.PlaceEventHandler.prototype.delete = function (ev) {
    var id = PlaceComponent.helper.getPlaceId();
    var params = this.place.delete(id);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.deleteMany = function (ev) {
    var ids = '';
    var params = this.place.deleteMany(ids);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.completeAddress = function (ev) {
    var address = '';
    var params = this.geolocation.complete(address);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.toggleTableRows = function (ev) {

};

PlaceComponent.controllers.PlaceEventHandler.prototype.loadCountries = function (ev) {
    var params = this.geolocation.countries();
};

PlaceComponent.controllers.PlaceEventHandler.prototype.loadProvinces = function (ev) {
    var countryId = '';
    var params = this.geolocation.provinces(countryId);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.loadCities = function (ev) {
    var provinceId = '';
    var params = this.geolocation.cities(provinceId);
};

PlaceComponent.controllers.PlaceEventHandler.prototype.loadDistricts = function (ev) {
    var cityId = '';
    var params = this.geolocation.districts(cityId);
};

/**
 * PlaceRouteHandler
 * 
 * @param {[type]} place       [description]
 * @param {[type]} geolocation [description]
 */
PlaceComponent.controllers.PlaceRouteHandler = function (place, geolocation) {
    this.ajaxHandler = new PlaceAjaxHandler();
    this.place = place;
    this.geolocation = geolocation;
    MVC.EventHandler.call(this);
};
PlaceComponent.controllers.PlaceRouteHandler.prototype = new MVC.EventHandler();
PlaceComponent.controllers.PlaceRouteHandler.prototype.constructor = PlaceComponent.controllers.PlaceRouteHandler;

/**
 * /
 * @return {[type]}            [description]
 */
PlaceComponent.controllers.PlaceRouteHandler.prototype.listAllAction = function () {
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
 * @param  {[type]} page [description]
 * @return {[type]}      [description]
 */
PlaceComponent.controllers.PlaceRouteHandler.prototype.listAction = function (page) {
    $('#table-target').empty().append(PlaceComponent.application.config.spinnerHtml);
    PlaceComponent.application.changeSection('#place-table-container');
    
    var params = '';
    params.error = this.handleError();

    params.success = this.ajaxHandler.appendFormCountryOptions.bind(this.ajaxHandler);
    this.ajax.sendRequest(params);
    
    params.success = this.ajaxHandler.renderTable.bind(this.ajaxHandler);
    this.ajax.sendRequest(params);
    
    console.log('list-action-done');
};

/**
 * 
 * @return {[type]} [description]
 */
PlaceComponent.controllers.PlaceRouteHandler.prototype.insertAction = function () {
    var post = '';
    var params = this.place.insert(post);

    params.error = this.handleError();
    params.success = this.ajaxHandler.redirectToEditForm;
    this.ajax.sendRequest(params);
};

/**
 * /
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
PlaceComponent.controllers.PlaceRouteHandler.prototype.detailAction = function (id) {
    var params = this.place.show(id);
    params.success = this.ajaxHandler.renderDetail;
    this.ajax.sendRequest(params);
};

/**
 * /
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
PlaceComponent.controllers.PlaceRouteHandler.prototype.editFormAction = function (id) {
    var params = this.place.show(id);
    params.success = this.ajaxHandler.renderEditForm;
    this.ajax.sendRequest(params);
};

PlaceComponent.controllers.PlaceRouteHandler.prototype.addFormAction = function (id) {

};

PlaceComponent.controllers.PlaceRouteHandler.prototype.confirmDeleteAction = function (id) {

};

PlaceComponent.controllers.PlaceRouteHandler.prototype.confirmDeleteManyAction = function (id) {

};

// APPLICATION

// 
PlaceComponent.application.PlaceApp = function () {

    var place = new PlaceComponent.models.Place();

    var ajaxHandler = new PlaceComponent.controllers.PlaceAjaxHandler();
    var routeHandler = new PlaceComponent.controllers.PlaceRouteHandler(place);
    var eventHandler = new PlaceComponent.controllers.PlaceEventHandler(place);

    var routes = {
        '/list/:page' : function (page = 1) {
            routeHandler.listAction(page);
        },
        '/add' : function () {
            routeHandler.addFormAction();
        },
        '/:id/edit' : function (id) {
            routeHandler.renderEditForm(id);
        },
        '/:id/detail' : function (id) {
            routeHandler.renderDetail(id);
        },
        '/confirm/delete/:id' : function (id) {
            routeHandler.confirmDeleteAction(id);
        },
        'confirm/delete/many' : function () {
            routeHandler.confirmDeleteManyAction();
        },
    };

    var events = [
        {
            scope : '',
            event : 'click',
            target : '',
            callback : eventHandler.insert.bind(eventHandler),
        },
        {
            scope : '',
            event : 'click',
            target : '',
            callback : eventHandler.save.bind(eventHandler),
        },
        {
            scope : '',
            event : '',
            target : 'click',
            callback : eventHandler.clearForm.bind(eventHandler),
        },
        {
            scope : '',
            event : 'click',
            target : '',
            callback : eventHandler.delete.bind(eventHandler),
        },
        {
            scope : '',
            event : 'click',
            target : '',
            callback : eventHandler.deleteMany.bind(eventHandler),
        },
        {
            scope : '',
            event : 'click',
            target : '',
            callback : eventHandler.completeAddress.bind(eventHandler),
        },
        {
            scope : '',
            event : '',
            target : '',
            callback : eventHandler.toggleTableRows.bind(eventHandler),
        },
        {
            scope : '',
            event : 'change',
            target : '',
            callback : eventHandler.loadCountries.bind(eventHandler),
        },
        {
            scope : '',
            event : 'change',
            target : '',
            callback : eventHandler.loadProvinces.bind(eventHandler),
        },
        {
            scope : '',
            event : 'change',
            target : '',
            callback : eventHandler.loadCities.bind(eventHandler),
        },
        {
            scope : '',
            event : 'change',
            target : '',
            callback : eventHandler.loadDistricts.bind(eventHandler),
        },
    ];
    
    Component.base.Application.call(this, routes, events);
};

PlaceComponent.application.PlaceApp.prototype = new Component.base.Application();
PlaceComponent.application.PlaceApp.prototype.constructor = PlaceComponent.application.PlaceApp;

var placeApp = new PlaceComponent.application.PlaceApp();
placeApp.run();

var geolocApp = new PlaceComponent.application.GeolocationApp();
geolocApp.run();
