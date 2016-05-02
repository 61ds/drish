/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.autoParagraph = false;
    //config.enterMode = CKEDITOR.ENTER_BR;
    config.allowedContent = true;
    config.entities = false;
    CKEDITOR.filter.disabled = true;
    CKEDITOR.dataProcessor = null;    
    CKEDITOR.config.flashAddEmbedTag = false;
};
