var IssueComments = React.createClass({
    render: function() {
		var comments = this.props.comments.map(function (comment) {
			return (
					<IssueComment key={comment.SN_Cmt} writer={comment.Writer} comment={comment.Comment}/>
				);
		});

        return (
				<section className="comments">
					{comments}
				</section>
            );
    }
});