var IssueStore = Reflux.createStore({
    listenables: [IssueActions],
    init: function () {
        this.listenTo(IssueActions.load, this.fetchData);
    },
    getInitialState: function () {
        this.issue_groups = [];
        return this.issue_groups;
    },
    fetchData: function () {
        superagent.get('issues').end(function (err, res) {
            var issue_groups = JSON.parse(res.text).issue_groups;
			
			this.issue_groups = issue_groups.map(function (issue_group) {
				return new Issue(issue_group.Title, issue_group.Issues);
			});
			
			this.trigger(this.issue_groups);
        }.bind(this));
    },
});
