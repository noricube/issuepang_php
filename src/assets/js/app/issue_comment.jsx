var IssueComment = React.createClass({
	
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
		this.state.editComment = this.props.comment;

		this.setState(this.state);
		IssueActions.editComment(this.props.sn_cmt, comment);
	},
	
	handleCancel: function() {
		this.state.editing = false;
		
		this.setState(this.state);
	},
	
    render: function() {

		var time = new Date(this.props.time);
		var timeStr = (time.getMonth() + 1).toString() + '-' + (time.getDate()).toString() + ' ' + (time.getHours().toString()) + ':' + (time.getMinutes().toString());
		
		var editorStyle = {display: 'none'};
		
		if ( this.state.editing )
		{
			editorStyle.display = 'inline';
		}
		
        return (
				<p>
					<span className="comment_name">{this.props.writer}</span>&nbsp;
					<span onDoubleClick={this.handleEdit} className="comment">{this.props.comment}</span>&nbsp;
					<span className="comment_date">{timeStr}</span>
					<p style={editorStyle}>
						<textarea onChange={this.handleChange} style={{width: '100%', minHeight: '2.5em'}} type="text" defaultValue={this.props.comment} />
						<button onClick={this.handleSave} className="btn btn-success glyphicon glyphicon-ok" />&nbsp;
						<button onClick={this.handleCancel} className="btn btn-danger glyphicon glyphicon-remove" />
					</p>
				</p>
            );
    }
});