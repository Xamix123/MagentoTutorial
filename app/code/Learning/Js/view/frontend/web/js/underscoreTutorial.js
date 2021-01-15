define([
    'jquery',
    'underscore'
], function($, underscore) {
    'use strict';
    return function(config, element) {
        var arr1 = [1, 2, 3 ];
        var result;

     // UNDERSCORE  each
     //_________________________________________________________________________________________________________________

        // underscore.each(arr1, alert); //use alert to each elem in arr1

        // underscore.each({one: 1, two: 2, three: 3}, alert) // work with object

        // underscore.each(arr1, function(val) { alert(val*2); }) // use each with custom function

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  map
     //_________________________________________________________________________________________________________________

        /* apply function for each element in current array and create
        result array with return value of anon function result = [3, 6, 9] */
        result = underscore.map(arr1, function (num){ return num * 3});

        //the same thing only with the object
        result = underscore.map({one: 1, two: 2, three: 3}, function (num){ return num * 3});

        //return first elem from array
        result = underscore.map([[3,1], [12,4]], underscore.first);

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  find
     //_________________________________________________________________________________________________________________

        /* return first elem with satisfies the condition */
        result = underscore.find([1, 2, 3, 4, 5, 6], function (num){ return num % 2 === 0})

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  every
     //_________________________________________________________________________________________________________________

        /* func check every element satisfies the condition */
        result = underscore.every([1, 2, 3, 4, 5, 6], function (num){ return num % 2 === 0})

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  some
     //_________________________________________________________________________________________________________________

        /* func check if any of the values satisfies the condition */
        result = underscore.some([1, 113, 3, 5], function (num){ return num % 2 === 0})

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  invoke
     //_________________________________________________________________________________________________________________

        /* call method method name for list elements */
        result = underscore.invoke([[5, 1, 7], [3, 2, 1]], 'sort');

     //_________________________________________________________________________________________________________________

     // UNDERSCORE  pluck
     //_________________________________________________________________________________________________________________
        var stooges = [{name: 'moe', age: 40}, {name: 'larry', age: 50}, { age: 60}];

        /* alias for most popular use map func get all values by key from list */
       result = underscore.pluck(stooges, 'name');

     //_________________________________________________________________________________________________________________


     // UNDERSCORE  groupBy
     //_________________________________________________________________________________________________________________


        //group elem by func result
        result = underscore.groupBy(['one', 'two', 'three'], 'length');


     //_________________________________________________________________________________________________________________

    // UNDERSCORE  indexBy
    //_________________________________________________________________________________________________________________

        //group elem by unile func result
        result = underscore.indexBy(stooges, 'age');
    //_________________________________________________________________________________________________________________



     // UNDERSCORE  some
     //_________________________________________________________________________________________________________________
     //_________________________________________________________________________________________________________________


}
})
