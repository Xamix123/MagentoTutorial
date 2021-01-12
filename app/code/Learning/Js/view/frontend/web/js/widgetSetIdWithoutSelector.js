define([
    'jquery',
    'jquery/ui'
], function($) {
    'use strict';

    $.widget('learning.widgetSetId', {
        _create: function () {

            var div = $(this.options.name);
            var id = div.attr('id');

            div.text(id);
            div.click(function (){
                console.log('Type: Widget. Element id: ' + id);
            })
        }
    })

    return $.learning.widgetSetId;
})
