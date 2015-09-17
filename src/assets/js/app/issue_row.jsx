var IssueRow = React.createClass({
	toggleOwner: function() {
		IssueActions.toggleOwner(this.props.issue.SN);
	},
	
	getInitialState: function () {
		this.state = {editIssue: this.props.issue.Issue, editing: false};
		return this.state;
	},
	
	handleEdit: function () {
		this.state.editIssue = this.props.issue.Issue;
		this.state.editing = true;
		
		this.setState(this.state);
	},
	
	handleChange: function (ev) {
		this.state.editIssue = event.target.value;
		
		this.setState(this.state);
	},
	
	handleSave: function() {
		var issue = this.state.editIssue;
		
		console.log(issue);
		
		this.state.editing = false;
		this.state.editIssue = this.props.issue.Issue;

		this.setState(this.state);
		IssueActions.editIssue(this.props.issue.SN, issue);
	},
	
	handleCancel: function() {
		this.state.editing = false;
		
		this.setState(this.state);
	},
	
    render: function() {
	
		var marked_issue = marked(this.props.issue.Issue);
		
		var issue_classes = React.addons.classSet({'issue': !this.state.editing, 'issue_edit' : this.state.editing});
		return (
					<tr className={issue_classes}>
						<td onClick={this.toggleOwner}>{this.props.issue.Owner}<br/>{this.props.issue.SN}</td>
						<td>{this.props.issue.Status}</td>
						<td className="issue_title" onDoubleClick={this.handleEdit} dangerouslySetInnerHTML={{__html: marked_issue}}></td>
						<td className="issue_editor">
							<textarea onChange={this.handleChange} style={{width: '100%', minHeight: '10em'	}} defaultValue={this.props.issue.Issue}></textarea>
							<button onClick={this.handleSave} className="glyphicon glyphicon-ok btn btn-success" />&nbsp;
							<button onClick={this.handleCancel} className="glyphicon glyphicon-remove btn btn-danger" />
						</td>
						<td>
							<IssueComments comments={this.props.issue.Comments}/>
						</td>
					</tr>
			);
    }
});