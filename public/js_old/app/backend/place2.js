
// PARTE III - PLACE APP

// 
var PlaceModel = function () { BaseModel.call(this); };
PlaceModel.prototype = new BaseModel();
PlaceModel.prototype.constructor = PlaceModel;

PlaceModel.prototype.listAll = function () {
    this.payload = {
        'url' : this.endpoint + '',
    };
    return this.getRequestData();
};

PlaceModel.prototype.list = function (page) {

};

PlaceModel.prototype.show = function (id) {

};

PlaceModel.prototype.insert = function (post) {

};

PlaceModel.prototype.save = function (post, id) {

};

PlaceModel.prototype.delete = function (id) {

};

PlaceModel.prototype.deleteMany = function (ids) {

};

// PLACE CONTROLLERS

var PlaceAjaxHandler = function () {};

PlaceAjaxHandler.prototype.renderTable = function (data, textStatus, jqXHR) {
};

PlaceAjaxHandler.prototype.renderAddForm = function (data, textStatus, jqXHR) {
};

PlaceAjaxHandler.prototype.renderEditForm = function (data, textStatus, jqXHR) {
};

PlaceAjaxHandler.prototype.renderDetail = function (data, textStatus, jqXHR) {
};

PlaceAjaxHandler.prototype.insert = function (data, textStatus, jqXHR) {
};

PlaceAjaxHandler.prototype.save = function (data, textStatus, jqXHR) {
};

// 
var PlaceController = function () { 
    this.places = new PlaceModel();
    this.handler = new PlaceAjaxHandler();
};

PlaceController.prototype.insertAction = function () {
    this.before();
    var params = this.places.insert(id);
    params.success = this.handler.;
    $.ajax(params);
};

PlaceController.prototype.detailAction = function (id) {
    this.before();
    var params = this.places.show(id);
    params.success = this.handler.;
    $.ajax(params);
};

PlaceController.prototype.editFormAction = function (id) {
    this.before();
    var params = this.places.show(id);
    params.success = this.handler.;
    $.ajax(params);
};

PlaceController.prototype.saveAction = function (post, id) {
    this.before();
    var params = this.places.save(post, id);
    params.success = this.handler.;
    $.ajax(params);
};

PlaceController.prototype.setCurrentId = function () {
    this.currentId = $('').val();
};

PlaceController.prototype.getCurrentId = function () {
    return this.currentId;
};

PlaceController.prototype.clearCurrentId = function () {
    this.currentId = null;
};

PlaceController.prototype.getFormData = function () {

};

PlaceController.prototype.appendFormData = function () {

};

var place = new PlaceController();

var config = {
    autosave : false,
    autosaveInterval : 15 * 1000,
    messageFadeOut : 4 * 1000,
    templatePath: '/js/templates',
    spinnerHtml : '<img class="loading-image" src="/images/loading.svg">',
};

events = [
    {
        scope : '',
        event : '',
        target : '',
        callback : function (ev) {

        }
    },
    {
        scope : '',
        event : '',
        target : '',
        callback : function (ev) {

        }
    },
    {
        scope : '',
        event : '',
        target : '',
        callback : function (ev) {

        }
    }   
];

routes = {
    '/list/:page' : function (page = 1) {
    },
    '/create' : function () {
    },
    '/edit/:id' : function (id) {
    },
    '/detail/:id' : function (id) {
    },
    '/delete/confirm' : function () {
    },
};

// application bootstrap
var application = new Application(config);
application.run();
