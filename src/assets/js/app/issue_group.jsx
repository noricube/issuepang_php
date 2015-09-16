var IssueGroup = React.createClass({
    render: function() {
		var items = this.props.issues.map(function (issue) {
			return (
					<IssueRow key={issue.SN} issue={issue} />
				);
		});

        return (
				<table className="table table-striped table-bordered table-hover">
					<thead>
						<tr className="success">
							<th className="col-md-1">담당 / 이슈ID</th>
							<th className="col-md-1">관리정보</th>
							<th className="col-md-5">{this.props.key}</th>
							<th className="col-md-5">진행 상황</th>
						</tr>
					</thead>
					<tbody>
						{items}
					</tbody>
				</table>
            );
    }
});