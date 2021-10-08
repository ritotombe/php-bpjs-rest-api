var jsonViewer = new JSONViewer();
var global_json = {}

$(document).ready(function() {
    $("#jsonResponse").html(jsonViewer.getContainer())
    if ($("#selectJenisAPI").val() == 'vclaim' || $("#selectJenisAPI").val() == 'vclaim-dev') {
        $("#inputPcare").hide()
    } else {
        $("#inputPcare").show()
    }

    if (window.localStorage.getItem("consid")) {
        $('#consid').val(window.localStorage.getItem("consid"));
    }
    if (window.localStorage.getItem("secret")) {
        $('#secret').val(window.localStorage.getItem("secret"));
    }
    if (window.localStorage.getItem("username")) {
        $('#username').val(window.localStorage.getItem("username"));
    }
    if (window.localStorage.getItem("password")) {
        $('#password').val(window.localStorage.getItem("password"));
    }

    if (window.localStorage.getItem("show_hide")) {
        setInputText(window.localStorage.getItem("show_hide"))
    }

    $("#selectJenisAPI").change(function(e) {
        if ($("#selectJenisAPI").val() == 'vclaim') {
            $("#inputPcare").hide()
            $("#url").val('https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/')
        } else if ($("#selectJenisAPI").val() == 'pcare') {
            $("#inputPcare").show()
            $("#url").val('https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0/')
        } else if ($("#selectJenisAPI").val() == 'vclaim-dev') {
            $("#inputPcare").hide()
            $("#url").val('https://dvlp.bpjs-kesehatan.go.id/vclaim-rest-1.1/')
        } else {
            $("#inputPcare").show()
            $("#url").val('https://dvlp.bpjs-kesehatan.go.id:9081/pcare-rest-v3.0/')
        }
    })

    $(".collapseResponse").click(function(e) {
        if ($("#collapse").val() == 'collapse_default') {
            jsonViewer.showJSON(JSON.parse(global_json), null, 2)
        } else {
            jsonViewer.showJSON(JSON.parse(global_json))
        }

        $("#collapse").blur()
    })

    $('#url, #endpoint').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            getResponse()
        }
    });

    $("#send").click(function(e) {
        getResponse()
    })

    $("#btnSaveCredential").click(function(e) {
        var r = ''
        r = confirm('Yakin Ingin Simpan Kredensial Di Lokal ?')

        if (r == true) {
            window.localStorage.setItem("consid", $('#consid').val());
            window.localStorage.setItem("secret", $('#secret').val());
            window.localStorage.setItem("username", $('#username').val());
            window.localStorage.setItem("password", $('#password').val());

            alert('Berhasil Disimpan')
        }
    })

    $("#btnDeleteCredential").click(function(e) {
        var r = ''
        r = confirm('Yakin Ingin Hapus Kredensial Dari Lokal ?')

        if (r == true) {
            window.localStorage.setItem("consid", '');
            window.localStorage.setItem("secret", '');
            window.localStorage.setItem("username", '');
            window.localStorage.setItem("password", '');

            $('#consid').val('')
            $('#secret').val('')
            $('#username').val('')
            $('#password').val('')
            alert('Berhasil Dihapus')
        }
    })

    $("#btn_show_hide").click(function(e) {
        var type = $("#consid").attr("type");
        if (type === 'password') {
            setInputText('text')
        } else {
            setInputText('password')
        }
    })
});

function setInputText(set = 'text') {
    $("#consid").attr("type", set);
    $("#secret").attr("type", set);
    $("#username").attr("type", set);
    $("#password").attr("type", set);

    if (set == 'text') {
        $("#btn_show_hide").html('HIDE')
    } else {
        $("#btn_show_hide").html('SHOW')
    }

    window.localStorage.setItem("show_hide", set);
}

function getResponse() {
    var withParam = 0
    if ($("#withParam").is(":checked")) {
        withParam = 1
    }

    $.ajax({
        url: "getResponse.php",
        method: "GET",
        data: {
            "jenisAPI": $("#selectJenisAPI").val(),
            "consid": $("#consid").val(),
            "secret": $("#secret").val(),
            "username": $("#username").val(),
            "password": $("#password").val(),
            "method": $("#method").val(),
            "url": $("#url").val() + $("#endpoint").val(),
            "withParam": withParam,
            "params": $("#params").val(),
        },
        success: function(e) {
            global_json = e
            if (/^[\],:{}\s]*$/.test(global_json.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                jsonViewer.showJSON(JSON.parse(e), null, 2)
            } else {
                global_json = '{"status":"gagal", "pesan":"URL tidak ditemukan"}'
                jsonViewer.showJSON(JSON.parse(global_json))
            }

            $("#send").blur();
            $("#url").blur();
            $("#endpoint").blur();
        },
        beforeSend: function() {
            $("#send").html('Loading..')
        },
        complete: function() {
            $("#send").html('SEND')
        },
    })
}