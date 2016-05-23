
/**
 * /
 * @param {[type]} message [description]
 * @param {[type]} view    [description]
 */
var Message = function (message) {
    this.messages = [message] || [];
};

/**
 * /
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 */
Message.prototype.appendMessage = function (message) {
    this.messages.push(message);        
    console.log('adding message: ' + message);
};

/**
 * /
 * @return {[type]} [description]
 */
Message.prototype.displayMessages = function () {
    var html = '';
    var container = '#message-container';
    for (var i = this.messages.length - 1; i >= 0; i--) {
        html += '<div class="label alert alert-success">' + this.messages[i] + '</div>';
    };
    $(container).empty().append(html);
    console.log('displaying messages: ' + this.messages);
    this.messages = [];
    $(container).children().fadeOut(4200);
}

/**
 * /
 * @return {[type]} [description]
 */
Message.prototype.displayErrorMessages = function () {
    var html = '';
    var container = '#message-container';
    for (var i = this.messages.length - 1; i >= 0; i--) {
        html += '<div class="label alert alert-danger">' + this.messages[i] + '</div>';
    };
    $(container).empty().append(html);
    console.log('displaying messages: ' + this.messages);
    this.messages = [];
    $(container).children().fadeOut(4200);
}

/**
 * /
 * @param {[type]} params [description]
 */
var AjaxRequest = function (params) {
    var params = params || {};
    var defaults = {
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

    this.merged = Util.mergeParams(defaults, params);
};

/**
 * /
 * @param {[type]} key   [description]
 * @param {[type]} value [description]
 */
AjaxRequest.prototype.setParam = function (key, value) {
    this.merged[key] = value;
};

/**
 * /
 * @param  {[type]} params [description]
 * @return {[type]}        [description]
 */
AjaxRequest.prototype.send = function (params) {
    var finalMerged = Util.mergeParams(this.merged, params);
    /* jQuery.ajax */
    $.ajax(finalMerged);
};


/**
 * [Util description]
 * @type {Object}
 */
var Util = {};

Util.mergeParams = function (defaults, params) {
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

/* ui tab control */

Util.changeSection = function (section) {
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

Util.render = function (target, path, view, data) {
    var url = path + '/' + view
    $.get(url, function(response) {
        var html = Mustache.render(response, data);
        $(target).empty().append(html);
    });
};

Util.selectFormElements = function (selectors) {

};

Util.appendFormElements = function (elementMap) {

};

Util.clearForm = function (selectors) {

};

Util.storeAppState = function (state) {
    var storage = new LocalStorageAdapter();
    storage.store('app_state', info);
};

Util.storeUserInfo = function (info) {
    var storage = new LocalStorageAdapter();
    storage.store('user_info', info);
};

Util.formatDate = function (value) {

};
