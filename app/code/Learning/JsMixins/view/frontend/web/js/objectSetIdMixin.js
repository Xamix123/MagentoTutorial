define([
    'jquery'
], function ($) {
   'use strict';
    console.log(" i am before objectSetId");
   return function (objectSetId) {
       objectSetId.objectSetClick = function() {
           console.log("wooupous");
       }
       objectSetId.testData.test1 = "alpha1";

       objectSetId.showMyVar = function(){
           console.log(objectSetId.testData)
       }

       objectSetId.showMyVar();

       return objectSetId;
   };

});
