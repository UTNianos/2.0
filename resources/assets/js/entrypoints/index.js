(function () {
    'use strict';

    var $ = window.$ = window.jQuery = require('jquery');
    var bootstrap = require('bootstrap'),
        chosen = require('chosen');

    $(document).ready(function () {
        $('#carrera').chosen();
    });
}());