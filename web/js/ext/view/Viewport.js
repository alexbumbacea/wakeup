Ext.define('wakeup.view.Viewport', {
    extend: 'Ext.Viewport',
    rederTo: Ext.getBody(),
    items: [{
        xtype: 'panel',
        region: 'north',
        items: [{
            xtype: 'button',
            align: 'right',
            text: 'Sign out',
            handler: function(){
                wakeup.getApplication().signout();
            }
        }]
    },{
        xtype: 'tabpanel',
        region: 'center',
        items: [{
            xtype: 'computerlist'
        }, {
            title: 'Users'
        }]
    }]
    //the rest of the Controller here
});