
var IssueActions = Reflux.createActions([
    "load",             // init
	"toggleOwner",
	"addIssue",
	"editIssue",
	"addComment",
	"editComment",
	"changeStatus",
]);    

IssueActions.toggleOwner.preEmit = function(sn) {
    superagent.get('toggle_assign/' + sn + '/' + IssueStore.data.last_update, function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update);

	});
};

IssueActions.addIssue.preEmit = function(issue, status) {
	superagent.post('add_issue').type('form').send({issue:issue, status: status, last_update: IssueStore.data.last_update}).end(function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update)
	});
};


IssueActions.editIssue.preEmit = function(sn, issue) {
	superagent.post('edit_issue/' + sn).type('form').send({issue:issue, last_update: IssueStore.data.last_update}).end(function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update)
	});
};

IssueActions.addComment.preEmit = function(sn, comment) {
	superagent.post('add_comment/'+ sn).type('form').send({comment:comment, last_update: IssueStore.data.last_update}).end(function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update)
	});
};

IssueActions.editComment.preEmit = function(sn_cmt, comment) {
	superagent.post('edit_comment/' + sn_cmt).type('form').send({comment:comment, last_update: IssueStore.data.last_update}).end(function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update)
	});
};


IssueActions.changeStatus.preEmit = function(sn, status) {
	superagent.post('change_status/' + sn).type('form').send({status:status, last_update: IssueStore.data.last_update}).end(function (err, res) {
		var json_result = JSON.parse(res.text);
		IssueStore.updateData(json_result.issues, json_result.last_update)
	});
};


/*
TodoActions.completeAll.preEmit = function() {
    request.put('/todos/check-all/', function () {});
};
*/