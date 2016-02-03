
// PARTE II - MVC

/**
 * /
 * @param {[type]} path [description]
 */
MVC.View = function (path) {
    this.path = path;
};

/**
 * /
 */
MVC.RouteHandler = function () {
    this.ajax = new Component.Ajax();
    this.view = new MVC.View();
};

MVC.RouteHandler.prototype.handleError = function (jqXHR, textStatus, error) {
    message = new Component.ErrorMessage();
};

/**
 * /
 */
MVC.AjaxHandler = function () {
    this.ajax = new Component.Ajax();
    this.view = new MVC.View();
};

MVC.AjaxHandler.prototype.handleError = function (jqXHR, textStatus, error) {
    message = new Component.ErrorMessage();
};

/**
 * /
 */
MVC.EventHandler = function () {
    this.ajax = new Component.Ajax();
    this.view = new MVC.View();
};

MVC.EventHandler.prototype.handleError = function (jqXHR, textStatus, error) {
    message = new Component.ErrorMessage();
};

/**
 * /
 * @param  {[type]} target [description]
 * @param  {[type]} data   [description]
 * @param  {[type]} view   [description]
 * @return {[type]}        [description]
 */
MVC.View.prototype.render = function (target, data, view) {
    var url = this.path + '/' + this.view
    $.get(url, function(response) {
        var html = Mustache.render(response, data);
        $(this.target).empty().append(html);
    });
};

/**
 * /
 * @param {[type]} endpoint [description]
 */
MVC.Model = function (endpoint) {
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
    this.endpoint = endpoint;
};

/**
 * /
 * @return {[type]} [description]
 */
MVC.Model.prototype.getRequestData = function () {
    return Component.util.arrayMerge(this.defaults, this.payload);
};
