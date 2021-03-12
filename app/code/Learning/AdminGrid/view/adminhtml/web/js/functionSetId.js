define([
    'jquery',
], function ($) {
    'use strict';
    return function (config, element) {


        $('#testButton').click(function () {

        })

        var data = {
            'form_key': window.FORM_KEY,
            'data': $('#email').attr('value')
        }

       $.ajax(
           {
               type: 'POST',
               url: 'admingrid/grid/send',
               data: data,
               showLoader: true
           }).done(function (xhr){
               if(xhr.error)
               {
                   self.onError(xhr);
               }
           }).fail(this.onError);
    }
})
