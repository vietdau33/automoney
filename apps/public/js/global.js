const numberOnly = function (el) {
    $(el).attr('type', 'number').on("beforeinput", function (e) {
        const text = e.originalEvent.data;
        if (text == null) {
            return;
        }
        return $.inArray(text.toLowerCase(), ['e', '+', '-']) == -1;
    });
}

const copyToClipboard = function (text) {
    if (window.clipboardData && window.clipboardData.setData) {
        window.clipboardData.setData("Text", text);
        alertify.success("Copy to clipboard success!");
        return;
    }
    if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        const textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand("copy");
        } catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            prompt("Copy to clipboard: Ctrl+C, Enter", text);
        } finally {
            document.body.removeChild(textarea);
            alertify.success("Copy to clipboard success!");
        }
    }
}

window.addEventListener('DOMContentLoaded', () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.number-only').each(function () {
        numberOnly(this);
    });

    $(document).on("keydown", "form", function(event) {
        return event.key != "Enter";
    });

    if(typeof $.fn.datepicker != 'undefined') {
        $(".bs-datepicker").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            clearBtn: true,
            disableTouchKeyboard: true,
            readOnly: true
        });
    }

    $('[data-qr]').each(function(){
        const text = $(this).attr('data-qr');
        const width = $(this).attr('data-qr-width') || 200;
        const height = $(this).attr('data-qr-height') || 200;
        const level = QRCode.CorrectLevel.H;
        new QRCode(this, {
            width: parseInt(width),
            height: parseInt(height),
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: level,
            text: text
        });
    });

    $('.copy-on-click').on('click', function(e) {
        e.preventDefault();
        if(this.hasAttributes('data-text')) {
            return copyToClipboard(this.getAttribute('data-text'));
        }
        if(this.nodeName == 'INPUT' || this.nodeName == 'TEXTAREA') {
            return copyToClipboard(this.value.trim());
        }
    })
});

$.prototype.removeClassPattern = function (pattern) {
    if(pattern instanceof RegExp) {
        return this.removeClass (function (index, className) {
            return (className.match(pattern) || []).join(' ');
        });
    }
    return this;
}

$.prototype.removeClassStartWith = function (str_start) {
    const regex = new RegExp('(^|\\s)' + str_start + '\\S+', 'g');
    return this.removeClassPattern(regex);
}

if(typeof alertify != 'undefined') {
    alertify.alertSuccess = function(...params) {
        this.alert(...params);
        $('.alertify').removeClassStartWith('alertify--').addClass('alertify--success');
    }
    alertify.alertDanger = function(...params) {
        this.alert(...params);
        $('.alertify').removeClassStartWith('alertify--').addClass('alertify--danger');
    }
}
