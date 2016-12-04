(function() {
     tinymce.create('tinymce.plugins.PreCodeWrapper', {
          init : function(ed, url) {
               ed.addButton( 'button_pre_code_wrapper', {
                    title : ed.settings.pre_code_wrapper_menu_name,
                    image : url + '/images/icon.png',
                    onclick: function() {
                      ed.formatter.toggle('pre');
                      ed.formatter.toggle('code');
                  }
               }
             );
          }
     });
     tinymce.PluginManager.add( 'pre_code_wrapper_script', tinymce.plugins.PreCodeWrapper );
})();
