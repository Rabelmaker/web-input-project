@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Tambah Material</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Material</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_material') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="add">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Pembelian</label>
                                        <input class="form-control" name="tgl" required="" type="Date">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Project</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_project">
                                                <option value="">Select Penanggung Jawab</option>
                                                @foreach($datas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_project }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Uraian</label>
                                        <input class="form-control" name="uraian" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Jumlah</label>
                                        <input class="form-control" name="jumlah" required="" type="number" id="volume">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Satuan</label>
                                        <input class="form-control" name="satuan" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Harga</label>
                                        <input class="form-control" name="harga" required="" type="number" id="harga">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">ADM Bank</label>
                                        <input class="form-control" name="adm_bank" required="" type="number"
                                               id="adm_bank">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Total</label>
                                        <input class="form-control" name="total" disabled required="" type="number"
                                               id="jumlah">
                                    </div>
                                </div>
                            </div>
                            <label class="">Keterangan</label>
                            <div>
                                <textarea class="content5" name="ket"></textarea>
                            </div>
                            <label class="mt-3">Upload Lampiran</label>
                            <div class="col-sm-12 col-md-12 ">
                                <input type="file" class="dropify" name="lampiran">
                            </div>
                        </div>
                        <br>
                        <button class="btn ripple btn-main-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
