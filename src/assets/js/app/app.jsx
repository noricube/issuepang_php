var App = React.createClass({
    mixins: [Reflux.connect(IssueStore, "data")],
	propTypes: {
        issue_groups: React.PropTypes.array           
    },
	componentDidMount: function () {
        IssueActions.load();
    },
    render: function () {
	
		var issue_groups = new Object;
		for( var order in this.state.data.part_order )
		{
			issue_groups[this.state.data.part_order[order]] = new Array;
		}
		
		_.each(this.state.data.issues, function (issue) {
			issue_groups[issue.Status].push(issue);
		});

        return (
			<div className="container-fluid">
				{_.map(issue_groups, function (value, key) {
					var title = '모든 작업-' + key + ' (' + value.length + ')'
					return <IssueGroup key={key} title={title} issues={value} status={key} />;
				})}
			</div>
        );
    }
});