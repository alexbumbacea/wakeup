Ext.define('wakeup.controller.Computer', {
    extend: 'Ext.app.Controller',
    views: ['Computers','computer.Edit', 'computer.Show'],
    models: ['Computer'],
    init:function(){
        this.control({
            'computerlist': {
                itemdblclick: this.showComputer
            }
        });
    },
    showComputer: function(grid, record) {

    }

    //the rest of the Controller here
});