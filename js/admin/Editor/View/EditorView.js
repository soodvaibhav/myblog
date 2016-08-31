var $ = require('jquery');
var Backbone = require('backbone');
var _ = require('underscore');
var MediumEditor = require('medium-editor');
var { editorTemplate, errorTemplate } = require('../Template/template');
require('medium-editor-insert-plugin')($);
require('medium-editor/dist/css/medium-editor')
require('medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin')
require('../../css/editor')

module.exports = Backbone.View.extend({
    el: '#adminContent',

    initialize: function() {
        this.render();
        this.model.on('change', this.render, this);
    },

    events: {
        'click .postSubmit': 'postSubmit'
    },

    render: function() {
        this.$el.html(editorTemplate(this.model.toJSON()));

        this.editor = new MediumEditor('.postContent', {
            buttonLabels: 'fontawesome'
        });

        $('.postContent').mediumInsert({
            editor: this.editor,
            addons: {
              images: {
                fileUploadOptions: {
                    url: 'upload',
                    acceptFileTypes: /(\.|\/)(jpe?g|png)$/i,
                    fail: function(e, data) {
                        this.model.set({error: "Error Uploading Image :( please report."});
                    }.bind(this)
                },
                preview: false
              }
            }
        });

        this.editor.setContent(this.model.get('content'));
    },

    postSubmit: function(e) {
        e.preventDefault();
        var allContents = this.editor.serialize();

        var attrs = {
            title: this.$('.postTitle').val(),
            content: allContents["element-0"].value
        }

        this.model.set({
          title: this.$('.postTitle').val(),
          content: allContents["element-0"].value
        });

        if (this.model.isValid()) {
            this.model.save(attrs, {
                error: function(model, response, error) {
                    this.showError(response.responseJSON);
                }.bind(this)
            });
        } else {
            this.showError([this.model.validationError]);
        }
    },

    showError: function(errors) {
        this.$('.errorBox').html(errorTemplate({errors}));
    }
});
