define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        getThumbnail: function (row) {
            return row[this.index + '_src'];
        }
    });
});
