Ext.define('wakeup.Form.Login', {
    extend: 'Ext.window.Window',
    title: 'Login',
    height: 130,
    width: 400,
    layout: 'form',
    plain: true,
    modal: true,
    draggable: false,
    closable: false,
    resizable: false,
    items: [
        Ext.create('wakeup.Form.FormPanel', {
            border: false,
            layout: 'auto',
            url: baseUri + '/index/login',
            plain: true,
            modal: true,
            draggable: false,
            closable: false,
            resizable: false,
            bodyStyle: 'padding:5px;',
            buttonAlign: 'center',
            csrfCheck: true,
            submit: function (a) {
                Ext.apply(a, {
                    method: 'POST',
                    waitTitle: 'Loging in',
                    submitEmptyText: false,
                    waitMsg: 'Please wait...',
                    success: function (form, action) {
                        form.owner.ownerCt.onSuccess();
                    },
                    failure: function (form, action) {

                    }
                });
                this.form.submit(a);
            },
            items: [
                new Ext.form.field.Text({
                    fieldLabel: 'Username/Email',
                    allowBlank: false,
                    name: 'username'
                }),
                new Ext.form.field.Text({
                    fieldLabel: 'Password',
                    inputType: 'password',
                    allowBlank: false,
                    name: 'password'
                })
            ],
            buttons: [
                {
                    text: 'Login',
                    handler: function (b, e) {
                        this.up('form').submit({});
                    }
                },
                {
                    text: 'Reset',
                    handler: function (b, e) {
                        this.up('form').getForm().reset();
                    }
                }
            ]
        })],
    onSuccess: function () {
            console.log('on success called from wrong place');
    }
});