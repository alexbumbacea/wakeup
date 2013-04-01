Ext.define('wakeup.form.FormPanel', {
    extend: 'Ext.form.FormPanel',
    csrfCheck: false,
    initComponent: function () {
        var me = this;
        if (me.csrfCheck) {
            me.items.push(
                Ext.create('Ext.form.field.Hidden', {
                    name: '_csrf_token'
                })
            );
            me.method = 'GET';
        }
        me.callParent(arguments);
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