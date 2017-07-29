(function() {
     tinymce.create('tinymce.plugins.PreCodeWrapper', {
          init : function(ed, url) {
               ed.addButton( 'button_pre_code_wrapper', {
                    title : ed.settings.pre_code_wrapper_menu_name,
                    image : url + '/images/icon.png',
                    onclick: function() {
                      ed.plugins.pre_code_wrapper_script.handlePluginOnClick(ed);
                  }
               }
             );
          },

          handlePluginOnClick: function(ed) {
            var startWrapper = '<pre><code>';
            var endWrapper = '</code></pre>';
            var selection = ed.selection.getSel();
            ed.focus();
            if(selection.anchorNode.parentNode.localName === 'code') {
              ed.plugins.pre_code_wrapper_script.stripSelectionFromPreCodeWrapping(ed, startWrapper, endWrapper);
            }
            else {
              ed.selection.setContent(startWrapper + selection + endWrapper);
            }
          },

          stripSelectionFromPreCodeWrapping: function(ed, startWrapper, endWrapper) {
            var parentNode = ed.selection.getNode().parentElement;
            ed.selection.select(parentNode);
            var selectedContent = ed.selection.getContent();
            var strippedContent = selectedContent.substring(selectedContent.indexOf(startWrapper) + startWrapper.length, selectedContent.length);
            strippedContent = strippedContent.substring(0, strippedContent.indexOf(endWrapper));
            ed.selection.setContent(strippedContent);
          }
     });
     tinymce.PluginManager.add( 'pre_code_wrapper_script', tinymce.plugins.PreCodeWrapper );
})();
