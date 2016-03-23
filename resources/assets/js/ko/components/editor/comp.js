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
    viewModel: {
        createViewModel: function(params, componentInfo) {
            console.log(componentInfo.templateNodes);
            if(!params.contenido) {
                params.contenido = componentInfo.templateNodes[0];
            }
            return new ViewModel(params);
        }
    } ,
    template: template
};