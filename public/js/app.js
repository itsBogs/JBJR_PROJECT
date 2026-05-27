$(document).ready(function() {
    let liveRefreshTimer = null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function isAjaxUrl(url) {
        if (!url || url.startsWith('#') || url.startsWith('javascript:')) return false;

        try {
            const link = new URL(url, window.location.href);
            return link.origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    function showNotice(message, type = 'success') {
        if (!message) return;

        const notice = $('<div class="ajax-notice"></div>')
            .text(message)
            .css({
                position: 'fixed',
                right: '18px',
                bottom: '18px',
                zIndex: 9999,
                maxWidth: '360px',
                padding: '12px 14px',
                borderRadius: '8px',
                fontWeight: 700,
                boxShadow: '0 12px 30px rgba(15, 23, 42, 0.2)',
                color: type === 'error' ? '#7f1d1d' : '#14532d',
                background: type === 'error' ? '#fee2e2' : '#dcfce7',
                border: type === 'error' ? '1px solid #fecaca' : '1px solid #bbf7d0'
            });

        $('.ajax-notice').remove();
        $('body').append(notice);
        setTimeout(function() {
            notice.fadeOut(200, function() {
                notice.remove();
            });
        }, 2400);
    }


    
    function setupLiveRefresh() {
        if (liveRefreshTimer) {
            clearInterval(liveRefreshTimer);
            liveRefreshTimer = null;
        }

        const liveRegion = $('#main-content [data-live-refresh="true"]');
        if (!liveRegion.length) return;

        const interval = Number(liveRegion.data('refresh-interval')) || 4000;

        liveRefreshTimer = setInterval(function() {
            if (document.hidden) return;
            if ($('#main-content input:focus, #main-content textarea:focus, #main-content select:focus').length) return;

            index(window.location.href, false, { silent: true });
        }, interval);
    }

    function updateActiveMenu(url) {
        $('.menu-inner a').removeClass('active');
        $('.menu-inner a').each(function() {
            if (this.href === url) $(this).addClass('active');
        });
    }

    
    $(document).on('click', 'nav a, #main-content a:not(.no-ajax, .btn-delete, [data-method="delete"])', function(e) {
        const url = $(this).attr('href');
        if (!isAjaxUrl(url) || $(this).attr('target') === '_blank') return;

        e.preventDefault();
        index(url);
    });

   
    $(document).on('submit', 'form:not(.no-ajax, [action*="login"], [action*="logout"])', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const method = formData.has('_method')
            ? formData.get('_method').toUpperCase()
            : ($(this).attr('method') || 'POST').toUpperCase();

        if (method === 'PUT' || method === 'PATCH') {
            update(this);
        } else if (method === 'DELETE') {
            destroy(this);
        } else {
            store(this);
        }
    });

    window.onpopstate = function() { index(window.location.href, false); };

    setupLiveRefresh();

   //INDEX
    function index(url = window.location.href, pushState = true, options = {}) {
        const silent = options.silent || false;

        if (!silent) {
            $('#main-content').css('opacity', '0.5');
        }

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.html) {
                    $('#main-content').html(response.html).css('opacity', '1');
                    if (pushState) {
                        window.history.pushState({path: url}, response.title || '', url);
                    }
                    if (response.title) document.title = response.title;
                    updateActiveMenu(url);
                    setupLiveRefresh();
                } else {
                    window.location.href = url;
                }
            },
            error: function() {
                if (!silent) {
                    window.location.href = url;
                }
            }
        });
    }

    //STORE
    function store(formElement) {
        const form = $(formElement);
        const url = form.attr('action');
        const confirmation = form.data('confirm');
        const formData = new FormData(formElement);

        if (confirmation && !confirm(confirmation)) return;

        form.find('button[type="submit"]').prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                showNotice(response.message || 'Record saved successfully');

                if (response.redirect) {
                    index(response.redirect);
                } else if (response.reload) {
                    index(window.location.href, false);
                }
            },
            error: function(xhr) {
                form.find('button[type="submit"]').prop('disabled', false).css('opacity', '1');

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    let errorMsg = '';
                    for (let field in errors) {
                        errorMsg += errors[field].join('\n') + '\n';
                    }
                    showNotice(errorMsg || 'Please check the form and try again.', 'error');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    showNotice(xhr.responseJSON.message, 'error');
                } else if (xhr.status === 403) {
                    showNotice('Unauthorized action.', 'error');
                } else {
                    showNotice('An error occurred. Please try again.', 'error');
                }
            }
        });
    }

    //UPDATE
    function update(formElement) {
        const form = $(formElement);
        const url = form.attr('action');
        const confirmation = form.data('confirm');
        const formData = new FormData(formElement);

        if (confirmation && !confirm(confirmation)) return;
        if (!formData.has('_method')) formData.append('_method', 'PUT');

        form.find('button[type="submit"]').prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                showNotice(response.message || 'Record updated successfully');

                if (response.redirect) {
                    index(response.redirect);
                } else if (response.reload) {
                    index(window.location.href, false);
                }
            },
            error: function(xhr) {
                form.find('button[type="submit"]').prop('disabled', false).css('opacity', '1');

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    let errorMsg = '';
                    for (let field in errors) {
                        errorMsg += errors[field].join('\n') + '\n';
                    }
                    showNotice(errorMsg || 'Please check the form and try again.', 'error');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    showNotice(xhr.responseJSON.message, 'error');
                } else if (xhr.status === 403) {
                    showNotice('Unauthorized action.', 'error');
                } else {
                    showNotice('An error occurred. Please try again.', 'error');
                }
            }
        });
    }

   //DESTROY
    function destroy(formElement) {
        const form = $(formElement);
        const url = form.attr('action');
        const confirmation = form.data('confirm');
        const formData = new FormData(formElement);

        if (confirmation && !confirm(confirmation)) return;
        if (!formData.has('_method')) formData.append('_method', 'DELETE');

        form.find('button[type="submit"]').prop('disabled', true).css('opacity', '0.7');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                showNotice(response.message || 'Record deleted successfully');

                if (response.redirect) {
                    index(response.redirect);
                } else if (response.reload) {
                    index(window.location.href, false);
                }
            },
            error: function(xhr) {
                form.find('button[type="submit"]').prop('disabled', false).css('opacity', '1');
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    let errorMsg = '';
                    for (let field in errors) {
                        errorMsg += errors[field].join('\n') + '\n';
                    }
                    showNotice(errorMsg || 'Please check the form and try again.', 'error');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    showNotice(xhr.responseJSON.message, 'error');
                } else if (xhr.status === 403) {
                    showNotice('Unauthorized action.', 'error');
                } else {
                    showNotice('An error occurred. Please try again.', 'error');
                }
            }
        });
    }

    // Backward-compatible alias for older code that still calls loadPage directly.
    const loadPage = index;
});
