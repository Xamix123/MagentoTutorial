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

            td1.addClass('td1');
            td2.addClass('td2');
            td3.addClass('td3');
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
