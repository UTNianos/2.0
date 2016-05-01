import bootstrap from 'bootstrap'
import ko from '../ko/ko'
import $ from 'jQuery'

(function () {
    'use strict';
    let viewModel = {};
    $.ready(function(){
        ko.applyBindings(viewModel);
        $('#planes').tab();
    });
}());