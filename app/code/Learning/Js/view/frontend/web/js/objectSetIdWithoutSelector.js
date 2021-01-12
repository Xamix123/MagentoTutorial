define([
    'jquery'
], function($) {
    'use strict';
    return {
        objectSetIdWithoutSelector: function(divName)
        {
            var div = $(divName['name']);

            div.text(div.attr('id'))
            div.click(function (){
                console.log('Type: Object. Element id: ' + div.attr('id'));
            })
        }
    };

})
