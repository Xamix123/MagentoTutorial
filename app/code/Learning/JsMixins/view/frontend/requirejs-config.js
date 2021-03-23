var config = {
    config: {
        mixins: {
            'Learning_Js/js/functionSetId': {
                'Learning_JsMixins/js/functionSetIdMixin': true,
                'Learning_JsMixins/js/functionSetIdAnotherMixin': true
            },
            'Learning_Js/js/objectSetId' : {
                'Learning_JsMixins/js/objectSetIdMixin': true
            }
        } // this is how js mixin is defined
    },
    map: {
        '*': {
            prototypeExample: 'Learning_JsMixins/js/prototypeExample',
            myMatchMedia: 'Learning_JsMixins/js/myMatchMedia'
        }
    }
};
