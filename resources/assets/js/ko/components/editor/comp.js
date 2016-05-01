import template from './template.html';

const ViewModel = function (data) {
    this.editando = false;
    this.contenido = '';
}

export var editor = {
    ViewModel,
    template
}