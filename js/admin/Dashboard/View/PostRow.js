var $ = require('jquery');
var _ = require('underscore');
var Backbone = require('backbone');
var { tableRowTemplate } = require('../Templates/template');

module.exports = Backbone.View.extend({
    tagName: 'tr',

    initialize: function() {
        this.render();
    },

    render: function() {
        this.$el.html(tableRowTemplate(this.model.toJSON()));
    }
});
