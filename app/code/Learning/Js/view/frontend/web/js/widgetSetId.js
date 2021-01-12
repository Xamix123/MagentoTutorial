define([
    'jquery',
    'jquery/ui'
], function($) {
    'use strict';

    $.widget('learning.widgetSetId', {
        _create: function () {
           var id = this.element.attr('id');

           this.element.text(id);
           this.element.click(function (){
               console.log('Type: Widget. Element id: ' + id);
           })
        }
    })

    return $.learning.widgetSetId;
})
