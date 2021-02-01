define([
    'jquery',
    'functionSetId'
], function($, functionSetId) {
    'use strict';

    return {
        objectSetId : function(config, element)
        {
            var divName = '#';

            var id = (element === undefined) || (element === false) ? config['id'] : element.id;

            divName += id;

            var div = $(divName);

            div.text(id)

            this.objectSetClick(div, id)

        },
        objectSetClick : function(div, id)
        {
            div.click(function (){
                console.log("Type: Object. Element id: " + id);
            })
        }
    };

})
