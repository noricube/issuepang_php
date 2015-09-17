var App = React.createClass({
    mixins: [Reflux.connect(IssueStore, "data")],
	propTypes: {
        issue_groups: React.PropTypes.array           
    },
	componentDidMount: function () {
        IssueActions.load();
    },
    render: function () {
		var values = new Array;
		for( var key in this.state.data.issues)
		{
			values.push(this.state.data.issues[key]);
		}
		
		//<!--<IssueGroup key="all" issues={this.state.data.issues} />-->
        return (
			<div className="container-fluid">
				<IssueGroup key="title" issues={values} />
			</div>
        );
    }
});