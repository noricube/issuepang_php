var IssueStore = Reflux.createStore({
    listenables: [IssueActions],
    init: function () {
        this.listenTo(IssueActions.load, this.fetchData);
    },
    getInitialState: function () {
		this.data = {issues:{}, last_update: 0, set_order: [], part_order: []};
        return this.data;
    },
    fetchData: function () {
        superagent.get('issues').end(function (err, res) {
			var json_result = JSON.parse(res.text);
			
			this.data.set_order = json_result.set_order;
			this.data.part_order = json_result.part_order;
			
			this.updateData(json_result.issues, json_result.last_update);
        }.bind(this));
    },
	
	updateData: function(issues, last_update) {
	
		issues.forEach(function(issue) {
			this.data.issues[issue.SN] = issue;
		}.bind(this));
		
		this.data.last_update = last_update;
		
		this.trigger(this.data);
		
	}
});
