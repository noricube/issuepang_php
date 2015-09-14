var IssueRow = React.createClass({
    render: function() {
	
		var marked_issue = marked(this.props.issue);
		
        return (
					<tr>
						<td>{this.props.key}</td>
						<td>{this.props.status}</td>
						<td dangerouslySetInnerHTML={{__html: marked_issue}}></td>
						<td>
							<IssueComments comments={this.props.comments}/>
						</td>
					</tr>
            );
    }
});