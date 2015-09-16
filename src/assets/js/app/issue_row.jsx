var IssueRow = React.createClass({
	toggleOwner: function() {
		IssueActions.toggleOwner(this.props.issue.SN);
	},
	
    render: function() {
	
		var marked_issue = marked(this.props.issue.Issue);
		
        return (
					<tr>
						<td onClick={this.toggleOwner}>{this.props.issue.Owner}<br/>{this.props.issue.SN}</td>
						<td>{this.props.issue.Status}</td>
						<td dangerouslySetInnerHTML={{__html: marked_issue}}></td>
						<td>
							<IssueComments comments={this.props.issue.Comments}/>
						</td>
					</tr>
            );
    }
});