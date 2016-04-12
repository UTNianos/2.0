(function () {
    'use strict';
    var $ = window.$ = window.jQuery = require('jquery');
    var bootstrap = require('bootstrap'),
        ko = require('../ko/ko.js'),
        viewModel = {};
    $.ready(function(){
        ko.applyBindings(viewModel);
        $('#planes').tab();
    });
}());