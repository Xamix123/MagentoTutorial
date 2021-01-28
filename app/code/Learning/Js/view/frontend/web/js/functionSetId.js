define([
    'jquery',
], function ($) {
    'use strict';
    return function (config, element) {
        var divName = '#';

        var id = (element === undefined) || (element === false) ? config['id'] : element.id;

        divName += id;

        var div = $(divName);

        div.text(id)
        div.click(function () {
            console.log('Type: Function. Element id: ' + id);
        })

    }
})
