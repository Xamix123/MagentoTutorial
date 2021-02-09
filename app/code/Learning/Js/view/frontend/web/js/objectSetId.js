define([
    'jquery',
    'functionSetId'
], function ($, functionSetId) {
    'use strict';

    return {
        objectSetId: function (config, element) {
            var divName = '#';

            var id = (element === undefined) || (element === false) ? config['id'] : element.id;

            divName += id;

            var div = $(divName);

            div.text(id)

            div.on('click', this.objectSetClick)

        },
        objectSetClick: function (event) {
            console.log('Type: Object. Element id: ' + event.toElement.id);
        }
    };

})
