define([
    'jquery',
    'mage/utils/wrapper'
], function ($,wrapper) {
    'use strict';

    return function (functionSetId) {
        return wrapper.wrap(functionSetId, function (originalFunctionSetIdFunction, config, element) {
            originalFunctionSetIdFunction(config, element);

            console.log(element);

            var div = $('#' + element.id)
            div.addClass('class1')
        });
    };
});
