/**
 * [Lux description]
 * @type {Object}
 */
Lux = {};

Lux.mixins = {};

Lux.ElementMappings = {
    ids : {
        applicationContainer : '#application-container-element',
        formId : 'form #form-id-element',
    },
    classes : {
        identifier : '.identifier-element',
        input : '.input-element',
        system : '.system-element',
    }
};

/**
 * /
 * @param {[type]} endpoint [description]
 */
Lux.Router = function (routes) {
    this.routes = routes;
};

/**
 * /
 * @param  {[type]} route [description]
 * @return {[type]}       [description]
 */
Lux.Router.prototype.dispatch = function (routes) {
    routie(routes || this.routes);
}

/**
 * /
 * @param  {[type]} route [description]
 * @return {[type]}       [description]
 */
Lux.Router.prototype.go = function (route) {
    routie(route);
}

/**
 * /
 * @param {[type]} endpoint [description]
 */
Lux.Storage = function () {
    this.payload = {
        error : this.handleError.bind(this),
    };
};

/**
 * /
 * @param  {[type]} key     [description]
 * @param  {[type]} val     [description]
 * @param  {[type]} success [description]
 * @return {[type]}         [description]
 */
Lux.Storage.prototye.query = function (key, val, success) {
    var payload = this.payload;
    payload.url = key;
    payload.data = val || {};
    payload.success = success;
    $.ajax(payload);
};

/**
 * /
 * @param  {[type]} jqXHR       [description]
 * @param  {[type]} textStatus  [description]
 * @param  {[type]} errorThrown [description]
 * @return {[type]}             [description]
 */
Lux.Storage.prototype.handleError = function (jqXHR, textStatus, errorThrown) {

};

/**
 * /
 * @param {[type]} endpoint [description]
 */
Lux.LocalStorage = function () {
    
};

/**
 * /
 * @param  {[type]} key [description]
 * @param  {[type]} val [description]
 * @return {[type]}     [description]
 */
Lux.LocalStorage.prototype.query = function (key, val) {

};


// http://stackoverflow.com/questions/12797700/jquery-detect-change-in-input-field
// http://stackoverflow.com/questions/1948332/detect-all-changes-to-a-input-type-text-immediately-using-jquery

/**
 * /
 * @param {[type]} endpoint [description]
 */
Lux.Model = function (endpoint, storage, properties) {
    this.endpoint = endpoint;
    this.storage = storage || new Storage();
    this.properties = properties || {};
    this.isDirty = false;
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.set = function (key, val) {
    if (this.properties[key] !== val) {
        this.isDirty = true;
    }
    this.properties[key] = val;
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.get = function (key) {
    return this.properties[key];
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.props = function () {
    return this.properties;
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.isDirty = function () {
    return this.isDirty;
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.query = function (payload, callback) {
    this.storage.query(payload.url, payload, callback);
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.index = function (handler, page) {
    var payload = {};
    payload.url = this.endpoint + '' + page;
    var callback = handler.list;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.show = function (handler, id) {
    var payload = {};
    payload.url = this.endpoint + '';
    var callback = handler.show;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.deactivated = function (handler, page) {
    var payload = {};
    payload.url = this.endpoint + '';
    var callback = handler.deactivatedList;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.deleted = function (handler, page) {
    var payload = {};
    payload.url = this.endpoint + '';
    var callback = handler.deletedList;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.store = function (handler) {
    var payload = {};
    payload.url = this.endpoint + '';
    payload.method = '';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.destroy = function (handler, id) {
    var payload = {};
    payload.url = this.endpoint + '';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.deleteMany = function (handler, ids) {
    var payload = {};
    payload.url = this.endpoint + '/delete_many';
    payload.method = 'post';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.delete = function (handler, id) {
    var payload = {};
    payload.url = this.endpoint + '/' + id + 'delete';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.restore = function (handler, id) {
    var payload = {};
    payload.url = this.endpoint + '/' + id + 'restore';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Model.prototype.mark = function (handler, id, status) {
    var payload = {};
    payload.url = this.endpoint + '/' + id + '/mark';
    payload.method = 'post';
    var callback = handler.displayMessage;
    this.query(payload, callback.bind(handler));
};


/**
 * /
 */
Lux.ListHandler = function (eventManager, view) {
    this.eventManager = eventManager;
    this.view = view;
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.ListHandler.prototype.list = function (data, textStatus, jqXHR) {
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.ListHandler.prototype.deletedList = function (data, textStatus, jqXHR) {
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.ListHandler.prototype.deactivatedList = function (data, textStatus, jqXHR) {
};

/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.ListHandler.prototype.listShow = function (data, textStatus, jqXHR) {
};


/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.ListHandler.prototype.formShow = function (data, textStatus, jqXHR) {

};


/**
 * /
 * @param {[type]} selector     [description]
 * @param {[type]} model        [description]
 * @param {[type]} routes       [description]
 * @param {[type]} actions      [description]
 * @param {[type]} templatePath [description]
 */
Lux.Controller = function (selector, model, routes, actions, templatePath) {
    this.selector = selector;
    this.model = model;
    this.router = new Lux.Router(routes);
    this.actionManager = new Lux.ActionManager(actions);
    this.view = new View(templatePath, this.eventManager);
    this.formHandler = new FormHandler(this.eventManager, this.view);
    this.listHandler = new ListHandler(this.eventManager, this.view);
};

Lux.Controller.prototype.init = function () {
    this.router.dispatch();
    this.actionManager.bindAll();
    this.trigger('controller-routed');
};

Lux.Controller.prototype.go = function (route) {
    this.router.go(route);
    this.trigger('route-changed');
};

Lux.Controller.prototype.triggerGo = function (event, route) {
    this.go(route);
};

Lux.Controller.prototype.trigger = function (key, params, decorator) {
    this.actionManager.trigger(key, params, decorator);
};

Lux.Controller.prototype.doNothing = function () {};



/**
 * /
 * @param  {[type]} data       [description]
 * @param  {[type]} textStatus [description]
 * @param  {[type]} jqXHR      [description]
 * @return {[type]}            [description]
 */
Lux.Controller.prototype.displayMessage = function (data, textStatus, jqXHR) {
    var message = new SuccessMessage(data.message);
    message.display();
    var redirect = this.endpoint;
    if (data.result.id) {
        redirect += '/' + data.result.id + '/' + data.next;
    } else {
        redirect += '/' + data.next;
    }
    this.go(redirect);
};


/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.createForm = function (event) {
    var actions;
    this.view.render('#', 'comment-form', {}, actions);
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.storeForm = function (event) {
    var data = this.getFormInput();
    for (prop in data) {
        if (data.hasOwnProperty(prop)) {
            this.model.set(prop, data[prop]);
        }
    }
    this.model.store(this.formHandler);
    var id = this.model.get('id');
    this.router.go('/' + id + '/edit');
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.editForm = function (event) {
    var id = this.getFormItemId();
    var data = this.model.show(this.formHandler, id);
    var actions;
    this.view.render('#', 'edit-comment-form', data, actions);
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.updateForm = function (event) {
    var data = this.getFormInput();
    for (prop in data) {
        if (data.hasOwnProperty(prop)) {
            this.model.set(prop, data[prop]);
        }
    }
    if (this.model.isDirty()) {
        this.trigger('comment-model-changed', [this.model]);
        this.model.store(this.formHandler);
    }
    var id = this.model.get('id');
    this.router.go('/' + id + '/edit');
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.editRow = function (event) {
    var id = this.getRowId();
    var data = this.model.show(this.listHandler, id);
    var actions;
    this.view.render('#', 'edit-in-place-comment-list', data, actions);
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.updateRow = function (event) {
    var id = $(event.target).attr('data-id');
    this.model.set('id', id);
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.confirmDelete = function (event) {
    var actions;
    this.view.render('#', 'confirm-delete', {}, actions);
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.delete = function (event) {
    var id = $(event);
    this.model.delete(this, id)
};

/**
 * /
 * @param  {[type]} event [description]
 * @return {[type]}       [description]
 */
Lux.Controller.prototype.confirmDeleteMany = function (event) {
    var actions;
    this.view.render('#', 'confirm-delete-many', {}, actions);
};

Lux.Controller.prototype.deleteMany = function (event) {
    var ids = $(event);
    this.model.deleteMany(this, ids);
};

Lux.Controller.prototype.restore = function (event) {
    var id = $(event);
    this.model.restore(this, id);
};

Lux.Controller.prototype.deleted = function (event) {
    var page = $(event);
    this.model.deleted(this);
};

Lux.Controller.prototype.deactivated = function (event) {
    var page = $(event);
    this.model.deactivated(this);
};

/**
 * /
 * @param {[type]} path         [description]
 * @param {[type]} eventManager [description]
 */
Lux.View = function (path, eventManager) {
    this.path = path;
    this.eventManager = eventManager;
};

Lux.View.prototype.render = function (target, view, data, actions) {
    var viewPath = this.path + '/' + view;
    var eventManager = this.eventManager;
    $.get(viewPath, function (response) {
        renderedHTML = Mustache.render(response, data);
        $(target).empty().html(renderedHTML);
        eventManager.rebindAll(actions);
        eventManager.trigger(view + '-view-rendered', [data]);
    });
};

/**
 * /
 * @param {[type]}   name     [description]
 * @param {[type]}   scope    [description]
 * @param {[type]}   selector [description]
 * @param {Function} callback [description]
 */
Lux.DefaultAction = function (key, name, scope, selector, callback) {
    this.key = key;
    this.name = name;
    this.scope = scope;
    this.selector = selector;
    this.callback = callback;
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.DefaultAction.prototype.bind = function () {
    $(this.scope).on(this.name, this.selector, this.callback);
};

/**
 * /
 * @return {[type]} [description]
 *//
Lux.DefaultAction.prototype.unbind = function () {
    $(this.selector).on(this.name);
};

/**
 * /
 * @param {[type]}   params     [description]
 * @return {[type]} [description]
 *//
Lux.DefaultAction.prototype.trigger = function (params) {
    $(this.selector).trigger(this.name, params);
};

/**
 * /
 * @param {[type]}   name     [description]
 * @param {[type]}   scope    [description]
 * @param {[type]}   selector [description]
 * @param {Function} callback [description]
 */
Lux.CustomAction = function (name, scope, selector, callback) {
    Lux.DefaultAction.call(this, name, name, scope, selector, callback);
};
Lux.CustomAction.prototype = new Lux.DefaultAction();
Lux.CustomAction.prototype.constructor = Lux.CustomAction;


/**
 * /
 * @param {[type]} actions [description]
 */
Lux.ActionManager = function (actions) {
    this.binded = {};
    this.actions = {};
    for (action in actions) {
        if (actions.hasOwnProperty(action)) {
            this.register(action);
        }
    }
};

Lux.ActionManager.prototype.init = function () {

};

/**
 * /
 * @param  {[type]} key [description]
 * @param  {[type]} action  [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.register = function (action) {
    this.actions[action.key] = action;
};

/**
 * /
 * @param  {[type]} key [description]
 * @param  {[type]} action  [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.hasAction = function (key) {
    return this.actions.hasOwnProperty(key);
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.bind = function (key) {
    // if is string elseif is obj
    var action = this.registered[key];
    action.bind();
    this.binded[key] = true;
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.bindAll = function (actions) {
    for (action in actions || this.actions) {
        if (this.actions.hasOwnProperty(action)) {
            action.bind();
        }
    }
    action.bind();
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.unbind = function (key) {
    // if is string elseif is obj
    var action = this.actions[key];
    action.unbind();
    this.binded[key] = false;
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.unbindAll = function () {
    for (prop in this.actions) {
        if (this.actions.hasOwnProperty(prop)) {
            prop.unbind();
        }
    }
    this.binded = {};
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.rebind = function (key) {
    var action = this.actions[key];
    action.unbind();
    action.bind();
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.rebindAll = function (actions) {
    for (action in actions || this.actions) {
        if (this.binded.hasOwnProperty(action)) {
            action.unbind();
            action.bind();
        }
    }
};

/**
 * /
 * @param  {[type]} key [description]
 * @return {[type]}     [description]
 */
Lux.ActionManager.prototype.trigger = function (key, params, decorator) {
    var action = this.registered[key];
    !decorator || decorator.before();
    action.trigger(params);
    !decorator || decorator.after();
};

/**
 * /
 * @param {[type]} endpoint [description]
 */
Lux.App = function (selector, controllers) {
    this.selector = selector;
    this.controllers = controllers;
    this.storage = new Lux.Storage();
};

Lux.App.prototype.run = function () {
    for (var i = this.controllers.length - 1; i >= 0; i--) {
        this.controllers[i].init();
    };
    this.trigger('app-load');
};

Lux.augment = function (default, mixin) {

};

// Messages

/**
 * /
 * @param {[type]} target  [description]
 * @param {[type]} message [description]
 */
Lux.Message  = function (message, name, target) { 
    this.message = message;
    this.name = name || 'info';
    this.target = target || '#messages';
};

/**
 * /
 * @return {[type]} [description]
 */
Lux.Message.prototype.display = function () {
    var view = new View('/messages');
    view.render(this.target, 'default-message', {'class' : this.name, 'message' : this.message}, {});
};

/**
 * /
 */
Lux.ErrorMessage = function (message) { 
    Lux.Message.call(this, message, 'danger'); 
};

Lux.ErrorMessage.prototype = new Lux.Message();
Lux.ErrorMessage.prototype.constructor = Lux.ErrorMessage;

/**
 * /
 */
Lux.SuccessMessage = function (message) { 
    Lux.Message.call(this, message, 'success'); 
};

Lux.SuccessMessage.prototype = new Lux.Message();
Lux.SuccessMessage.prototype.constructor = Lux.SuccessMessage;

/**
 * /
 */
Lux.SystemMessage = function (message) { 
    Lux.Message.call(this, message, 'warning'); 
};

Lux.SystemMessage.prototype = new Lux.Message();
Lux.SystemMessage.prototype.constructor = Lux.SystemMessage;
