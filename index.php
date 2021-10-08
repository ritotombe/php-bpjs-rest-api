<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/json-viewer.css" />

    <title>PCare & VClaim Rest API Service</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>PCare & VClaim Rest API Service</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Jenis API</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="selectJenisAPI">
                                    <option value="vclaim">VClaim</option>
                                    <option value="pcare">PCare</option>
                                    <option value="vclaim-dev">VClaim DEV v1.1</option>
                                    <option value="pcare-dev">PCare DEV</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="consid" placeholder="ConsID">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="secret" placeholder="Secret">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button id="btn_show_hide" class="btn btn-primary btn-block">HIDE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="inputPcare">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">&nbsp;</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="username" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="custom-select" id="method">
                                    <option value="GET" selected>GET</option>
                                    <option value="POST">POST</option>
                                    <option value="PUT">PUT</option>
                                    <option value="DELETE">DELETE</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" id="url" value="https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/" style="background-color: white;">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary text-white">
                                    Endpoint API
                                </div>
                            </div>
                            <input type="text" class="form-control" id="endpoint" placeholder="Endpoint">
                            <div class="input-group-append">
                                <button type="button" id="send" class="btn btn-success">SEND</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary text-white">
                                    <input type="checkbox" id="withParam" class="mr-2" value="1"> Parameter
                                </div>
                            </div>
                            <textarea class="form-control" id="params" placeholder="Format JSON" style="resize: vertical;" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-dark" id="btnSaveCredential">Save Credential</button>
                        <button class="btn btn-danger" id="btnDeleteCredential">Delete Credential</button>
                        <a href="https://dvlp.bpjs-kesehatan.go.id:8888/trust-mark" target="_blank" class="btn btn-outline-primary">Dokumentasi VClaim</a>
                        <a href="https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0" target="_blank" class="btn btn-outline-success">Dokumentasi PCare</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-info text-white">
                                    Response :
                                </div>
                            </div>
                            <select class="custom-select" id="collapse">
                                <option class="collapseResponse" value="collapse_default" selected>Collapse Default
                                </option>
                                <option class="collapseResponse" value="collapse_all">Collapse All</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="jsonResponse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row fixed-bottom">
        <div class="col-md-12 ml-3 mb-2">
            <a href="https://github.com/morizbebenk" target="_blank" class="text-dark" style="text-decoration: none;">Dibuat Oleh Moriz</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/json-viewer.js"></script>
    <script src="js/main.js"></script>
</body>

</html>