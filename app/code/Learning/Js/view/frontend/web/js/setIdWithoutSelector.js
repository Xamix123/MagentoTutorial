define([
    "jquery"
], function($) {
    "use strict";
    return function() {
        var div = $('#div6');

        div.text(div.attr('id'))
        div.click(function (){
            console.log("Type: Function. Element id: " + div.attr('id'));
        })
    }
})
