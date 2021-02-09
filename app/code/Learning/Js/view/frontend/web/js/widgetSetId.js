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

            div.on('click', this._click)

        },
        _click: function (event) {
            console.log('Type: Widget. Element id: ' + event.target.id);
        }
    })

    return $.learning.widgetSetId;
})
