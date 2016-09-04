var $ = require('jquery');
var _ = require('underscore');
var Backbone = require('backbone');
var PostRow = require('./PostRow');
var { postsTableTemplate } = require('../Templates/template');

module.exports = Backbone.View.extend({
    initialize: function() {
        _.bindAll(this, 'addOne');
        $('#adminContent').html(this.el);
        this.collection.on('add', this.addOne, this);
        this.collection.on('reset', this.render, this);
        this.render();
    },

    render: function() {
        var prevPage, nextPage;
        var currentPage = parseInt(Backbone.history.fragment);

        if (currentPage && currentPage > 1) {
            prevPage = currentPage - 1;
        }

        if (this.collection.length > 10) {
            if (!currentPage) {
                currentPage = 1;
            }
            nextPage = currentPage + 1;
        }

        this.$el.html(postsTableTemplate({
            prevPage,
            nextPage
        }));

        _.each(this.collection.models, this.addOne);
    },

    addOne: function(postRowModel) {
        var postRow = new PostRow({model: postRowModel});
        this.$('tbody').append(postRow.el);
    }
});
