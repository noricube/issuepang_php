var IssueStore = Reflux.createStore({
    listenables: [IssueActions],
    init: function () {
        this.listenTo(IssueActions.load, this.fetchData);
    },
    getInitialState: function () {
		this.data = {issue_groups:[], last_update: 0};
        return this.data;
    },
    fetchData: function () {
        superagent.get('issues').end(function (err, res) {
			var json_result = JSON.parse(res.text);
			this.updateData(json_result.issue_groups, json_result.last_update);
        }.bind(this));
    },
	
	updateData: function(issue_groups, last_update) {
		this.data.issue_groups = issue_groups.map(function (issue_group) {
			return new Issue(issue_group.Title, issue_group.Issues);
		});
		
		this.data.last_update = last_update;
		
		this.trigger(this.data);
		
	}
});
