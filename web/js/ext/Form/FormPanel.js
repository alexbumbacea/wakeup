Ext.define('wakeup.Form.FormPanel', {
    extend: 'Ext.form.FormPanel',
    csrfCheck: false,
    constructor: function (config) {
        if (config.csrfCheck) {
            config.items.push(
                Ext.create('Ext.form.field.Hidden', {
                    name: '_csrf_token'
                })
            );
            config.method = 'GET';
        }
        wakeup.Form.FormPanel.superclass.constructor.apply(this, arguments);
    },
    listeners: {

        afterRender: function (thisForm, options) {
            //adding handler for Enter key on forms
            this.keyNav = Ext.create('Ext.util.KeyNav', this.el, {
                enter: thisForm.submit,
                scope: thisForm
            });
            //adding CSRF check
            if (this.csrfCheck) {
                this.load();
            }

        }
    }
});