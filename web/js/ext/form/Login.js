Ext.define('wakeup.form.Login', {
    extend: 'wakeup.form.FormPanel',
    //border: false,
    height: 130,
    width: 400,
    layout: 'form',
    title: 'Login',
    url: baseUri + '/index/login',
    //plain: true,
    modal: true,
    draggable: false,
    //closable: false,
    resizable: false,
    bodyStyle: 'padding:5px;',
    buttonAlign: 'center',
    floating: true,
    csrfCheck: true,
    submit: function (a) {
        Ext.apply(a, {
            method: 'POST',
            waitTitle: 'Loging in',
            submitEmptyText: false,
            waitMsg: 'Please wait...',
            success: function (form, action) {
                form.owner.onSuccess();
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
    ],
    onSuccess: function () {
        console.log('on success called from wrong place');
    }
});