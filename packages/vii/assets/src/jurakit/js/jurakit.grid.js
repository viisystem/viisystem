;
(function ($) {
    if (typeof window.jurakit === 'undefined') {
        window.jurakit = {};
    }

    jurakit.grid = {
        modalId: 'modalId',
        modalInstance: null,
        modalMessage: null,
        loader: '<div class="loader">Loading...</div>',

        getParams: function (obj) {
            title = (typeof obj.attr('data-title') === 'undefined')
                ? $.t('WARNING')
                : obj.attr('data-title');

            message = (typeof obj.attr('data-msg') === 'undefined')
                ? $.t('Are you sure you want to do this?')
                : obj.attr('data-msg');

            return {
                title: title,
                message: message
            };
        },
        setSelectedRows: function (obj) {
            if (obj.is(':checked')){
                obj.parents('.table').find('tbody tr').addClass('active');
            } else {
                obj.parents('.table').find('tbody tr').removeClass('active');
            }
        },
        setSelectedRow: function (obj) {
            if (obj.is(':checked')){
                obj.parent().parent().addClass('active');
            } else {
                obj.parent().parent().removeClass('active');
            }
        },
        bulkAjax: function(grid, url, keys) {
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {keys: keys},
                success: function (data) {
                    pjaxContainer = '#' + grid.replace('grid', 'pjax');
                    if (data.s === 1 && data.e > 0 && $(pjaxContainer).length > 0) {
                        // paramsPjax = {container: pjaxContainer, timeout: false};
                        //
                        // paramsData = $(pjaxContainer).data('pjax-params');
                        // if (typeof(paramsData) !== 'undefined') {
                        //     $.extend(paramsPjax, paramsData);
                        // }
                        //
                        // $.pjax.reload(paramsPjax);

                        jurakit.form.pjaxReload(pjaxContainer);
                        return false;
                    }

                    if (data.hasOwnProperty('m')) {
                        BootstrapDialog.show({
                            type: BootstrapDialog.TYPE_DEFAULT,
                            message: data.m,
                            buttons: [{
                                label: $.t('Close'),
                                action: function(dialogItself){
                                    dialogItself.close();
                                }
                            }]
                        });
                        return false;
                    }
                }
            });
        },
        bulkAction: function (grid, url, val) {
            var keys = $('#' + grid).yiiGridView('getSelectedRows');
            if (keys.length > 0) {
                BootstrapDialog.confirm({
                    title: $.t('WARNING'),
                    message: $.t('Are you sure you want to do this?'),
                    type: BootstrapDialog.TYPE_DEFAULT,
                    closable: true,
                    btnCancelLabel: $.t('Cancel'),
                    btnOKLabel: $.t('Ok'),
                    btnOKClass: 'btn-danger',
                    callback: function(result) {
                        if (result) {
                            jurakit.grid.bulkAjax(grid, url, keys);
                        }
                    }
                });
            }
        },
        bulkDelete: function (grid, url, val) {
            var keys = $('#' + grid).yiiGridView('getSelectedRows');
            if (keys.length > 0) {
                BootstrapDialog.confirm({
                    title: $.t('WARNING'),
                    message: $.t('Are you sure you want to delete?'),
                    type: BootstrapDialog.TYPE_DEFAULT,
                    closable: true,
                    btnCancelLabel: $.t('Cancel'),
                    btnOKLabel: $.t('Delete'),
                    btnOKClass: 'btn-danger',
                    callback: function (result) {
                        if (result) {
                            jurakit.grid.bulkAjax(grid, url, keys);
                        }
                    }
                });
            }
        },
        status: function (obj) {
            $.ajax({
                url: obj.attr('href'),
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    pjax = obj.data('pjax-container');
                    pjaxCallback = obj.data('pjax-callback');
                    if (data.s === 1 && typeof(pjax) !== 'undefined' && typeof(pjaxCallback) !== 'undefined') {
                        jurakit.form.pjaxReload('#' + pjax);
                        jurakit.form.pjaxReload('#' + pjaxCallback);
                    }

                    if (data.s === 1 && typeof(pjax) !== 'undefined') {
                        jurakit.form.pjaxReload('#' + pjax);
                        return true;
                    }

                    if (data.s === 1) {
                        jurakit.form.pjaxReload('#' + obj.parents('.grid-view').attr('id').replace('grid', 'pjax'));
                        return true;
                    }

                    if (data.s === 0 && data.hasOwnProperty('m')) {
                        BootstrapDialog.show({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: $.t('WARNING'),
                            message: data.m,
                            buttons: [{
                                label: $.t('Ok'),
                                action: function(dialogItself){
                                    dialogItself.close();
                                }
                            }]
                        });
                        return true;
                    }

                    return false;
                }
            });
        },
        delete: function (obj) {
            title = (typeof obj.attr('data-title') === 'undefined')
                ? $.t('WARNING')
                : obj.attr('data-title');

            message = (typeof obj.attr('data-msg') === 'undefined')
                ? $.t('Are you sure you want to do this?') //'common.Are you sure you want to delete?'
                : obj.attr('data-msg');

            BootstrapDialog.confirm({
                title: title,
                message: message,
                type: BootstrapDialog.TYPE_DEFAULT,
                closable: true,
                btnCancelLabel: $.t('Cancel'),
                btnOKLabel: $.t('Ok'),
                btnOKClass: 'btn-danger',
                callback: function(result) {
                    if (result) {
                        url = obj.attr('data-url');
                        if (typeof url === 'undefined') {
                            url = obj.attr('href');
                        }

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                if (data.hasOwnProperty('m')) {
                                    BootstrapDialog.show({
                                        type: (data.s === 0) ? BootstrapDialog.TYPE_DANGER : BootstrapDialog.TYPE_DEFAULT,
                                        title: $.t('INFO'),
                                        message: data.m,
                                        buttons: [{
                                            label: $.t('Close'),
                                            action: function(dialogItself){
                                                dialogItself.close();
                                            }
                                        }]
                                    });
                                    //return false;
                                }

                                //pjaxContainer = '#' + obj.parents('.pjax-container').attr('id');
                                pjaxContainer = '#' + (obj.is('[data-pjax-container]') ? obj.attr('data-pjax-container') : obj.parents('.pjax-container').attr('id'));
                                if (data.s === 1 && $(pjaxContainer).length > 0) {
                                    paramsPjax = {container: pjaxContainer, timeout: false};

                                    paramsData = $(pjaxContainer).data('pjax-params');
                                    if (typeof(paramsData) !== 'undefined') {
                                        $.extend(paramsPjax, paramsData);
                                    }

                                    $.pjax.reload(paramsPjax);
                                }

                                ajaxContainer = '#' + obj.attr('data-ajax-container');
                                if (data.s === 1 && $(ajaxContainer).length > 0 && data.hasOwnProperty('c')) {
                                    $(ajaxContainer).html(data.c);
                                }

                                callFunction = obj.attr('data-func-success');
                                if (data.s === 1 && callFunction != null) {
                                    if (callFunction.indexOf("(") >= 0) {
                                        eval(callFunction);
                                    } else {
                                        eval(callFunction + '(params, data)');
                                    }
                                }
                            }
                        });
                    }
                }
            });
        },
        confirm: function(obj) {
            jurakit.grid.delete(obj);
        },
        goLink: function (obj) {
            title = (typeof obj.attr('data-title') === 'undefined')
                ? $.t('WARNING')
                : obj.attr('data-title');

            message = (typeof obj.attr('data-msg') === 'undefined')
                ? $.t('Are you sure you want to do this?')
                : obj.attr('data-msg');

            BootstrapDialog.confirm({
                title: title,
                message: message,
                type: BootstrapDialog.TYPE_DEFAULT,
                closable: true,
                btnCancelLabel: $.t('Cancel'),
                btnOKLabel: $.t('Ok'),
                btnOKClass: 'btn-danger',
                callback: function(result) {
                    if (result) {
                        url = obj.attr('data-url');
                        if (typeof url === 'undefined') {
                            url = obj.attr('href');
                        }

                        window.location.href = url;
                    }
                }
            });
        },
        ordering: function (el, url) {
            var orderingBefore;
            var orderingAfter;
            var ordering = $(el).sortable({
                containerSelector: 'table',
                itemPath: '> tbody',
                itemSelector: 'tr',
                placeholder: '<tr class="sortable-placeholder"/>',
                nested: false,
                onDrag: function ($item, position, _super, event) {
                    $item.css(position);
                },
                onDragStart: function ($item, container, _super, event) {
                    $item.css({height: $item.outerHeight(), width: $item.outerWidth()});
                    $item.addClass(container.group.options.draggedClass);
                    $('body').addClass(container.group.options.bodyClass);

                    orderingBefore = JSON.stringify(ordering.sortable('serialize').get(), null, '');
                },
                onDrop: function ($item, container, _super, event) {
                    $item.removeClass(container.group.options.draggedClass).removeAttr('style');
                    $item.css({'background':'#ffffaa'}).delay(600).queue(function (next) {
                        $item.removeAttr('style');
                        next();
                    });
                    $('body').removeClass(container.group.options.bodyClass);

                    orderingAfter = JSON.stringify(ordering.sortable('serialize').get(), null, '');
                    if (orderingBefore !== orderingAfter) {
                        $.ajax({
                            url: url,
                            type: 'post',
                            dataType: 'json',
                            data: {params: ordering.sortable('serialize').get()[0]},
                            success: function(data) {
                                pjaxContainer = '#' + $(el).parents('.pjax-container').attr('id');
                                if (data.s === 1 && $(pjaxContainer).length > 0) {
                                    jurakit.form.pjaxReload(pjaxContainer);
                                    jurakit.grid.ordering(el, url);
                                }
                            }
                        });
                    }
                }
            });
        }
        //print: function (obj) {
        //    var pageTitle = 'Page Title',
        //        stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
        //        win = window.open('', 'Print', 'width=500,height=300');
        //    win.document.write('<html><head><title>' + pageTitle + '</title>' +
        //        '<link rel="stylesheet" href="' + stylesheet + '">' +
        //        '</head><body>' + $('.table')[0].outerHTML + '</body></html>');
        //    win.document.close();
        //    win.print();
        //    win.close();
        //    return false;
        //}
    }
})(jQuery);

//$(function(){
//    $("input[type='checkbox']").on('click', function(e){
//        if ($(this).is(':checked')){
//            $(this).parent().parent().addClass('active');
//        } else {
//            $(this).parent().parent().removeClass('active');
//        }
//    })
//});

//$(function () {
//    $('button[type="submit"]').click(function () {
//
//    });
//});
