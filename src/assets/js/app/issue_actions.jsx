
var IssueActions = Reflux.createActions([
    "load",             // init
	"toggleOwner"
]);    

IssueActions.toggleOwner.preEmit = function(sn) {
    superagent.get('toggle_assign/' + sn + '/' + IssueStore.data.last_update, function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issue_groups, json_result.last_update);

	});
};

/*
TodoActions.completeAll.preEmit = function() {
    request.put('/todos/check-all/', function () {});
};
*/