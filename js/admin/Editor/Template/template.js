var _ = require('underscore');

var editorTemplate = _.template(`<div class="errorBox"></div>
<form>
  <div class="form-group">
    <input type="text" class="form-control postTitle" placeholder="Title of the post" value="<%= title %>">
  </div>
  <div class="form-group">
    <div class="postContent"></div>
  </div>
  <button type="submit" class="btn btn-default postSubmit">Submit</button>
</form>`);

var errorTemplate = _.template(`<% if (errors) { %>
  <div class="alert alert-warning">
    <% _.each(errors, function(error) { %>
        <strong>Warning!</strong> <%= error %>
    <% }) %>
  </div>
<% } %>`);

module.exports = {
  editorTemplate,
  errorTemplate
};
