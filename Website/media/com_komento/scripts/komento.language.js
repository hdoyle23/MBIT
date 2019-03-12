Komento.module('komento.language', function($) {
	var module = this;

	Komento.require()
		.language(
			'COM_KOMENTO_ERROR',
			'COM_KOMENTO_LOADING',
			'COM_KOMENTO_UNPUBLISHED',
			'COM_KOMENTO_PUBLISHED',
			'COM_KOMENTO_NOFLAG',
			'COM_KOMENTO_SPAM',
			'COM_KOMENTO_OFFENSIVE',
			'COM_KOMENTO_OFFTOPIC',
			'COM_KOMENTO_COMMENTS_LOADING',
			'COM_KOMENTO_COMMENT_EDIT',
			'COM_KOMENTO_COMMENT_EDIT_CANCEL',
			'COM_KOMENTO_COMMENT_EDITTED_BY',
			'COM_KOMENTO_COMMENT_REPLY',
			'COM_KOMENTO_COMMENT_REPLY_CANCEL',
			'COM_KOMENTO_COMMENT_REPORT',
			'COM_KOMENTO_COMMENT_REPORTED',
			'COM_KOMENTO_COMMENT_SHARE',
			'COM_KOMENTO_COMMENT_SHARE_CANCEL',
			'COM_KOMENTO_COMMENT_LIKE',
			'COM_KOMENTO_COMMENT_UNLIKE',
			'COM_KOMENTO_COMMENT_STICK',
			'COM_KOMENTO_COMMENT_UNSTICK',
			'COM_KOMENTO_COMMENT_WHERE_ARE_YOU',
			'COM_KOMENTO_COMMENT_PEOPLE_WHO_LIKED_THIS',
			'COM_KOMENTO_FORM_LEAVE_YOUR_COMMENTS',
			'COM_KOMENTO_FORM_IN_REPLY_TO',
			'COM_KOMENTO_FORM_SUBMIT',
			'COM_KOMENTO_FORM_REPLY',
			'COM_KOMENTO_FORM_NOTIFICATION_SUBMITTED',
			'COM_KOMENTO_FORM_NOTIFICATION_PENDING',
			'COM_KOMENTO_FORM_NOTIFICATION_COMMENT_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_COMMENT_TOO_SHORT',
			'COM_KOMENTO_FORM_TNC',
			'COM_KOMENTO_FORM_AGREE_TNC',
			'COM_KOMENTO_FORM_OR_DROP_FILES_HERE',
			'COM_KOMENTO_FORM_NOTIFICATION_NOTIFICATION_USERNAME_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_NAME_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_EMAIL_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_EMAIL_INVALID',
			'COM_KOMENTO_FORM_NOTIFICATION_WEBSITE_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_WEBSITE_INVALID',
			'COM_KOMENTO_FORM_NOTIFICATION_TNC_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_CAPTCHA_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_SUBSCRIBED',
			'COM_KOMENTO_FORM_NOTIFICATION_SUBSCRIBE_CONFIRMATION_REQUIRED',
			'COM_KOMENTO_FORM_NOTIFICATION_SUBSCRIBE_ERROR',
			'COM_KOMENTO_FORM_NOTIFICATION_UNSUBSCRIBED',
			'COM_KOMENTO_FORM_NOTIFICATION_MAX_FILE_SIZE',
			'COM_KOMENTO_FORM_NOTIFICATION_MAX_FILE_ITEM',
			'COM_KOMENTO_FORM_NOTIFICATION_FILE_EXTENSION',
			'COM_KOMENTO_FORM_NOTIFICATION_UPLOAD_NOT_ALLOWED',
			'COM_KOMENTO_FORM_LOCATION_AUTODETECT',
			'COM_KOMENTO_FORM_LOCATION_DETECTING',
			'COM_KOMENTO_BBCODE_BOLD',
			'COM_KOMENTO_BBCODE_ITALIC',
			'COM_KOMENTO_BBCODE_UNDERLINE',
			'COM_KOMENTO_BBCODE_LINK',
			'COM_KOMENTO_BBCODE_LINK_TEXT',
			'COM_KOMENTO_BBCODE_PICTURE',
			'COM_KOMENTO_BBCODE_VIDEO',
			'COM_KOMENTO_BBCODE_BULLETLIST',
			'COM_KOMENTO_BBCODE_NUMERICLIST',
			'COM_KOMENTO_BBCODE_BULLET',
			'COM_KOMENTO_BBCODE_QUOTE',
			'COM_KOMENTO_BBCODE_CLEAN',
			'COM_KOMENTO_BBCODE_SMILE',
			'COM_KOMENTO_BBCODE_HAPPY',
			'COM_KOMENTO_BBCODE_SURPRISED',
			'COM_KOMENTO_BBCODE_TONGUE',
			'COM_KOMENTO_BBCODE_UNHAPPY',
			'COM_KOMENTO_BBCODE_WINK',
			'COM_KOMENTO_INSERT_VIDEO'
		)
		.done(function() {
			module.resolve();
		});
});