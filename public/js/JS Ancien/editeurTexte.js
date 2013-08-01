bkLib.onDomLoaded(function() {
    $("[data-textarea=activer]").each(function(){
        new nicEditor({
		iconsPath: "/pluggin/editeurTexte/nicEditorIcons.gif",
		buttonList:['bold','italic','underline','ol','ul','indent','outdent','link','unlink','image','forecolor']
	}).panelInstance($(this).attr('id'));
    })
	
});