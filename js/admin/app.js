var Backbone = require('backbone');
var Router = require('./router');

window.router = new Router();

Backbone.history.start();
