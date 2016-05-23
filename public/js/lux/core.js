CoreComponent = {};
CoreComponent.Interaction.state = {};

CoreComponent.Interaction.models = {};

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Comment = function (endpoint, properties) {
    var endpoint = endpoint || '/core/interaction/comment';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Folksonomy = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Like = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Vote = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Area = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Block = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Menu = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Collaboration = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};  
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Collection = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Config = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Comment.prototype = new Lux.Model();
CoreComponent.Interaction.models.Comment.prototype.constructor = CoreComponent.Interaction.models.Comment;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Ownership = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Ownership.prototype = new Lux.Model();
CoreComponent.Interaction.models.Ownership.prototype.constructor = CoreComponent.Interaction.models.Ownership;

/**
 * /
 * @param {[type]} properties [description]
 */
CoreComponent.Interaction.models.Type = function (properties) {
    var endpoint = endpoint || '/core/interaction/';
    var storage = new Storage();
    Lux.Model.call(this, endpoint, storage, properties); 
};
CoreComponent.Interaction.models.Type.prototype = new Lux.Model();
CoreComponent.Interaction.models.Type.prototype.constructor = CoreComponent.Interaction.models.Type;


CoreComponent.Interaction.controllers = {};

CoreComponent.Interaction.controllers.CommentController = function (selector) {
    var endpoint = '/admin/core/interaction/comment';
    var model = new Comment(endpoint);
    var routes = {
        endpoint + '/{page?}' : this.index.bind(this),        
        endpoint + '/deleted/{page?}' : this.deleted.bind(this),
        endpoint + '/deactivated/{page?}' : this.deactivated.bind(this),
        endpoint + '/create' : this.create.bind(this),        
        endpoint + '/{id}/edit' : this.edit.bind(this),
        endpoint + '/{id}/delete' : this.delete.bind(this),
        endpoint + '/{id}/restore' : this.restore.bind(this),
    };
    var actions = {
       'app-loaded' : new CustomAction('app-loaded', selector, '#', this.renderDashboard.bind(this)),
       'route-changed' : new CustomAction('route-changed', selector, '#', this.clearApplication.bind(this))
       'comment-model-change' : new CustomAction('comment-model-change', selector, '#', this.saveIf.bind(this)),

       'comment-form-store' : new DefaultAction('comment-form-store', 'click', selector, '#', this.formStore.bind(this)),
       'comment-form-clear' : new DefaultAction('comment-form-clear', 'click', selector, '#', this.clearForm.bind(this)),

       'comment-list-edit' : new CustomAction('comment-list-edit', selector, '#', this.listEdit.bind(this)),
       'comment-list-store' : new DefaultAction('comment-list-store', 'click', selector, '#', this.listStore.bind(this)),

       'comment-confirm-delete' : new DefaultAction('comment-confirm-delete', 'click', selector, '#', this.renderConfirmation.bind(this)),
       'comment-confirm-delete-many' : new DefaultAction('comment-confirm-delete-many', 'click', selector, '#', this.renderConfirmation.bind(this)),
    };

    Lux.Controller.call(this, selector, endpoint, model, actions, routes); 
    this.endpoint = endpoint;
};


CoreComponent.Interaction.controllers.FolksonomyController = function () {};
CoreComponent.Interaction.controllers.LikeController = function () {};
CoreComponent.Interaction.controllers.VoteController = function () {};
CoreComponent.Interaction.controllers.AreaController = function () {};
CoreComponent.Interaction.controllers.BlockController = function () {};
CoreComponent.Interaction.controllers.MenuController = function () {};
CoreComponent.Interaction.controllers.CollaborationController = function () {};
CoreComponent.Interaction.controllers.CollectionController = function () {};
CoreComponent.Interaction.controllers.ConfigController = function () {};
CoreComponent.Interaction.controllers.OwnershipController = function () {};
CoreComponent.Interaction.controllers.TypeController = function () {};


CoreComponent.Interaction.InteractionApp = function () {
    this.controllers = {
        comment : new CoreComponent.Interaction.controllers.Controller(),
        folksonomy : new CoreComponent.Interaction.controllers.Controller(),
        like : new CoreComponent.Interaction.controllers.Controller(),
        vote : new CoreComponent.Interaction.controllers.Controller(),
        area : new CoreComponent.Interaction.controllers.Controller(),
        block : new CoreComponent.Interaction.controllers.Controller(),
        menu : new CoreComponent.Interaction.controllers.Controller(),
        collaboration : new CoreComponent.Interaction.controllers.Controller(),
        collection : new CoreComponent.Interaction.controllers.Controller(),
        config : new CoreComponent.Interaction.controllers.Controller(),
        ownership : new CoreComponent.Interaction.controllers.Controller(),
        type : new CoreComponent.Interaction.controllers.TypeController(),
    };
};
