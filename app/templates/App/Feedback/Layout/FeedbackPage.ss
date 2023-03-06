<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
    <article>
        <h1>{$Title}</h1>
        <div class="content">{$Content}</div>
    </article>
    {$feedbackForm}
</div>
<div class="content-container">
    <hr>
    <h2>Feedback Stats</h2>
    <table width="100%">
        <thead>
            <tr>
                <th width="40%">Date</th>
                <th>No of Submissions</th>
            </tr>
        </thead>
        <tbody>
			<% loop $getFeedbackSummary %>
            <tr>
                <td>{$Created.Format('d MMMM y')}</td>
                <td>{$submissionsCount}</td>
            </tr>
            <% end_loop %>
        </tbody>
    </table>
</div>
