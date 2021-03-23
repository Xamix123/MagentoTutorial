define([
    'prototype',
    'myMatchMedia',
], function () {
    'use strict';
    return function (config, element) {

        var ExampleClass = Class.create();

        ExampleClass.prototype ={
            initialize: function(name) {
                this.name = name;
            },
            sayHello: function(message) {
                return this.name + ': ' + message;
            }
        }

        var example = new ExampleClass('Adam');

        console.log(example.sayHello('Hi!'));

        var SecondClass = Object.extend(new ExampleClass(),
            {
                sayHello: function (message) {
                    return this.name + ': ' + message + 'i was override';
                }
            }
        )

        console.log(SecondClass.sayHello('i am here +++++'));


       var ExampleClass2 = Class.create(ExampleClass, {

           test: function() {
               return "i am in text function now";
           }
       })

        var example1 = new ExampleClass2();


        console.log(example1.test('new message test!'));
        console.log(example1)
    }




});
