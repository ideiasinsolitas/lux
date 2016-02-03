// PARTE I - CORE

// Util

/**
 * [Util description]
 * @type {Object}
 */
var Util = {};

Util.core = {};

Util.arrayMerge = function (defaults, params) {
    var params = params || {};
    var merged = {};
    for (var attrname in defaults) {
        merged[attrname] = defaults[attrname];
    }
    for (var attrname in params) {
        merged[attrname] = params[attrname];
    }
    return merged;
};

/* Augment existing class with a method from another class */
Util.augment = function (receivingClass, givingClass) {
    /* only provide certain methods */
    if(arguments[2]) {
        var i, len = arguments.length;
        for (i=2; i<len; i++) {
            receivingClass.prototype[arguments[i]] = givingClass.prototype[arguments[i]];   
        }
    } 
    /* provide all methods */
    else {
        var methodName;
        for (methodName in givingClass.prototype) {
            /* check to make sure the receiving class doesn't have a method of the same name as the one currently being processed */
            if (!receivingClass.prototype[methodName]) {
                receivingClass.prototype[methodName] = givingClass.prototype[methodName];   
            }
        }
    }
}

Util.formats = {}

Util.formats.formatDate = function (value) {

};

Util.formats.formatPrice = function (price) {

};

var Router = {};

Router.route = function (routes) {
    routie(routes);
};

Router.redirect = function (route) {
    routie(route);
}

var EventBinder = {};

EventBinder.bindEvent = function (scope, event, target, callback) {
    $(scope).on(event, target, callback);
};

EventBinder.bindEvents = function (events) {
    for (var i = 0; i < events.length; i++) {
        var e = events[i];
        this.bindEvent(e.scope, e.event, e.target, e.callback);
    };
};

var LocalStorageAdapter = function () {};

LocalStorageAdapter.prototype.store(namespace, data) {
    if (arguments.length > 1) {
        return localStorage.setItem(namespace, JSON.stringify(data));
    } else {
        var store = localStorage.getItem(namespace);
        return (store && JSON.parse(store)) || {};
    };
};

var Application = function (config) {
    this.state = {};
    this.state.activePane = '';
    this.state.isFormPane = false;
    this.state.isAutosaveOn = false;
    this.user = {};
    this.config = config;
};

Application.prototype.changeSection = function (section) {
    $('.section-container').hide();
    $('.place-element-unhide').show();
    if (section === '#place-form-container') {
        $('#place-form-container').addClass('autosave-form-active');
    } else {
        $('#place-form-container').removeClass('autosave-form-active');
    }
    $(section).show();
    console.log('changed section to ' + section);
};

Application.prototype.turnOnAutosave = function () {
    this.state.isAutosaveOn = true;
};

Application.prototype.turnOffAutosave = function () {
    this.state.isAutosaveOn = false;
};

Application.prototype.runAutosave = function () {
    if (this.state.isAutosaveOn === true && this.state.isFormPane === true) {

    } 
};

Application.prototype.storeAppState = function () {
    localStorage.setItem('app_state', this.state);
};

Application.prototype.restoreAppState = function () {
    this.state = localStorage.getItem('app_state');
}

Application.prototype.getUserInfo = function () {

}

Application.prototype.storeUserInfo = function () {
    localStorage.setItem('user_info', this.user);
};

Application.prototype.restoreUserInfo = function () {
    this.user = localStorage.getItem('user_info');
}

Application.prototype.bindEvents = function (events) {
    EventBinder.bindEvents(events);
};

Application.prototype.run = function (routes) {
    router = new Router();
    router.route(routes);
    setTimeout(this.runAutosave, 20 * 1000);
    setTimeout(this.storeAppState, 300 * 1000);
};


// PARTE II - MVC

var View = function (target, path, view) {};

View.prototype.render = function (data) {
    var url = this.path + '/' + this.view
    $.get(url, function(response) {
        var html = Mustache.render(response, data);
        $(this.target).empty().append(html);
    });
};


// 
var BaseModel = function () {
    this.defaults = {
        method : 'GET',
        url : '',
        data : {},
        success : null, /* Function( Anything data, String textStatus, jqXHR jqXHR ) */
        error : null, /* Function( jqXHR jqXHR, String textStatus, String errorThrown ) */
        statusCode : {}, /* same as error */
        complete : null, /* Function( jqXHR jqXHR, String textStatus ) */
        async : true,
        timeout : null, /* Number */
        contentType : 'application/x-www-form-urlencoded; charset=UTF-8'
    };
    this.payload = {};
    this.endpoint = '';
};

BaseModel.prototype.getRequestData = function () {
    return Util.core.arrayMerge(this.defaults, this.payload);
};

// Messages

var BaseMessage  = function (target, message) { 
    this.target = target;
    this.message = message;
};
BaseMessage.prototype.displayMessage = function () {};

// 
var ErrorMessage = function () { 
    BaseMessage.call(this); 
};

ErrorMessage.prototype = new BaseMessage();
ErrorMessage.prototype.constructor = ErrorMessage;

// 
var SuccessMessage = function () { 
    BaseMessage.call(this); 
};

SuccessMessage.prototype = new BaseMessage();
SuccessMessage.prototype.constructor = SuccessMessage;

// 
var SystemMessage = function () { 
    BaseMessage.call(this); 
};

SystemMessage.prototype = new BaseMessage();
SystemMessage.prototype.constructor = SystemMessage;

// CONTROLLERS

// 
var ConfirmDelete = function () {};

// 
var ConfirmDeleteMany = function () {};

