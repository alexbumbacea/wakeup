Ext.define('wakeup.view.Viewport', {
    extend: 'Ext.Viewport',
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
            title: 'Computers'
        }, {
            title: 'Users'
        }]
    }]
    //the rest of the Controller here
});