/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.toolbar = 'Basic';
	//config.filebrowserImageUploadUrl = '/upload';
	// config.extraPlugins = 'stylesheetparser';
	// config.extraPlugins = 'mediaembed';
	// config.contentsCss = 'test.css';
	// config.stylesSet = [];
	// config.toolbar_Basic = [
	// ['Source'],
	// ['Bold', 'Italic','Underline'],
	// ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	// ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	// ['Link', 'Unlink'],
	// ['FontSize'],
	// ['TextColor','BGColor'],
	// ['Link','Unlink','Anchor'],
	// ['Image','MediaEmbed','Table','HorizontalRule','SpecialChar']
	// ];
	// config.width = '100%';
	config.allowedContent = true;
	config.extraPlugins = 'tableresize';
};
