var IssueComment = React.createClass({
    render: function() {

        return (
				<p>{this.props.writer} {this.props.comment}</p>
            );
    }
});