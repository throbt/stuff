$().ready(function() {
  

	// tinyMCE.init({
 //        mode 	: "textareas",
 //        plugins : "istuff",
 //        theme 	: "advanced",   //(n.b. no trailing comma, this will be critical as you experiment later)
 //        theme_advanced_buttons2 : "istuff",
 //        theme_simple_toolbar_location : "top",
 //        theme_simple_toolbar_align : "left",
 //        theme_simple_statusbar_location : "bottom",
 //        theme_simple_resizing : true
	// });


  tinyMCE.init({
    // General options
    // mode : "specific_textareas",
    // editor_selector : "body",

    mode : "textareas",

    /*setup : function(ed) {
      ed.onInit.add(function(ed) {
        //console.log('Editor is loaded: ' + ed.id);
        //modalWin.init();
      });
    },*/

    theme : "advanced",
    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,istuff", //imagemanager,filemanager

    // Theme options
    // theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    // theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    // theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "istuff",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    skin : "o2k7",
    skin_variant : "silver",

    // Example content CSS (should be your site CSS)
    content_css : "css/example.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "js/template_list.js",
    external_link_list_url : "js/link_list.js",
    external_image_list_url : "js/image_list.js",
    media_external_list_url : "js/media_list.js",

    // Replace values for the template plugin
    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    },

    autosave_ask_before_unload : false // Disable for example purposes
  });
});






