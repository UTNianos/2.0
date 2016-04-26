import {editor} from './editor/comp'
export const components = function(ko){
    ko.components.register('editor', editor);
};