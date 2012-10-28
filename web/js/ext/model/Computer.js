Ext.define('wakeup.model.Computer', {
    extend: 'Ext.data.Model',
    proxy: {
        type: 'rest',
        url: 'computer'
    }
});