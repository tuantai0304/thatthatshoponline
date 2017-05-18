+function ($) { "use strict";

    var addCloneBtnToBlogPost = function () {
        var $btn = $( "<button/>", {
            "type": "button",
            "class": "btn btn-default duplicate oc-icon-files-o",
            click: function() {
                var url = window.location.href,
                    params = url.split('/'),
                    plugin = 'blog',
                    id = parseInt(params[params.length - 1]);
                if (Number.isInteger(id) && id > 0) {
                    window.location = '/backend/xeor/duplicate?plugin=rainlab.blog&id=' + id;
                }
                else {
                    alert("Error!");
                }
            }
        });
        $('#Form-field-Post-toolbar-group .oc-icon-trash-o').before($btn);
    };

    var addCloneBtnToCms = function () {
        var $formWidgetAlias = $('form input[name="formWidgetAlias"]');
        if ($formWidgetAlias.length) {
            $formWidgetAlias.each(function(index) {
                var $this = $(this),
                    $form = $this.parent(),
                    plugin = 'cms',
                    type = $form.find('input[name="templateType"]').val(),
                    availableTypes = ['page', 'partial', 'layout', 'content', 'asset'];
                if ($form.has('button.duplicate').length == 0 && availableTypes.indexOf(type) != -1) {
                    var fileName = $form.find('input[name="fileName"]').val(),
                        $btn = $( "<button/>", {
                            "type": "button",
                            "class": "btn btn-default duplicate oc-icon-files-o",
                            click: function() {
                                if (typeof fileName !== "undefined") {
                                    window.location = '/backend/xeor/duplicate?plugin=cms&type=' + type + '&file=' + fileName;
                                }
                                else {
                                    alert("Error!");
                                }
                            }
                        });
                    $form.find('.oc-icon-trash-o').not('.hide').before($btn);
                }
            });
        }
    };

    $(document).ready(function(){
        addCloneBtnToBlogPost();
    });

    $(document).ajaxComplete(function(){
        addCloneBtnToCms();
    });

}(window.jQuery);