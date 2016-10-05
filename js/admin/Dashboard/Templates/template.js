var _ = require('underscore');

var tableRowTemplate = _.template(`<td><%= title %></td>
<td><%= status %></td>
<td><a href="#edit/<%= id %>">Edit</a></td>`);

var postsTableTemplate = _.template(`<table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
</table>
<nav>
  <ul class="pager">
      <% if (prevPage) { %>
          <li class="previous"><a href="#<%= prevPage %>"><span aria-hidden="true">&larr;</span> Previous</a></li>
      <% } %>
      <% if (nextPage) { %>
          <li class="next"><a href="#<%= nextPage %>">Next <span aria-hidden="true">&rarr;</span></a></li>
      <% } %>
  </ul>
</nav>`);

module.exports = {
  tableRowTemplate,
  postsTableTemplate
};
