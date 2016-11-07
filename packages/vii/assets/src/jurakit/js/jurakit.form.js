;
(function ($) {
    $.fn.focusEnd = function() {
        if (!$('body').hasClass('is-desktop')) {
            return;
        }

        this.focus();
        var $thisVal = this.val();
        this.val('').val($thisVal);
        return this;
    };

    if (typeof window.jurakit === 'undefined') {
        window.jurakit = {};
    }

    jurakit.form = {
        modalId: 'modalId',
        modalInstance: null,
        modalMessage: null,
        loader: '<div class="loader">Loading...</div>',

        reset: function (formId) {
            if (formId.indexOf('#') !== 0) {
                formId = '#' + formId;
            }

            $(formId).find(':input').each(function () {
                switch (this.type) {
                    case 'password':
                    case 'select-multiple':
                    case 'select-one':
                    case 'text':
                    case 'textarea':
                        $(this).val(null);
                        break;
                    case 'checkbox':
                    case 'radio':
                        this.checked = false;
                }
            });

            $(formId).find('select').each(function () {
                $(this).val(null).trigger("change");
            });

            if (typeof(tinyMCE) !== 'undefined' && tinyMCE.activeEditor !== null) {
                try {
                    tinyMCE.activeEditor.setContent('');
                } catch(e) {}
            }
        },

        ajax: function () {
            // Preventing duplicate handlers
            $('.form-ajax').off('beforeSubmit').on('beforeSubmit', function (e) {
                obj = $(this);
                if (obj.find('.has-error').length) {
                    return false;
                }

                params = {
                    'eidTarget': '#' + obj.data('form-target'),
                    'eidPjaxContainer': '#' + obj.data('pjax-container'),
                    'eidAjaxContainer': '#' + obj.data('ajax-container'),
                    'funInitial': obj.data('func-initial'),
                    'funSuccess': obj.data('func-success')
                };

                jurakit.form.panelSubmit(obj, params);
            }).on('submit', function (e) {
                e.preventDefault();
            });
        },

        iframe: function (obj) {
            //params = {
            //    'eidPjaxContainer': '#' + obj.data('pjax-container'),
            //    'eidAjaxContainer': '#' + obj.data('ajax-container'),
            //    'funSuccess': obj.data('func-success')
            //};

            paramClass = 'modal-dialog-md';
            paramWidth = obj.attr('data-modal-width');
            if (typeof paramWidth !== 'undefined') {
                if ($(window).width() < 1100){
                    paramClass = 'modal-dialog-sm';
                    paramWidth = 'auto';
                }
            }

            paramHeight = obj.attr('data-modal-height');
            if (typeof paramHeight === 'undefined') {
                paramHeight = ($(window).height() - 185);
            }


            paramUrl = obj.attr('data-url');
            if (typeof paramUrl === 'undefined') {
                paramUrl = obj.attr('href');
            }

            paramPjax = obj.data('pjax-container');
            if (typeof paramPjax !== 'undefined') {
                paramPjax = '_pjax=' + encodeURIComponent('#' + paramPjax);
            }

            var modalButtons = [];
            var paramButton = obj.attr('data-modal-button');
            if (typeof paramButton === 'undefined' && paramButton !== false) {
                modalButtons = [{
                    label: $.t('Cancel'),
                    cssClass: 'btn btn-default',
                    action: function($dialog) {
                        $dialog.close();
                    }
                },{
                    label: $.t('Save'),
                    cssClass: 'btn btn-primary',
                    //autospin: true,
                    action: function($dialog) {
                        //jurakit.form.modalInstance.enableButtons(false);
                        //jurakit.form.modalInstance.setClosable(false);
                        $('.modal-iframe-body').contents().find('.notice-ajax-form-submit').show();
                        $('.modal-iframe-body').contents().find('form').submit();
                    }
                }];
            } else {
                paramHeight = paramHeight + 60;
            }

            paramSep = (paramUrl.indexOf('?') === -1) ? '?' : '&';

            jurakit.form.modalInstance = new BootstrapDialog({
                type: BootstrapDialog.TYPE_DEFAULT,
                id: obj.data('source') + 'Modal', // jurakit.form.modalId
                title: (typeof(obj.data('title')) !== 'undefined') ? obj.data('title') : ' ',
                size: (obj.data('size')) ? obj.data('size') : 'size-wide', // size-normal | size-lager | size-small | size-full
                message: '<iframe class="modal-iframe-body" style="width:100%; height:'+paramHeight+'px" src="'+paramUrl+paramSep+paramPjax+'" frameborder="0"></iframe>',
                cssClass: 'modal-iframe ' + obj.data('class'),
                buttons: modalButtons,
                tabindex: null,
                closeByBackdrop: false,
                closeByKeyboard: false,
                onshown: function(dialog) {
                    if (paramWidth != 'auto') {
                        $('.modal-dialog').css({'width':paramWidth})
                    }

                    //$('.modal-dialog-form').css({width: $width})
                    //dialog.getButton('button-c').disable();
                }
            }).open();
        },
        iframeSuccess: function (eidPjaxContainer) {
            if ($(eidPjaxContainer).length !== 0) {
                //$.pjax.reload({container: eidPjaxContainer, timeout: false});
                jurakit.form.pjaxReload(eidPjaxContainer);
            }

            jurakit.form.modalInstance.close();
        },

        event: function () {
            $('button[type="reset"]').on('click', function(e) {
                e.preventDefault();
                var formId = $(this).parents('form').attr('id');

                jurakit.form.reset(formId);
                $('#' + formId).find('.form-reset').val(1);
                //$('#' + formId).submit();
            });
        },
        filter: function () {
            // Preventing duplicate handlers
            $('.form-filter').off('beforeSubmit').on('beforeSubmit', function (e) {
                obj = $(this);
                if (obj.find('.has-error').length) {
                    return false;
                }

                params = {
                    'eidTarget': '#' + obj.data('form-target'),
                    'eidPjaxContainer': '#' + obj.data('pjax-container'),
                    'eidAjaxContainer': '#' + obj.data('ajax-container'),
                    'funInitial': obj.data('func-initial'),
                    'funSuccess': obj.data('func-success')
                };

                jurakit.form.filterSubmit(obj, params);
            }).on('submit', function (e) {
                e.preventDefault();
            });

            $('.form-filter').on('reset', function(e) {
                e.preventDefault();
                var formId = $(this).attr('id');

                jurakit.form.reset(formId);
                $('#' + formId).find('.form-reset').val(1);
                $('#' + formId).submit();
            });
        },
        filterSubmit: function (obj, params) {
            if (obj.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: obj.attr('action'),
                type: 'post',
                data: obj.serialize(),
                success: function (data) {
                    jurakit.form.pjaxReload(params.eidPjaxContainer);
                }
            });
        },

        modal: function (obj) {
            params = {
                'eidPjaxContainer': '#' + obj.data('pjax-container'),
                'eidAjaxContainer': '#' + obj.data('ajax-container'),
                'liveSource': obj.data('live-source'),
                'funSuccess': obj.data('func-success')
            };

            jurakit.form.modalMessage = $('<div><\/div>');
            jurakit.form.modalInstance = new BootstrapDialog({
                type: BootstrapDialog.TYPE_DEFAULT,
                id: obj.data('source') + 'Modal', // jurakit.form.modalId
                title: (typeof(obj.data('title')) !== 'undefined') ? obj.data('title') : ' ',
                size: (obj.data('size')) ? obj.data('size') : 'size-wide', // size-wide | size-normal | size-lager | size-small
                cssClass: obj.data('class'),
                message: jurakit.form.loader,
                tabindex: null,
                closeByBackdrop: false,
                closeByKeyboard: false,
                onhidden: function (dialogRef) {
                    jurakit.form.modalResetForm();
                }
            }).open();

            url = obj.attr('data-url');
            if (typeof url === 'undefined') {
                url = obj.attr('href');
            }

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    jurakit.form.modalResetForm();
                },
                success: function (data) {
                    if (data.s === 1 && data.hasOwnProperty('f')) {
                        jurakit.form.modalMsg(data.f);
                        jurakit.form.modalEvent(params);
                    } else if (data.s === 0 && data.hasOwnProperty('m')) {
                        jurakit.form.modalInstance.setType(BootstrapDialog.TYPE_DANGER);
                        jurakit.form.modalInstance.setSize(BootstrapDialog.SIZE_NORMAL);
                        jurakit.form.modalInstance.setTitle($.t('WARNING'));
                        jurakit.form.modalInstance.getModal().removeClass('modal-full');
                        jurakit.form.modalInstance.getModal().removeClass('modal-auto');
                        jurakit.form.modalMsg(data.m);
                    } else {
                        jurakit.form.modalInstance.close();
                    }
                },
                error: function (data) {
                    jurakit.form.modalInstance.close();
                }
            });
        },
        modalMsg: function (msg) {
            jurakit.form.modalInstance.setMessage(jurakit.form.modalMessage.empty().append(msg));
        },
        modalEvent: function (params) {
            var focus = $('#' + jurakit.form.modalInstance.getId() + ' form .focus');
            if (focus.length > 0) {
                focus.first().focusEnd();
            } else {
                $('#' + jurakit.form.modalInstance.getId() + ' form input:text').first().focusEnd(); // not support textarea
            }

            $('#' + jurakit.form.modalInstance.getId() + ' form').on('beforeSubmit', function (e) {
                jurakit.form.modalSubmit($(this), params);
            }).on('submit', function (e) {
                e.preventDefault();
            });
        },
        modalSubmit: function (form, params) {
            if (form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                dataType: 'json',
                success: function (data) {
                    jurakit.form.submitSuccess('modalSubmit', data, params);
                },
                error: function (data) {
                    //$(params.modalWrap).modal('hide');
                    jurakit.form.modalInstance.close();
                }
            });
        },
        modalResetForm: function () {
            eidTinymce = $('#' + jurakit.form.modalInstance.getId() + ' .form-tinymce');
            if (eidTinymce.length > 0) {
                eidTinymce.each(function (k, v) {
                    try {
                        tinyMCE.remove('#' + $(this).attr('id'));
                    } catch(e) {}
                });
            }
        },
        modalOrder: function (obj) {
            var level = 0;
            $('.modal.in').each(function(index) {
                var $modal = $(this);
                level++;
                $modal.addClass('modal-level-' + level);
                $modal.prev('.modal-backdrop.in').addClass('modal-backdrop-level-'+level);
            });
            $('body').attr('data-modal-level', level);
        },

        panel: function (obj) {
            params = {
                'eidTarget': '#' + obj.data('form-target'),
                'eidPjaxContainer': '#' + obj.data('pjax-container'),
                'eidAjaxContainer': '#' + obj.data('ajax-container'),
                'funInitial': obj.data('func-initial'),
                'funSuccess': obj.data('func-success')
            };

            if (obj.attr('aria-expanded') === 'true') {
                return false;
            }

            $.ajax({
                url: obj.attr('data-url'),
                type: 'post',
                data: obj.serialize(),
                dataType: 'json',
                cache: false,
                beforeSend: function () {
                    jurakit.form.panelResetForm(params);

                    if (params.funInitial != null) {
                        eval(params.funInitial + '(params)');
                    }

                    $(params.eidTarget).empty().html(jurakit.form.loader);
                },
                success: function (data) {
                    if (data.s === 1 && data.hasOwnProperty('f')) {
                        $(params.eidTarget).html(data.f);
                        jurakit.form.panelEvent(params);
                    }

                    if (params.eidAjaxContainer != null && $(params.eidAjaxContainer).length > 0 && data.hasOwnProperty('c')) {
                        $(params.eidAjaxContainer).html(data.c);
                    }

                    if ((params.eidTarget).length > 0 && jurakit.form.modalInstance == null) {
                        $('html, body').animate({
                            scrollTop: $(params.eidTarget).offset().top - 55
                        }, 1000);
                    }
                }
            });
        },
        panelEvent: function (params) {
            if ($(params.eidTarget + ' form .focus').length > 0) {
                $(params.eidTarget + ' form .focus').first().focusEnd();
            } else {
                $(params.eidTarget + ' form input:text').first().focusEnd(); // not support textarea
            }

            $(params.eidTarget + ' form').on('beforeSubmit', function (e) {
                jurakit.form.panelSubmit($(this), params);
            }).on('submit', function (e) {
                e.preventDefault();
            });
        },
        panelSubmit: function (obj, params) {
            if (obj.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: obj.attr('action'),
                type: 'post',
                data: obj.serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(params.eidTarget + ' button[type="submit"]').attr('disabled','disabled');
                },
                success: function (data) {
                    jurakit.form.submitSuccess('panelSubmit', data, params);
                }
            });
        },
        panelResetForm: function (params) {
            // Fix TinyMCE re-init
            eidTinymce = $(params.eidTarget + ' .form-tinymce');
            if (eidTinymce.length > 0) {
                eidTinymce.each(function (k, v) {
                    try {
                        tinyMCE.remove('#' + $(this).attr('id'));
                    } catch(e) {}
                });
            }
        },

        submitSuccess: function (type, data, params) {
            if (data.hasOwnProperty('r')) {
                if (data.r === 'reload') {
                    location.reload();
                    return false;
                }

                location.replace(data.r);
                return false;
            }

            if (data.hasOwnProperty('m')) {
                jurakit.form.modalMsg(data.m);
                jurakit.form.modalInstance.setType((data.s == 1) ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER);
                return false;
            }

            if (data.hasOwnProperty('f') && type === 'ajaxSubmit') {
                $(params.eidTarget).html(data.f);
                jurakit.form.ajaxEvent(params);
                return false;
            }

            if (data.hasOwnProperty('f') && type === 'modalSubmit') {
                jurakit.form.modalMsg(data.f);
                jurakit.form.modalEvent(params);

                // Fix Select2 re-init
                $('.form-group > span.select2').next('.select2').remove();

                return false;
            }

            if (data.hasOwnProperty('f') && type === 'panelSubmit') {
                if (params.funInitial != null) {
                    eval(params.funInitial + '(params)');
                }

                $(params.eidTarget).html(data.f);
                jurakit.form.panelEvent(params);
            }

            if (data.hasOwnProperty('c') && type === 'panelSubmit') {
                jurakit.form.panelResetForm(params);
                $(params.eidTarget).empty();
                if (params.eidAjaxContainer != '#undefined') {
                    $(params.eidTarget).html(jurakit.form.loader);
                }
            }

            if (params.eidPjaxContainer != null && $(params.eidPjaxContainer).length > 0) {
                jurakit.form.pjaxReload(params.eidPjaxContainer);
            }

            if (params.eidAjaxContainer != null && $(params.eidAjaxContainer).length > 0 && data.hasOwnProperty('c')) {
                $(params.eidAjaxContainer).html(data.c);
            }

            if (params.funSuccess != null) {
                if (params.funSuccess.indexOf("(") >= 0) {
                    eval(params.funSuccess);
                } else {
                    eval(params.funSuccess + '(params, data)');
                }
            }

            if (type === 'modalSubmit') {
                jurakit.form.modalInstance.close();
            }


            // LIVE
            if (typeof(params.liveSource) !== 'undefined') {
                $('[data-live-target="'+params.liveSource+'"]').each(function(k, v){
                    $.ajax({
                        url: $(this).data('live-url'),
                        dataType: 'json',
                        success: function (data) {
                            $(this).html(data.count);
                        }
                    });
                });
            }
        },

        button: function () {
            if ($('.form-btn-action').length > 0) {
                //var stickyTop = $('.form-btn-action').offset().top;
                var stickyTop = 65;
                var stickyAct = function() {
                    var windowTop = $(window).scrollTop();
                    if (stickyTop < windowTop) {
                        $('.form-btn-action').addClass('fixed');
                    } else {
                        $('.form-btn-action').removeClass('fixed');
                    }
                };

                stickyAct();
                $(window).scroll(function() {
                    stickyAct();
                });
            }
        },
        delete: function (obj) {
            BootstrapDialog.confirm({
                title: $.t('WARNING'),
                message: $.t('Are you sure you want to delete?'),
                type: BootstrapDialog.TYPE_DEFAULT,
                btnCancelLabel: $.t('Cancel'),
                btnOKLabel: $.t('Delete'),
                btnOKClass: 'btn-danger',
                closeByBackdrop: false,
                closeByKeyboard: false,
                callback: function(result) {
                    if (result) {
                        var url = obj.attr('data-url');
                        if (typeof url === 'undefined') {
                            url = obj.attr('href');
                        }

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                if (data.s === 0 && data.hasOwnProperty('m')) {
                                    BootstrapDialog.show({
                                        type: BootstrapDialog.TYPE_DANGER,
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

                                if ($(obj.data('target-delete')).length > 0) {
                                    $(obj.data('target-delete')).fadeOut(300, function(){
                                        $(this).remove();
                                    });
                                }
                            }
                        });
                    }
                }
            });
        },
        pjaxReload: function (pjaxContainer, pjaxParams) {
            if ($(pjaxContainer).length == 0) {
                return false;
            }

            paramsPjax = {container: pjaxContainer, timeout: false, async: false};
            paramsData = $(pjaxContainer).data('pjax-params');
            if (typeof(paramsData) !== 'undefined') {
                $.extend(paramsPjax, paramsData);
            }
            if (typeof(pjaxParams) !== 'undefined') {
                $.extend(paramsPjax, pjaxParams);
            }
            $.pjax.reload(paramsPjax);
            return true;
        },
        toggle: function () {
            $('[data-toggle="collapse"]').on('click', function (e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $.ajax({
                    url: app.urlToggle,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        target: target,
                        status: $(target).hasClass('in') ? 0 : 1
                    },
                    success: function (data) {

                    }
                });
            });
        }
    }
})(jQuery);

$(window).resize(jurakit.form.button);
$(document).ready(function () {
    jurakit.form.button();
    jurakit.form.ajax();
    jurakit.form.event();
    jurakit.form.filter();
    jurakit.form.toggle();
});
$(document).on('pjax:success', function(event, data, status, xhr, options) {
    //jurakit.form.ajax();
    jurakit.form.event();
    jurakit.form.filter();
    jurakit.form.toggle();
});


// Track ctrl + S
$(window).keypress(function (event) {
    if (!(event.which == 115 && event.ctrlKey) && !(event.which == 19))
        return true;

    var form = $(':focus').closest('form');
    if (form.length > 0) {
        form.submit();
    }

    event.preventDefault();
    return false;
});


// Hack bootstrap modal ordering
$(document).on('show.bs.modal', '.modal', function() {
    // $(this).appendTo($('body'));
}).on('shown.bs.modal', '.modal.in', function() {
    jurakit.form.modalOrder();
}).on('hidden.bs.modal', '.modal', function() {
    jurakit.form.modalOrder();
});
