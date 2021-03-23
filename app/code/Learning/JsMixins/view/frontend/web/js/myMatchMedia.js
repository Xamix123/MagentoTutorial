define([
    'jquery',
    'matchMedia'
], function ($, moment) {
    'use strict';

    mediaCheck({
        media: '(max-width: 767px)',
        entry: function () {
            var td1 = $('#' + 'td1');
            var td2 = $('#' + 'td2');
            var td3 = $('#' + 'td3');

            td1.addClass('class1');
            td2.addClass('class1');
            td3.addClass('class1');
        },

        exit: function () {
            var td1 = $('#' + 'td1');
            var td2 = $('#' + 'td2');
            var td3 = $('#' + 'td3');

            td1.removeAttr('class');
            td2.removeAttr('class');
            td3.removeAttr('class');
        }
    });

});
