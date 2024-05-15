@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Jasa</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Jasa</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_jasa') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Mulai</label>
                                        <input class="form-control" name="tgl_start" required="" type="Date"
                                               value="{{$data->tgl_start}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Deadline</label>
                                        <input class="form-control" name="tgl_end" required="" type="Date" value="{{$data->tgl_end}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Project</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_project">
                                                <option value="">Pilih Project</option>
                                                @foreach($projects as $item)
                                                    <option @if($item->id == $data->id_project) selected
                                                            @endif value="{{ $item->id }}">{{ $item->nama_project }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Jenis Pekerjaan</label>
                                        <input class="form-control" name="jenis_pekerjaan" required="" type="text" value="{{$data->jenis_pekerjaan}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Volume</label>
                                        <input class="form-control" name="volume" required="" type="number" id="volume" value="{{$data->volume}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Satuan</label>
                                        <input class="form-control" name="satuan" required="" type="text" value="{{$data->satuan}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Harga</label>
                                        <input class="form-control" name="harga" required="" type="number" id="harga" value="{{$data->harga}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">ADM Bank</label>
                                        <input class="form-control" name="adm_bank" required="" type="number"
                                               id="adm_bank" value="{{$data->adm_bank}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-xl-2">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Jumlah</label>
                                        <input class="form-control" name="jumlah" disabled required="" type="number"
                                               id="jumlah">
                                    </div>
                                </div>
                            </div>
                            <label class="">Keterangan</label>
                            <div>
                                <textarea class="content5" name="keterangan">{{$data->keterangan}}</textarea>
                            </div>
                            <label class="mt-3">Upload Kwitansi</label>
                            <div class="col-sm-12 col-md-12 ">
                                <input type="file" class="dropify" name="kwitansi">
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
