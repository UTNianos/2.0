/**
 * Created by javier on 14/03/16.
 * jshint:node
 */

'use strict';
module.exports = function(ko){
    ko.components.register('editor', require('./editor/comp.js'));
};