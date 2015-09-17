var IssueComments = React.createClass({
    render: function() {
		var comments = this.props.comments.map(function (comment) {
			return (
					<IssueComment key={comment.SN_Cmt} sn_cmt={comment.SN_Cmt} writer={comment.Writer} comment={comment.Comment} time={comment.WrittenTime}/>
				);
		});

        return (
				<section className="comments">
					{comments}
				</section>
            );
    }
});