<% include SideBar %>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
hr {
  border: 1;
  clear:both;
  display:block;
  width: 96%;               
  background-color:#FFFF00;
  height: 1px;
}
</style>

<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
	</article>
		$Form
		$CommentsForm
</div>
                             

<hr/>
<h2>Stats</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">No Of Submission</th>
    </tr>
  </thead>
  <tbody>
    <% loop $GroupedFeedbacksByDate.GroupedBy(DateCreated) %> 

        <tr>
        <td>$DateCreated</td>
        <td>$Children.Count()</td>
        </tr>
    <% end_loop %>

  </tbody>
</table>
