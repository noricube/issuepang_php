var IssueGroup = React.createClass({

	getInitialState: function () {
		this.state = {editIssue: '', editing: false};
		return this.state;
	},
	
	handleEdit: function () {
		this.state.editIssue = '';
		this.state.editing = true;
		
		this.setState(this.state);
	},
	
	handleChange: function (ev) {
		this.state.editIssue = event.target.value;
		
		this.setState(this.state);
	},
	
		
	handleSave: function() {
		var issue = this.state.editIssue;
		
		this.state.editing = false;
		this.state.editIssue = '';

		this.setState(this.state);
		IssueActions.addIssue(issue, this.props.status);
	},
	
	handleChangeStatus: function(status) {
		IssueActions.changeStatus(this.props.issue.SN, status);
	},
	
	handleCancel: function() {
		this.state.editing = false;
		
		this.setState(this.state);
	},
	
    render: function() {
		var items = this.props.issues.map(function (issue) {
			return (
					<IssueRow key={issue.SN} issue={issue} />
				);
		});

		var edit_class = React.addons.classSet({'hide_issue_editor': !this.state.editing, 'show_issue_editor' : this.state.editing});
		
        return (
				<table className="table table-striped table-bordered table-hover issue_group">
					<thead>
						<tr className="success">
							<th className="col-md-1">담당 / 이슈ID</th>
							<th className="col-md-1">관리정보</th>
							<th className="col-md-5" onDoubleClick={this.handleEdit}>{this.props.title}</th>
							<th className="col-md-5">진행 상황</th>
						</tr>
					</thead>
					<tbody>
						<tr className={edit_class}>
							<td className="col-md-1"></td>
							<td className="col-md-1"></td>
							<td className="col-md-5">
								<textarea onChange={this.handleChange} style={{width: '100%', minHeight: '10em'	}}></textarea>
								<button onClick={this.handleSave} className="glyphicon glyphicon-ok btn btn-success" />&nbsp;
								<button onClick={this.handleCancel} className="glyphicon glyphicon-remove btn btn-danger" />
							</td>
							<td className="col-md-5"></td>
						</tr>
					
						{items}
					</tbody>
				</table>
            );
    }
});