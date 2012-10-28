Ext.define('wakeup.model.User', {
    extend: 'Ext.data.Model',
    proxy: {
        type: 'rest',
        url: 'user'
    }
});