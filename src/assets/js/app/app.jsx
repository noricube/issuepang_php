var App = React.createClass({
    mixins: [Reflux.connect(IssueStore, "issue_groups")],
	propTypes: {
        issue_groups: React.PropTypes.array           
    },
	componentDidMount: function () {
        IssueActions.load();
    },
    render: function () {
		
		var items = this.state.issue_groups.map(function (issue_group) {
			return <IssueGroup key={issue_group.Title} issues={issue_group.Issues} />;
		});

        return (
			<div className="container-fluid">
				{items}
			</div>
        );
    }
});