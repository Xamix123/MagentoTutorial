define([
    'jquery'
], function($) {
    'use strict';
    return function(divName) {
        var div = $(divName['name']);

        div.text(div.attr('id'))
        div.click(function (){
            console.log("Type: Function. Element id: " + div.attr('id'));
        })
    }
})
