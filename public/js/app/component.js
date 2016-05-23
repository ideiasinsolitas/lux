// PARTE I - CORE

var Component = {};

// APPLICATION

Component.config = {
    autosave : false,
    autosaveInterval : 15 * 1000,
    messageFadeOut : 4 * 1000,
    templatePath: '/js/templates',
    spinnerHtml : '<img class="loading-image" src="/images/loading.svg">',
};

// UTIL

/**
 * [util description]
 * @type {Object}
 */
Component.util || Component.util = {};

Component.util.arrayMerge = function (defaults, params) {
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
Component.util.augment = function (receivingClass, givingClass) {
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

Component.util.formats || Component.util.formats = {}

Component.util.formatDate = function (value) {

};

// AJAX WRAPPER

Component.Ajax = function () {};

/**
 * /
 * @param  {[type]} params [description]
 * @return {[type]}        [description]
 */
Component.Ajax.prototype.sendRequest = function (params) {
    $.ajax(params);
};


// STATIC ROUTER WRAPPER

Component.Router = function () {};

/**
 * /
 * @param  {[type]} routes [description]
 * @return {[type]}        [description]
 */
Component.Router.prototype.route = function (routes) {
    routie(routes);
};

/**
 * /
 * @param  {[type]} route [description]
 * @return {[type]}       [description]
 */
Component.Router.prototype.redirect = function (route) {
    routie(route);
}

/**
 * /
 */
Component.LocalStorageAdapter = function () {};

/**
 * /
 * @param  {[type]} namespace [description]
 * @param  {[type]} data      [description]
 * @return {[type]}           [description]
 */
Component.LocalStorageAdapter.prototype.store = function (namespace, data) {
    if (arguments.length > 1) {
        return localStorage.setItem(namespace, JSON.stringify(data));
    } else {
        var store = localStorage.getItem(namespace);
        return (store && JSON.parse(store)) || {};
    };
};

/**
 * /
 * @param {[type]} routes [description]
 * @param {[type]} events [description]
 */
Component.Application = function (routes, events) {
    this.state = {};
    this.state.activePane = '';
    this.state.isEditPane = false;
    this.state.isAutosaveOn = false;
    this.user = {};
    this.config = Component.config;
};

/**
 * /
 * @param  {[type]} section [description]
 * @return {[type]}         [description]
 */
Component.Application.prototype.changeSection = function (section) {
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

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.turnOnAutosave = function () {
    this.state.isAutosaveOn = true;
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.turnOffAutosave = function () {
    this.state.isAutosaveOn = false;
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.runAutosave = function () {
    if (this.state.isAutosaveOn === true && this.state.isEditPane === true) {

    } 
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.storeAppState = function () {
    localStorage.setItem('app_state', this.state);
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.restoreAppState = function () {
    this.state = localStorage.getItem('app_state');
}

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.getUserInfo = function () {
    this.user = localStorage.getItem('user_info');
}

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.storeUserInfo = function () {
    localStorage.setItem('user_info', this.user);
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.restoreUserInfo = function () {
    this.user = localStorage.getItem('user_info');
}

/**
 * /
 * @return {[type]} [description]
 */
Component.Application.prototype.run = function () {
    Component.Router.route(this.routes);
    this.bindEvents(this.events);
    setTimeout(this.runAutosave, 20 * 1000);
    setTimeout(this.storeAppState, 300 * 1000);
    setTimeout(this.storeUserInfo, 300 * 1000);
};

/**
 * /
 * @param  {[type]} events [description]
 * @return {[type]}        [description]
 */
Component.Application.prototype.bindEvents = function (events) {
    for (var i = 0; i < events.length; i++) {
        var e = events[i];
        this.bindEvent(e);
    };
};

/**
 * /
 * @param  {[type]} events [description]
 * @return {[type]}        [description]
 */
Component.Application.prototype.bindEvent = function (event) {
    $(event.scope).on(event.event, event.target, event.callback);
};


// Messages

/**
 * /
 * @param {[type]} target  [description]
 * @param {[type]} message [description]
 */
Component.Message  = function (message, class, target) { 
    this.message = message;
    this.class = class;
    this.target = target || '#messages';
};

/**
 * /
 * @return {[type]} [description]
 */
Component.Message.prototype.displayMessage = function () {

};

Component.messages = {};

/**
 * /
 */
Component.messages.ErrorMessage = function (message) { 
    MVC.Message.call(this, message, 'danger'); 
};

Component.messages.ErrorMessage.prototype = new MVC.Message();
Component.messages.ErrorMessage.prototype.constructor = Component.messages.ErrorMessage;

/**
 * /
 */
Component.messages.SuccessMessage = function (message) { 
    MVC.Message.call(this, message, 'success'); 
};

Component.messages.SuccessMessage.prototype = new MVC.Message();
Component.messages.SuccessMessage.prototype.constructor = Component.messages.SuccessMessage;

/**
 * /
 */
Component.messages.SystemMessage = function (message) { 
    MVC.Message.call(this, message, 'warning'); 
};

Component.messages.SystemMessage.prototype = new MVC.Message();
Component.messages.SystemMessage.prototype.constructor = Component.messages.SystemMessage;
