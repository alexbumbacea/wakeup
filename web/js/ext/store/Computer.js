Ext.define('wakeup.store.Computer', {
    extend: 'Ext.data.Store',
    model: 'wakeup.model.Computer',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: baseUri + 'computer',
        reader: {
            root: 'data',
            type: 'json'
        }
    }
});