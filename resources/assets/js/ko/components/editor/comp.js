/**
 * Created by javier on 14/03/16.
 */
'use strict';

var template = require('./template.html');
var ko = require('knockout');
function ViewModel(data) {
    this.editando = false;
    this.contenido = ko.observable(data.contenido);
}

module.exports = {
    viewModel:  ViewModel,
    template: template
};