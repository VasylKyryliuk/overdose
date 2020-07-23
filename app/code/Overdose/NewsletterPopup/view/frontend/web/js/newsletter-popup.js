define([
    'jquery',
    'jquery/ui',
    'Magento_Ui/js/modal/modal'
], function ($) {

    $.widget('newsletter.popup', $.mage.modal, {
        options: {
            timeout: 1000
        },

        _create: function () {
            this._super();
            setTimeout(function () {
                this.openModal();
            }.bind(this), this.options.timeout);
        }
    });

    return $.newsletter.popup;
});
