@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')

@section('sub-content')
<style>
    /* The container */
    .radio-pilih-container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */
    .radio-pilih-container input {
        position: absolute;
        opacity: 0;
    }

    /* Create a custom radio button */
    .checkmark {
        position: absolute;
        top: 30%;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .radio-pilih-container:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .radio-pilih-container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .radio-pilih-container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .radio-pilih-container .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
</style>
<div class="content-wrapper">
    @if(!isset($DetailTransaksi))
    <form action="{{ route('postTambahTransaksi') }}" id="form-transaksi" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    @else
    <form action="{{ route('postEditTransaksi') }}" id="form-transaksi" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    @endif
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <H3 id="judulform">{{ isset($DetailTransaksi)?'Edit':'Tambah ' }} Data Diri</H3>
                    </div>
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_pelanggan" value="{{ isset($Pelanggan)?$Pelanggan->id:'' }}">
                    
                    <div class="clearfix">&nbsp;</div>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="nav nav-tabs mr-auto">
                            <li id="tab_dt_pelanggan">
                                <a href="#tab_data_pelanggan" onclick="$('#judulform').text('Data Diri');" data-toggle="tab" class="nav-link loadtable" from="data_pelanggan" id="tab_data_pelanggan2">Data Pelanggan</a>
                            </li>
                            <li id="tab_menu" class="tab-pane table-active">
                                <a href="#tab_input_menu" data-toggle="tab" onclick="judulform();" class="nav-link loadtable {{ isset($DetailTransaksi)?'':'disabled' }}" from="input_menu" id="tab_menu2">Tab Menu</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content">
                        <div class="clearfix">&nbsp;</div>
                        <div class="tab-pane" id="tab_data_pelanggan">
                            <div class="row">
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-3 col-form-label">Pemesan</label>
                                        <div class="col-md-9">
                                            <input id="nama" type="text" name="nama" class="form-control required" placeholder="Nama" value="{{ isset($Pelanggan)?$Pelanggan->nama:'' }}" {{ isset($Pelanggan)?'readonly="readonly"':'' }}>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_penerima" class="col-md-3 col-form-label">Penerima</label>
                                        <div class="col-md-9">
                                            <input id="nama_penerima" type="text" name="nama_penerima" class="form-control required" placeholder="Nama Penerima"  value="{{ isset($Transaksi)?$Transaksi->penerima:'' }}" >
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_hp" class="col-md-3 col-form-label">No Telepon</label>
                                        <div class="col-md-9">
                                            <input id="no_hp" type="text" name="no_hp" class="form-control required" placeholder="0821xxxxxx"  {{ isset($Pelanggan)?'readonly="readonly"':'' }} value="{{ isset($Pelanggan)?$Pelanggan->no_hp:'' }}">
                                        </div>  
                                    </div>
                                    <div class="form-group d-none row">
                                        <label for="email" class="col-md-3 col-form-label">E-mail</label>
                                        <div class="col-md-9">
                                            <input id="email" type="email" name="email" class="form-control" placeholder="nanamia@nanamiapizza.com">
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-md-3 col-form-label">Area</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="jalan" name="jalan" readonly="readonly" value="{{ isset($Transaksi)?$Transaksi->Jalan->nama
                                                :'' }}">
                                            <input type="hidden" class="form-control" id="id_jenis" name="id_jenis" value="{{ isset($Transaksi)?$Transaksi->id_jenis:'' }}">
                                            <input type="hidden" class="form-control" id="id_jalan" name="id_jalan" value="{{ isset($Transaksi)?$Transaksi->id_tarif_wilayah:'' }}">
                                            <input type="hidden" class="form-control" id="harga_tarif_wilayah" name="harga_tarif_wilayah" value="{{ isset($Transaksi)?$Transaksi->tarif_wilayah:0 }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button id="cariJalan" type="button" onclick="showJalan()" class="btn btn-primary">Cari</button>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                                        <div class="col-md-9">
                                            <textarea id="alamat" {{ isset($Pelanggan)?'readonly="readonly"':'' }} class="form-control" name="alamat"></textarea>
                                            <input type="hidden" id="id_alamat" name="id_alamat">
                                        </div>  
                                    </div>
                                    <div class="form-group d-none row">
                                        <label for="kabupaten" class="col-md-3 col-form-label">Kabupaten</label>
                                        <div class="col-md-9">
                                            <select id="kabupaten" name="kabupaten" class="form-control daerahOption custom-select">
                                              <option selected>Kabupaten</option>
                                              @foreach ($kabupaten['cities'] as $data)
                                              <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                              @endforeach
                                          </select>
                                        </div>  
                                    </div>
                                      <div class="form-group d-none row">
                                        <label for="kecamatan" class="col-md-3 col-form-label">Kecamatan</label>
                                        <div class="col-md-9">
                                            <select id="kecamatan" name="kecamatan" class="form-control daerahOption custom-select" disabled="disabled">
                                              <option selected>Kecamatan</option>
                                          </select>
                                        </div>  
                                    </div>
                                    <div class="form-group d-none row">
                                        <label for="kelurahan" class="col-md-3 col-form-label">Kelurahan</label>
                                        <div class="col-md-9">
                                            <select id="kelurahan" name="kelurahan" class="form-control daerahOption custom-select" disabled="disabled">
                                              <option selected>Kelurahan</option>
                                              <option value="1">One</option>
                                          </select>
                                        </div>  
                                    </div>
                                    <div class="form-group row pull-right">
                                        <button id="nexttab" class="btn btn-primary {{ isset($DetailTransaksi)?'':'disabled' }}" onclick="javascript:tab_menu2.click();" type="button">next</button>
                                    </div>
                                    <input type="hidden" name="provinsi" value="yogyakarta">
                                    <input type="hidden" name="id_provinsi" value="34">
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                @if(isset($Pelanggan))
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="form-group row">
                                          <label for="" class="col-6 col-form-label">Alamat Anda</label>
                                          <div class="col-6">
                                            {{-- <button type="button" class="btn btn-sm btn-primary">tambah alamat</button> --}}
                                            <a href="{{ url('all/pelanggan/alamat/tambah') }}/{{ $Pelanggan->id }}"  class="btn btn-sm btn-primary" target="ajax-modal">Tambah Alamat</a>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="tempatuntukalamat" class="col-md-12 pre-scrollable">
                                            <div class="form-group">
                                                <label class="d-flex radio-pilih-container align-items-center"><input type="radio" class="col-2"><span class="checkmark"></span><label id="textAlamat"></label></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
            <div class="tab-pane" id="tab_input_menu">
                <div class="clearfix">&nbsp;</div>
                <button id="add_menu" type="button" class="btn btn-xs btn-success tambah_layanan" tujuan="detail-fisioterapi-table" from="fisioterapi"> <span title="tambah" class="glyphicon glyphicon-plus">Tambah Menu</span></button>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="menu-table">
                        <thead>
                          <tr>
                              <td width="5%" align="middle"><h5>#</h5></td>
                              <td width="45%" align="center"><h5>Nama Menu</h5></td>
                              <td width="25%" align="center"><h5>Harga</h5></td>
                              <td width="10%" align="center"><h5>Jumlah</h5></td>
                              <td width="15%" align="center"><h5>total</h5></td>
                          </tr>
                      </thead>
                      <tbody id="detail-data-table">
                        @if(!isset($DetailTransaksi))
                        <tr class="data_menu" id="data_ke-0" no="0" role="row">
                            <td id="layanan_nama_place_0">
                                <button id="'+count+'" class="delete_data_detail btn btn-xs btn-danger hapus" type="button" onclick="delete_data_table(0,'new')">
                                <span title="Batal" class="fa fa-trash"></span></button>
                            </td>
                                <input type="hidden" name="count_menu[]" value="baris_0">
                            <td>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input id="menu_0" type="text" name="baris_0[menu]" class="form-control required" required="required"/>
                                        <input type="hidden" id="idmenu_0" name="baris_0[id_menu]"/></div>
                                    <div class="col-md-3">&nbsp;
                                        <button type="button" class="btn btn-sm btn-info" onclick="showMenu(0)" title="Cari Menu"><i class="fa fa-search-plus"></i></button>
                                        <button disabled="disabled" id="sowaddon0" type="button" no="0" class="btn btn-sm btn-info showAddOn" title="Cari addon"><i class="fa fa-bars"></i></button>
                                        <button id="addModifier0" type="button" no="0" class="btn btn-sm btn-warning addModifier" title="Cari Modifier"><i class="fa fa-plus"></i></button>{{-- di duplikat --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr class="mb-1">
                                        <label class="control-label pull-left">Add On</label>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="border border-light rounded d-flex flex-row flex-wrap align-content-center " id="addon_baris_ke-0">
                                            <input type="hidden" value="0" class="hide_count_addon" id="hide_count_addon0" type="button" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr class="mb-1">
                                        <label class="control-label pull-left">Modifier</label>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="border border-light rounded col-nd-12" id="modifier_baris_ke-0">
                                            <input type="hidden" value="0" class="hide_count_modifier" id="hide_count_modifier0" type="button" /> 
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td align="right">
                                <div class="row">
                                    <div class="col-5">
                                        Menu =>
                                    </div>
                                    <div class="col-5">
                                        <label id="hargateks_0"></label><input type="hidden" id="harga_0" name="baris_0[harga]">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Addon =>
                                    </div>
                                    <div class="col-5">
                                        <label id="hargateks_addon_0"></label><input type="hidden" id="harga_addon_0" name="baris_0[harga_addon]"/>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-9"><input id="qty_menu_0" untuk="0" type="number"  name="baris_0[jml]" class="form-control qtyx required" required="required"/></div>
                                </div>
                            </td>
                            <td align="right">
                                <label id="total_0" class="total_perbaris"></label>
                            </td>
                        </tr>
                        @else
                        <input type="hidden" name="id_transaksi" value="{{ $Transaksi->id }}">
                        @for ($i = 0; $i < count($DetailTransaksi); $i++)
                            <tr class="data_menu" id="data_ke-{{$i}}" no="{{$i}}" role="row">
                                <td id="layanan_nama_place_{{$i}}">
                                    <input type="hidden" name="count_menu[]" value="baris_{{$i}}" required="required">
                                    <input type="hidden" name="baris_{{$i}}[id_detail_transaksi]" value="{{ $DetailTransaksi[$i]->id }}">

                                    <button id="'+count+'" class="delete_data_detail btn btn-xs btn-danger hapus" type="button" onclick="delete_data_table({{ $i }},'new')">
                                <span title="Batal" class="fa fa-trash"></span></button>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input id="menu_{{$i}}" type="text" name="baris_{{$i}}[menu]"  value="{{ $DetailTransaksi[$i]->menu->nama_menu }}" class="form-control required"  disabled="disabled" />
                                            <input type="hidden" id="idmenu_{{$i}}" name="baris_{{$i}}[id_menu]" value="{{ $DetailTransaksi[$i]->id_menu }}" />
                                        </div>
                                        <div class="col-md-3">&nbsp;
                                            <button type="button" class="btn btn-sm btn-info" onclick="showMenu({{$i}})" title="Cari Menu"><i class="fa fa-search-plus"></i></button>
                                            <button id="sowaddon{{$i}}" type="button" no="{{$i}}" class="btn btn-sm btn-info showAddOn" title="Cari addon"><i class="fa fa-bars"></i></button>
                                            <button id="addModifier{{ $i }}" type="button" no="{{ $i }}" class="btn btn-sm btn-warning addModifier" title="Cari Modifier"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr class="mb-1">
                                            <label class="control-label pull-left">Add On</label>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="border border-light rounded d-flex flex-row flex-wrap align-content-center " id="addon_baris_ke-{{$i}}">
                                                <input type="hidden" value="{{ $DetailTransaksi[$i] }}" class="hide_count_addon" id="hide_count_addon{{$i}}" type="button" />
                                                <?php $totaladdon=0; $ii=0;?>
                                                @foreach ($DetailTransaksi[$i]->addons as $val)
                                                    <div class="mr-3 p-2" id="add_on_ke-{{ $ii }}">
                                                        <label class="label-info addon{{ $i }}" id="teks_addon_{{ $ii }}"> {{ $val->Addons->nama }} ~ Rp {{ nominalKoma($val->Addons->harga) }} </label>
                                                        <input type="hidden" class="hargaaddon{{ $i }}" value="{{ $val->harga }}" name="baris_{{ $i }}[itemharga_addon][]">
                                                        <input type="hidden" value="{{ $val->id_add_on }}" name="baris_{{ $i }}[id_addon][]">
                                                        &nbsp;
                                                        <button type="button" row="{{ $i }}" no="{{ $ii }}" style="padding: 0; background: 0 0; border: 0; -webkit-appearance: none; float: right; font-size: 1.5rem; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; opacity: .5;" class="closeAddonMenu" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php $totaladdon = $val->harga+$totaladdon; $ii++?>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <hr class="mb-1">
                                        <label class="control-label pull-left">Modifier</label>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="border border-light rounded col-nd-12" id="modifier_baris_ke-{{ $i }}">
                                            <input type="hidden" value="0" class="hide_count_modifier" id="hide_count_modifier0" type="button" />
                                            <?php $totalModifier=0; $iii=0;?>
                                                @foreach ($DetailTransaksi[$i]->modifier as $val)
                                                <div class="mr-3 p-2 row" id="modifier_ke-{{ $iii }}">
                                                    <div class="col-sm-11"><input type="text" class="form-control input-lg modifier{{ $i }}" required="required" name="baris_{{ $iii }}[modifier][]" value="{{ $val->modifier }}"></div> 
                                                    <button type="button" row="{{ $i }}" no="{{ $iii }}" style="padding: 0; background: 0 0; border: 0; -webkit-appearance: none; float: right; font-size: 1.5rem; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; opacity: .5;" class="closeModifierMenu" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <?php $totalModifier = $val->harga+$totalModifier; $iii++?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </td>
                                <td align="right">
                                    <div class="row">
                                        <div class="col-5">
                                            Menu =>
                                        </div>
                                        <div class="col-5">
                                            <label id="hargateks_{{$i}}">{{ nominalKoma($DetailTransaksi[$i]->harga) }}</label><input type="hidden" id="harga_{{$i}}" value="{{$DetailTransaksi[$i]->harga}}" name="baris_{{$i}}[harga]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            Addon =>
                                        </div>
                                        <div class="col-5">
                                            <label id="hargateks_addon_{{$i}}">{{ nominalKoma($totaladdon ) }}</label><input type="hidden" id="harga_addon_{{$i}}" value="{{ $totaladdon }}" name="baris_{{$i}}[harga_addon]"/>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-9"><input id="qty_menu_{{$i}}" untuk="{{$i}}" type="number" value="{{ $DetailTransaksi[$i]->jml }}"  name="baris_{{$i}}[jml]" class="form-control qtyx required"/></div>
                                    </div>
                                </td>
                                <td align="right">
                                    <label id="total_{{$i}}" class="total_perbaris">{{ nominalKoma($DetailTransaksi[$i]->harga + $totaladdon) }}</label>
                                </td>
                            </tr>
                        @endfor
                        @endif
                    </tbody>
                    <tfoot id="foot-data-table">
                        <tr>
                            <td colspan="4" align="right">
                                <div class="form-inline pull-right">
                                    <label class="" for="tarifwilayah">Wilayah</label>
                                    <div class="col-md-2" id="tempattarifwilayah">
                                        {{-- <select class="form-control" name="tarifwilayah" id="tarifwilayah"> 
                                            @foreach ($TarifWilayah as $val)
                                                <option value="{{ $val['id'] }}" harga="{{ $val['harga'] }}">{{ $val['nama'] }}</option>
                                            @endforeach
                                        </select> --}}
                                        <input type="hidden" id="id_tarifwilayah" value="{{ isset($Transaksi->id_tarif_wilayah)?$Transaksi->id_tarif_wilayah:'' }}" name="id_tarifwilayah">
                                    </div>
                                </div>
                            </td>
                            <td align="right"><label id="texttarifwilayah">{{ isset($Transaksi->tarif_wilayah)?nominalKoma($Transaksi->tarif_wilayah):'' }}</label></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Tax / PPN</td>
                            <td align="right"><label id="textppn">{{ isset($Transaksi->ppn)?nominalKoma($Transaksi->ppn):'' }}</label><input value="{{ isset($Transaksi->ppn)?$Transaksi->ppn:'' }}" type="hidden" id="textppn" name="ppn"></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Grand Total</td>
                            <td align="right"><label id="textgrandtotal">{{ isset($Transaksi->total_harga)?nominalKoma($Transaksi->total_harga):'' }}</label><input value="{{ isset($Transaksi->total_harga)?$Transaksi->total_harga:'' }}" type="hidden" id="grandtotal" name="grandtotal"></td>
                        </tr>
                    </tfoot>
                    <input type="hidden" value="{{ isset($i)?$i:1 }}" class="hide_count_menu" id="hide_count_menu" type="button" name="hide_count_menu"/>
                </table>
            </div>
            <div class="pull-right">
                <button type="button" data-toggle="modal" class="btn btn-info" id="submit" data-target="#myModal" onclick="konfirmasi();">Simpan</button>
                <input type="submit" id="simpan" name="submit" value="Simpan Pesanan" class="btn btn-info submit d-none">
                {{-- @if(!isset($Pelanggan))<input type="submit" id="inputlagi" name="submit" value="Input Lagi" class="btn btn-info submit">@endif --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="mb-xl-5">&nbsp;</div>

</form>
</div>

@endsection

@push('js')
<script type="text/javascript">

    function judulform(){
        setTimeout(function(){ 
            if($('#tab_input_menu').attr('class')!='tab-pane'){
                $('#judulform').text('Daftar Pesanan');
            }; 
    }, 100);
        
    }
        
    function konfirmasi(){
        var x1 = document.forms["form-transaksi"]["nama"].value;
        var x2 = document.forms["form-transaksi"]["nama_penerima"].value;
        var x3 = document.forms["form-transaksi"]["no_hp"].value;
        var x4 = document.forms["form-transaksi"]["alamat"].value;
         var x5 = 0;
        $.each($('.addModifier'),function(i, price){
            x5++;
        }); 
        if (x1 == "" || x2 == "" || x3 == "" || x4 == "" || x5==0) {
            alert("ada field yang kosong di tab sebelumnya");
            return false;
        }
        nama = document.getElementById('nama').value;
        Penerima = document.getElementById("nama_penerima").value;
        NoHP = document.getElementById("no_hp").value;
        Area = document.getElementById("jalan").value;
        Alamat = $('#alamat').val();

        data_menu = "Menu Pesanan <br>";
        ii=1;
        $.each($('.data_menu'),function(i, price){
            var row=$(this).attr('no');
            menu = '<strong>'+ii+". "+$(this).find('#menu_'+row).val()+"</strong><br>";
            addon='<i>Addon</i><br>';
            modifier='<i>Modifier</i><br>';
            o = oo =1
            $.each($('.addon'+row),function(i, price){
                addon= addon+o+". "+$(this).text()+"<br>";
                o++;
            });
            $.each($('.modifier'+row),function(i, price){
                modifier=modifier+oo+". "+$(this).val()+"<br>";
                oo++;
            });
            data_menu = data_menu+menu+addon+modifier+"<hr>";
            ii++;
        });

        isi = '<div class="modal-dialog" style="">\n\
        <div class="modal-content">\n\
            <div class="modal-header">\n\
                <button type="button" class="close" data-dismiss="modal" aria-hidden="false"><i class="fa fa-close"></i></button>\n\
            </div> \n\
        <div class="">\n\
                    <div class="container-fluid">\n\
                        <div class="col-md-12 col-md-offset-2">\n\
                        <center><strong>{{ config('app.name') }}</strong></center>\n\
                        <center><strong>Jl. Mozes Gatotkaca B 9 – 17, Gejayan, Yogyakarta</strong></center>\n\
                        <center><strong>0274 – 556494 / 549090</strong></center>\n\
                        <center><strong>OP : {{ Auth::user()->name}}</strong></center>\n\
                        </div>\n\
                        <div class="col-md-12 col-md-offset-2">\n\
                            <div class="panel panel-default">\n\
                                <div class="panel-heading">\n\
                                </div>\n\
                                <div class="clearfix">&nbsp;</div>\n\
                                <div class="portlet-body" style="display: block;">\n\
                                    <div class="clearfix">&nbsp;</div>\n\
                                    <div class="col-md-12">\n\
                                    '+
                                    'Hari & Tanggal : {{ date('d M Y') }} <br>'+
                                    'Nama : '+nama+' <br> '+
                                    'Penerima :'+Penerima+' <br> '+
                                    'No Hp :'+NoHP+' <br> '+
                                    'Area :'+Area+' <br> '+
                                    'Alamat :'+Alamat+' <br> '+
                                    data_menu+"<br>"+
                                    'PPN : <span class="pull-right">'+$('#textppn').text()+'</span> <br> '+
                                    'Tarif Wilayah  : <span class="pull-right">'+$('#harga_tarif_wilayah').val()+'</span> <br> '+
                                    'Total : <span class="pull-right">'+$('#textgrandtotal').text()+'</span> <br> '+
                                    '</div>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                </div>\n\
                <button class="btn btn-primary" onclick="submit();">submit</button>\n\
            </div>\n\
    </div>';
        $('#myModelDialog').html(isi);
        $('#myModelDialog').modal('show');
    }
    function add_data_barang_to_table(count){
        $('#hide_count_menu').val(parseInt(count)+1);
        $('<tr class="data_menu" id="data_ke-'+count+'" no="'+count+'" role="row">\n\
                            <td id="layanan_nama_place_'+count+'">\n\
                                <button id="'+count+'" class="delete_data_detail btn btn-xs btn-danger hapus" type="button" onclick="delete_data_table(\''+count+'\',\'new\')">\n\
                                <span title="Batal" class="fa fa-trash"></span></button><input type="hidden" name="count_menu[]" value="baris_'+count+'">\n\
                            </td>\n\
                            <td>\n\
                                <div class="row">\n\
                                    <div class="col-md-9"><input id="menu_'+count+'" type="text" name="baris_'+count+'[menu]" class="form-control required" /><input type="hidden" id="idmenu_'+count+'" name="baris_'+count+'[id_menu]"/></div>\n\
                                    <div class="col-md-3">&nbsp;\n\
                                        <button type="button" class="btn btn-sm btn-info" onclick="showMenu('+count+')" title="Cari Menu"><i class="fa fa-search-plus"></i></button>\n\
                                        <button disabled="disabled" id="sowaddon'+count+'" type="button" no="'+count+'" class="btn btn-sm btn-info showAddOn" title="Cari addon"><i class="fa fa-bars"></i></button>\n\
                                        <button id="addModifier'+count+'" type="button" no="'+count+'" class="btn btn-sm btn-warning addModifier" title="Cari Modifier"><i class="fa fa-plus"></i></button>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row">\n\
                                    <div class="col-md-12">\n\
                                        <hr class="mb-1">\n\
                                        <label class="control-label pull-left">Add On</label>\n\
                                        <div class="clearfix">&nbsp;</div>\n\
                                        <div class="border border-light rounded d-flex flex-row flex-wrap align-content-center " id="addon_baris_ke-'+count+'">\n\
                                            <input type="hidden" value="0" class="hide_count_addon" id="hide_count_addon'+count+'" type="button"/>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row">\n\
                                    <div class="col-md-12">\n\
                                        <hr class="mb-1">\n\
                                        <label class="control-label pull-left">Modifier</label>\n\
                                        <div class="clearfix">&nbsp;</div>\n\
                                        <div class="border border-light rounded col-nd-12" id="modifier_baris_ke-'+count+'">\n\
                                            <input type="hidden" value="0" class="hide_count_modifier" id="hide_count_modifier0" type="button" />\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                            <td align="right">\n\
                                <div class="row">\n\
                                    <div class="col-5">\n\
                                        Menu =>\n\
                                    </div>\n\
                                    <div class="col-5">\n\
                                        <label id="hargateks_'+count+'"></label><input type="hidden" id="harga_'+count+'" name="baris_'+count+'[harga]">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="row">\n\
                                    <div class="col-5">\n\
                                        Addon =>\n\
                                    </div>\n\
                                    <div class="col-5">\n\
                                        <label id="hargateks_addon_'+count+'"></label><input type="hidden" id="harga_addon_'+count+'" name="baris_'+count+'[harga_addon]"/>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                            <td>\n\
                                <div class="row">\n\
                                    <div class="col-sm-9"><input id="qty_menu_'+count+'" untuk="'+count+'" type="number"  name="baris_'+count+'[jml]" class="form-control qtyx required"/></div>\n\
                                </div>\n\
                            </td>\n\
                            <td align="right">\n\
                                <label id="total_'+count+'" class="total_perbaris"></label>\n\
                            </td>\n\
                        </tr>').appendTo('#detail-data-table');
    } 
    function delete_data_table(no,stat){
        if(confirm("Anda yakin akan menghapus data ini?")){
            var count = $('#hide_count_menu').val();
            // count = count-1;
            // $('#hide_count_menu').val(count);
            $('#data_ke-'+no).detach();
            grandTotal()
            return false;
        }
    }
    function hitungPerbaris(no){
        qty = currencyToNumber($('#qty_menu_'+no).val());
        harga = currencyToNumber($('#harga_'+no).val());
        console.log(harga);
        jml_addon=parseInt($('#hide_count_addon'+no).val());
        total_addon_perbaris=$('.hargaaddon'+no);
        totaladdon=0;
        $.each(total_addon_perbaris,function(i, price){
            var pc=$(this).val();
            console.log(pc);
            if (pc!= 'NA'){
                totaladdon = totaladdon + parseInt(currencyToNumber(pc));
            }
        });
        total = qty*(harga+totaladdon);
        $('#total_'+no).html(addCommas(total));
        $('#hargateks_addon_'+no).html(addCommas(totaladdon));
        $('#harga_addon_'+no).val(addCommas(totaladdon));
        grandTotal();
    }
    function grandTotal(){
        var count = $('#hide_count_menu').val();
        total=0;
        total_perbaris=$('.total_perbaris');
        $.each(total_perbaris,function(i, price){
            var pc=$(this).html();
            console.log(pc);
            if (pc!= 'NA'){
                total = total + parseInt(currencyToNumber(pc));
            }
        });
        // console.log(count);
        // for(var i = 0; i < count; i++){
        //     total = total + currencyToNumber($('#total_'+i).html());
        // }
        // tarifwilayah = $('#tarifwilayah option:selected').attr('harga');
        tarifwilayah = $('#harga_tarif_wilayah').val();
        gtotal = parseInt(total)+currencyToNumber(tarifwilayah);
        ppn = gtotal*0.1;
        gtotal = Math.round(gtotal*1.1);
        // $('#texttarifwilayah').html(addCommas($('#tarifwilayah option:selected').attr('harga')));
        $('#textgrandtotal').html(addCommas(gtotal));
        $('#textppn').html(addCommas(ppn));
        $('#grandtotal').val(gtotal);
    }
    function getMenuById(idmenu,no){
        $.ajax({
            type: "GET",
            url: "{{ url("all/menu/getById") }}",
            data: {
                "id_menu":idmenu,
            },  
            dataType: 'json',
            success: function(response){
                $('#menu_'+no).val(response.dataList.nama_menu);
                $('#menu_'+no).prop('disabled',true);
                $('#idmenu_'+no).val(response.dataList.id);
                $('#hargateks_'+no).html(addCommas(response.dataList.harga));
                $('#harga_'+no).val(response.dataList.harga);
                $('#qty_menu_'+no).val(1);
                $('#total_'+no).html(addCommas(response.dataList.harga));
                $('.close').click();
                $('#sowaddon'+no).attr('disabled',false);
                hitungPerbaris(no);
            }
        });
    }
    function getJalanById(id_jalan,id_jenis,jenis){
        $.ajax({
            type: "GET",
            url: "{{ url("all/jalan/getById") }}",
            data: {
                "id_jalan":id_jalan,
            },  
            dataType: 'json',
            success: function(response){
                // console.log(response);
                $('#jalan').val(response.dataList.nama+" ~ "+jenis);
                $('#id_jalan').val(response.dataList.id);
                $('#id_jenis').val(id_jenis);
                $('#harga_tarif_wilayah').val(response.dataList.tarif_wilayah.harga);
                $('#id_tarifwilayah').val(response.dataList.tarif_wilayah.id);
                $('#texttarifwilayah').html(response.dataList.tarif_wilayah.harga);
                $('#tab_menu2').attr('class','nav-link loadtable');
                $('#nexttab').attr('class','btn btn-primary');
            }
        });
        $('.close').click();
    }
    @if(isset($Pelanggan))
    function loadAlamat(){
        $.ajax({
            type: "GET",
            url: "{{ route('loadAlamat') }}",
            data: {
                "id_pelanggan":{{ $Pelanggan->id }},
            },  
            dataType: 'json',
            success: function(response){
                length=response.alamat.length;
                alamat=response.alamat;
                defaultalamat = {{ isset($Pelanggan)?$Pelanggan->id_alamat:0 }};
                $('#tempatuntukalamat').html('');
                for(var i = 0; i < length; i++){
                    if(defaultalamat==alamat[i].id){
                        checkmark = "checked";
                        $('#alamat').html(alamat[i].alamat);
                        $('#id_alamat').val(alamat[i].id);
                    }else {
                        checkmark = "";
                    }
                    $('\n\
                        <div class="form-group">\n\
                            <label class="d-flex radio-pilih-container align-items-center">\n\
                                <input type="radio" value="'+alamat[i].alamat+'" id="'+alamat[i].id+'" class="col-2 pilihalamat" name="allalamat" '+checkmark+'>\n\
                                <span class="checkmark"></span>\n\
                                <label id="textAlamat">'+alamat[i].alamat+'</label>\n\
                            </label>\n\
                        </div>\n\
                        ').appendTo('#tempatuntukalamat');
                }
            }
        }); 
    }
    @endif
    function showMenu(no){
        $('body').attr('class','sidenav-toggled');
        var url = "{{url('all/Menu/popUpMenu')}}";
        $('.modal-dialog').addClass('modal-lg');
        $('#myModelDialog').html('');

        $.ajax({
            url: url,
            data:{
              'ajax':1,
              'no':no,
          },
          cache: false,
          dataType: 'html',
          success: function(msg){
            $('#myModelDialog').on('shown.bs.modal', function () {
                // $('#layanan').focus();
            });

            $('#myModelDialog').html(msg);
            $('#myModelDialog').modal({backdrop: 'static'});
        },
        error: function(){
            $('#myModelDialog').html("request gagal dibuka");
            $('#myModelDialog').modal('show');
            console.log('gagal');
        }
        });
        return true;
    }
    function showAddOn(no){
        $('body').attr('class','sidenav-toggled');
        var url = "{{url('all/addon/popUpaddon')}}";
        $('.modal-dialog').addClass('modal-lg');
        $('#myModelDialog').html('');

        $.ajax({
            url: url,
            data:{
              'ajax':1,
              'no':no,
          },
          cache: false,
          dataType: 'html',
          success: function(msg){
            $('#myModelDialog').on('shown.bs.modal', function () {

            });

            $('#myModelDialog').html(msg);
            $('#myModelDialog').modal({backdrop: 'static'});
        },
        error: function(){
            $('#myModelDialog').html("request gagal dibuka");
            $('#myModelDialog').modal('show');
            console.log('gagal');
        }
        });
        return true;
    }
    function tambahAddOn(row,label,harga,id_addon){
        count = parseInt($('#hide_count_addon'+row).val());
        $('<div class="mr-3 p-2" id="add_on_ke-'+count+'">\n\
            <label class="label-info addon'+row+'" id="teks_addon_'+count+'">'+label+' ~ Rp '+addCommas(harga,false)+'</label>\n\
            <input type="hidden" class="hargaaddon'+row+'" value="'+harga+'" name="baris_'+row+'[itemharga_addon][]">\n\
            <input type="hidden" value="'+id_addon+'" name="baris_'+row+'[id_addon][]">\n\
            &nbsp;\n\
            <button type="button" row="'+row+'" no="'+count+'" style="padding: 0; background: 0 0; border: 0; -webkit-appearance: none; float: right; font-size: 1.5rem; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; opacity: .5;" class="closeAddonMenu" aria-label="Close">\n\
            <span aria-hidden="true">&times;</span>\n\
            </button>\n\
            </div>').appendTo('#addon_baris_ke-'+row);
        $('#hide_count_addon'+row).val(count+1);
        $('.closeAddonMenu').on('click',function(){
            no=$(this).attr('no');
            row=$(this).attr('row');

            $('#addon_baris_ke-'+row).find('#add_on_ke-'+no).detach();
            hitungPerbaris(row);
            // $('#hide_count_addon'+row).val(count-1);
        });
        hitungPerbaris(row);
    }
    function tambahModifier(row){
        count = parseInt($('#hide_count_modifier'+row).val());
        $('\n\
            <div class="mr-3 p-2 row" id="modifier_ke-'+count+'">\n\
                <div class="col-sm-11"><input type="text" class="form-control input-lg modifier'+row+'" name="baris_'+row+'[modifier][]" value="" required="required"></div>\n\
                <button type="button" row="'+row+'" no="'+count+'" style="padding: 0; background: 0 0; border: 0; -webkit-appearance: none; float: right; font-size: 1.5rem; font-weight: 700; line-height: 1; color: #000; text-shadow: 0 1px 0 #fff; opacity: .5;" class="closeModifierMenu" aria-label="Close">\n\
                <span aria-hidden="true">&times;</span>\n\
                </button>\n\
            </div>\n\
            ').appendTo('#modifier_baris_ke-'+row);

        $('#hide_count_modifier'+row).val(count+1);
        $('.closeModifierMenu').on('click',function(){
            no=$(this).attr('no');
            row=$(this).attr('row');

            $('#modifier_baris_ke-'+row).find('#modifier_ke-'+no).detach();
            // $('#hide_count_addon'+row).val(count-1);
        });
    }
    function showJalan(){
        $('body').attr('class','sidenav-toggled');
        var url = "{{route('popupjalan')}}";
        $('.modal-dialog').addClass('modal-lg');
        $('#myModelDialog').html('');

        $.ajax({
                url: url,
                data:{
                  'ajax':1,
              },
              cache: false,
              dataType: 'html',
              success: function(msg){
                $('#myModelDialog').on('shown.bs.modal', function () {
                    // $('#layanan').focus();
                });

                $('#myModelDialog').html(msg);
                $('#myModelDialog').modal({backdrop: 'static'});
            },
            error: function(){
                $('#myModelDialog').html("request gagal dibuka");
                $('#myModelDialog').modal('show');
                console.log('gagal');
            }
        });
        return true;
    }
    $(document).ready(function(){
        @if(session('id'))
        open('{{ url('all/cetaknota') }}/{{ session('id') }}','_blank'); 
        @endif
        $('#tab_data_pelanggan2').click();
        // $('#texttarifwilayah').html(addCommas($('#tarifwilayah option:selected').attr('harga')));
        $('#add_menu').on('click',function(){
            from=$(this).attr('id');
            count=$('#hide_count_menu').val();
            add_data_barang_to_table(count);
        });
        $('#menu-table').on('change','.qtyx',function(){
            count=$(this).attr('untuk');
            hitungPerbaris(count);
        });

        $('#menu-table').on('click','.showAddOn',function(){
            count=$(this).attr('no');
            showAddOn(count);
        });
        $('#myModelDialog').on('click','.pilihAddon',function(){
            no=$(this).attr('no');
            id=$(this).attr('id-addon');
            nama=$(this).attr('nama-addon');
            harga=$(this).attr('harga-addon');
            tambahAddOn(no,nama,harga,id);
            $('.close').click();
        });
        $('#menu-table').on('click','.addModifier',function(){
            no=$(this).attr('no');
            tambahModifier(no);
        });
        loadAlamat();
        $('#tempatuntukalamat').on('click','.pilihalamat',function(){
            id=$(this).attr('id');
            alamat=$(this).val();
            nama=$('#alamat').html(alamat);
            harga=$('#id_alamat').val(id);
        });
        // $('#form-transaksi').on('submit',function(){
        //     validateForm();
        // });
        @if(isset($DetailTransaksi))
        $('.closeAddonMenu').on('click',function(){
            no=$(this).attr('no');
            row=$(this).attr('row');

            $('#addon_baris_ke-'+row).find('#add_on_ke-'+no).detach();
            hitungPerbaris(row);
            // $('#hide_count_addon'+row).val(count-1);
        });
        @endif
    });
    function submit() {
        $('.close').click();
        var x1 = document.forms["form-transaksi"]["nama"].value;
        var x2 = document.forms["form-transaksi"]["nama_penerima"].value;
        var x3 = document.forms["form-transaksi"]["no_hp"].value;
        var x4 = document.forms["form-transaksi"]["alamat"].value;
        var x5 = 0;
        $.each($('#addModifier'),function(i, price){
            x5++;
        });
        if (x1 == "" || x2 == "" || x3 == "" || x4 == ""|| x5>0) {
            alert("ada field yang kosong di tab sebelumnya");
            return false;
        }
        $('#simpan').click();
    }
</script> 
@endpush
