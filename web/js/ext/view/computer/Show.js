Ext.define('wakeup.view.computer.Show', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.computershow',

    title: 'Computers',

    initComponent: function() {
        this.store = {
            fields: ['name', 'email'],
            data  : [
                {name: 'Ed',    email: 'ed@sencha.com'},
                {name: 'Tommy', email: 'tommy@sencha.com'}
            ]
        };

        this.columns = [
            {header: 'Name',  dataIndex: 'name',  flex: 1},
            {header: 'Type', dataIndex: 'type', flex: 1},
            {header: 'IP', dataIndex: 'ip', flex: 1},
            {header: 'MAC', dataIndex: 'mac', flex: 1},
        ];

        this.callParent(arguments);
    }
});