var IssueComment = React.createClass({
    render: function() {

		var time = new Date(this.props.time);
		var timeStr = (time.getMonth() + 1).toString() + '-' + (time.getDate()).toString() + ' ' + (time.getHours().toString()) + ':' + (time.getMinutes().toString());
		
        return (
				<p><span className="comment_name">{this.props.writer}</span> {this.props.comment} <span className="comment_date">{timeStr}</span></p>
            );
    }
});