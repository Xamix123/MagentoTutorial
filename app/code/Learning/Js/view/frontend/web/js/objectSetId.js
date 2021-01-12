define([
    'jquery'
], function($) {
    'use strict';

    return {
        objectSetId : function(config, element)
        {
            element.innerText=element.id;
            element.addEventListener('click', function (){
                console.log('Type: Object. Element id: ' + element.id);
            })

        }
    };

})
