define([
    "jquery"
], function($) {
    "use strict";
    return function(config, element) {
        element.innerText = element.id;
        element.onclick = function (){
            console.log("Type: Function. Element id: " + element.id);
        }
    }
})
