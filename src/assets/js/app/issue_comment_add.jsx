var IssueCommentAdd = React.createClass({
	
	getInitialState: function () {
		this.state = {editComment: this.props.comment, editing: false};
		return this.state;
	},
	
	handleEdit: function () {
		this.state.editComment = this.props.comment;
		this.state.editing = true;
		
		this.setState(this.state);
	},
	
	handleChange: function (ev) {
		this.state.editComment = ev.target.value;
		
		this.setState(this.state);
	},
	
	handleSave: function() {
		var comment = this.state.editComment;
		
		this.state.editing = false;
		this.state.editComment = '';

		this.setState(this.state);
		IssueActions.addComment(this.props.sn, comment);
	},
	
	handleCancel: function() {
		this.state.editing = false;
		
		this.setState(this.state);
	},
	
    render: function() {
        return (
				<div>
					<div className={React.addons.classSet({'show_comment_btn': !this.state.editing, 'hide_comment_btn': this.state.editing})}>
						<button onClick={this.handleEdit} className="btn btn-default btn-xs">댓글</button>
					</div>
					<div className={React.addons.classSet({'show_comment_add': this.state.editing, 'hide_comment_add': !this.state.editing})}>
						<p>
							<textarea onChange={this.handleChange} style={{width: '100%', minHeight: '2.5em'}} type="text" />
							<button onClick={this.handleSave} className="btn btn-success glyphicon glyphicon-ok" />&nbsp;
							<button onClick={this.handleCancel} className="btn btn-danger glyphicon glyphicon-remove" />
						</p>
					</div>
				</div>
            );
    }
});