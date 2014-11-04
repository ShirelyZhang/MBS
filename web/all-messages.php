<div class="filter-section">
  <form id="messageSearchForm">
    <input type="text" name="message-title" placeholder="Title">
    <input type="text" name="message-content" placeholder="Content">
    <input type="text" name="message-author" placeholder="Author">
    <input type="button" value="Search" id="searchBtn">
    <span class="form-group clearfix"></span>
  </form>
</div>
<div class="message-list-block">
  <div class="message-list-table">
    <table id="messageListTable">
      <thead>
        <th class="col-id">ID</th>
        <th class="col-title">Title</th>
        <th class="col-author">Author</th>
        <th class="col-created">Created</th>
      </thead>
      <tbody id="messageListTbody">
        <tr><td colspan="4">No Record</td></tr>
      </tbody>
    </table>
  </div>
  <div class="pagination-bar"></div>
</div>