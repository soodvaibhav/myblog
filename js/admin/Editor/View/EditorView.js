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

  template: _.template(editorTemplate),

  initialize: function() {
    this.model.on('change', this.render, this);
    this.render();
  },

  events: {
    'click .postSubmit': 'postSubmit'
  },

  render: function() {
    this.$el.html(this.template(this.model.toJSON()));
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

    // this.model.set({
    //   title: this.$('.postTitle').val(),
    //   content: allContents["element-0"].value
    // }, {validate: true});
    //
    // var error = _.template(errorTemplate)({error: this.model.validationError});
    // this.$('.errorBox').html(error);
    var attrs = {
        title: this.$('.postTitle').val(),
        content: allContents["element-0"].value
    }
    this.model.save(attrs, {
        error: function(model, response, error) {
            debugger;
        }
    });
  }
});
