Ext.define('wakeup.model.Computer', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'name', type: 'string'},
        { name: 'ip', type: 'string'},
        { name: 'mac', type: 'string'},
        { name: 'type', type: 'string'},
    ]
});