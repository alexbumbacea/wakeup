Ext.define('wakeup.view.Computers', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.computerlist',

    title: 'Computers',

    initComponent: function() {
        this.store = Ext.create('wakeup.store.Computer');

        this.columns = [
            {header: 'Name',  dataIndex: 'name',  flex: 1},
            {header: 'Type', dataIndex: 'type', flex: 1},
            {header: 'IP', dataIndex: 'ip', flex: 1},
            {header: 'MAC', dataIndex: 'mac', flex: 1},
        ];

        this.callParent(arguments);
    }
});