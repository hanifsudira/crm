@extends('dashboard.app')
@section('title', 'Home')
@section('content')
    <section class="content-header">
        <h1>CRM Complaint Report Dashboard<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>CRM</li>
            <li class="active">Chart</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sumber">Sumber:</label>
                                <select name="sumber" class="form-control">
                                    <option value="Kawal New CRM">Kawal New CRM</option>
                                    <option value="Bodrexin">Bodrexin</option>
                                    <option value="Telepon">Kawal New CRM</option>
                                    <option value="Conference Call">Conference Call</option>
                                    <option value="Video Conference">Video Conference</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="onsite_support">Nama Onsite Support:</label>
                                <input type="text" class="form-control" id="onsite_support" placeholder="Nama Onsite Support">
                            </div>
                            <div class="form-group">
                                <label for="nama_user">Nama User:</label>
                                <input type="text" class="form-control" id="nama_user" placeholder="Nama User">
                            </div>
                            <div class="form-group">
                                <label for="nik_user">NIK User:</label>
                                <input type="text" class="form-control" id="nik_user" placeholder="NIK User">
                            </div>
                            <div class="form-group">
                                <label for="user_login">User Login:</label>
                                <input type="text" class="form-control" id="user_login" placeholder="User Login">
                            </div>
                            <div class="form-group">
                                <label for="divisi">Divisi:</label>
                                <input type="text" class="form-control" id="divisi" placeholder="Divisi">
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telepon:</label>
                                <input type="text" class="form-control" id="no_telp" placeholder="No. Telepon">
                            </div>
                            <div class="form-group">
                                <label for="no_quote">No. Quote:</label>
                                <input type="text" class="form-control" id="no_quote" placeholder="No. Quote">
                            </div>
                            <div class="form-group">
                                <label for="no_order">No. Order:</label>
                                <input type="text" class="form-control" id="no_order" placeholder="No. Order">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_komplain">Deskripsi Komplain:</label>
                                <textarea name="deskripsi_komplain" class="form-control" rows="3" placeholder="Deskripsi Komplain"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="screenshot">Screenshot:</label>
                                <input type="file" id="screenshot">                                
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select name="kategori" class="form-control">
                                    <option value="CRM">CRM</option>
                                    <option value="Integrasi">Integrasi</option>
                                    <option value="Data Migrasi">Data Migrasi</option>
                                    <option value="OSS">OSS</option>
                                    <option value="Hak Akses">Hak Akses</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Follow Up:</label>
                                <select name="status" class="form-control">
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                    <option value="In Progress">In Progress</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assignee">Assignee:</label>
                                <input type="text" class="form-control" id="assignee" placeholder="Assignee">
                            </div>
                            <div class="form-group">
                                <label for="solusi">Solusi:</label>
                                <textarea name="solusi" class="form-control" rows="3" placeholder="Solusi"></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection