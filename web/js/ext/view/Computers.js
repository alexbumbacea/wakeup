Ext.define('wakeup.view.Computers', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.computerlist',

    title: 'Computers',

    initComponent: function () {
        this.store = Ext.create('wakeup.store.Computer');

        this.columns = [
            {header: 'Name', dataIndex: 'name', flex: 1},
            {header: 'Type', dataIndex: 'type', flex: 1},
            {header: 'IP', dataIndex: 'ip', flex: 1},
            {header: 'MAC', dataIndex: 'mac', flex: 1},
        ];

        this.tbar = Ext.create('Ext.Toolbar', {
            items: [
                {
                    xtype: 'form',
                    layout: 'hbox',
                    items: [
                        {
                            xtype: 'textfield',
                            fieldLabel: 'Computer name',
                            name: 'name'
                        },
                        {
                            xtype: 'textfield',
                            fieldLabel: 'IP Address',
                            name: 'ip'
                        },
                        {
                            xtype: 'button',
                            text: 'Submit',
                            handler: function (b, e) {
                                b.up('grid').getStore().filter(b.up('form').getValues());
                                //b.up('grid').store.load();
                            }
                        }
                    ]
                }
            ]
        });

        this.callParent(arguments);
    }
});