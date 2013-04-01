Ext.application({
    name: 'wakeup',
    models: ['Computer', 'User'],
    controllers: ['Computer', 'User'],
    appFolder: 'js/ext',
    //autoCreateViewport: true,
    launch: function() {
        Ext.Loader.setPath({
            'Ext.ux.desktop': 'http://cdn.sencha.com/ext/beta/4.2.0.265/examples/desktop/js',
            'Ext': 'http://cdn.sencha.com/ext/beta/4.2.0.265/src',
            'MyDesktop': 'http://cdn.sencha.com/ext/beta/4.2.0.265/examples/desktop',
            'wakeup': 'js/ext'
        });
        Ext.QuickTips.init();
        Ext.Ajax.request({
            url: baseUri + '/index/isloggedin',
            success: function(response, opts) {
                var obj = Ext.decode(response.responseText);
                var loginForm = Ext.create('wakeup.form.Login',{
                    onSuccess: function(){
                        Ext.create('wakeup.view.Viewport').show();
                        this.close();
                    }
                });
                if (obj.data == true) {
                    loginForm.onSuccess();
                } else {
                    loginForm.show();
                }
            },
            failure: function(response, opts) {
                Ext.MessageBox.show({
                    title: 'Error',
                    msg: 'There was an error while trying to check if you are logged in. Please refresh the page!',
                    width:300,
                    buttons: Ext.MessageBox.OK,
                });
            }
        });
    },
    signout: function() {
        Ext.Ajax.request({
            url: baseUri + '/index/signout',
            success: function(response, opts) {
                window.location.reload();
            },
            failure: function(response, opts) {
                Ext.MessageBox.show({
                    title: 'Error',
                    msg: 'There was an error while trying to logout. Please refresh the page!',
                    width:300,
                    buttons: Ext.MessageBox.OK,
                });
            }
        });
    }


});