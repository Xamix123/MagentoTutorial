define([
    'jquery',
    'jquery/ui'
], function($) {
    'use strict';

    $.widget('learning.widgetSetId', {
        _create: function () {
           var divName = '#';
           var id = (this.element.attr('id') === undefined)
               ? this.options.id
               : this.element.attr('id')

           divName += id;
           var div = $(divName);

           div.text(id);
           div.click(function (){
               console.log('Type: Widget. Element id: ' + id);
           })
        }
    })

    return $.learning.widgetSetId;
})
