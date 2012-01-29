/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.toolbar = 'MyToolbar';
 
	config.toolbar_MyToolbar =
	[
		{ name: 'document', items : [ 'Source','Templates' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','SelectAll','SpellChecker','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar', ]},
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','Subscript','Superscript','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','Outdent','Indent','Blockquote','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize','About' ] }
	];
	//config.extraPlugins = 'stylesheetparser';
	//config.contentsCss = '/ckeditor/boiler.css';
	//config.stylesSet = [];
};
