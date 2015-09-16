var App = React.createClass({
    mixins: [Reflux.connect(IssueStore, "issues")],
	propTypes: {
        issue_groups: React.PropTypes.array           
    },
	componentDidMount: function () {
        IssueActions.load();
    },
    render: function () {
		
		console.log(this.state);
		var items = this.state.issues.issue_groups.map(function (issue_group) {
			return <IssueGroup key={issue_group.Title} issues={issue_group.Issues} />;
		});

        return (
			<div className="container-fluid">
				{items}
			</div>
        );
    }
});