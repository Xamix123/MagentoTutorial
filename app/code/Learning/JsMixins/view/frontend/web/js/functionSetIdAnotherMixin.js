define([
    'mage/utils/wrapper'
], function (wrapper) {
    'use strict';

    return function (functionSetId) {
        return wrapper.wrap(functionSetId, function (originalFunctionSetIdFunction, config, element) {
            originalFunctionSetIdFunction(config, element);

            console.log('I am another test mixin for check how work couples mixins on one function');
        });
    };
});
