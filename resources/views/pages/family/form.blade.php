@extends('layouts.app')

@section('title', 'Family')

@section('content')
{{-- Head Content --}}
<div class="my-5 lg:my-7.5">
  <!-- Container -->
  <div class="container-fixed flex items-center justify-between flex-wrap gap-5">
   <div class="flex flex-col justify-center items-start flex-wrap gap-1 lg:gap-2">
    <h1 class="font-medium text-lg text-gray-900">
     {{ @$page }} Keluarga
    </h1>
    <div class="flex items-center gap-1 text-sm font-normal">
     <span class="text-gray-700">Keluarga</span>
     <span class="text-gray-400 text-sm"> / </span>
     <a class="text-gray-700 hover:text-primary" href="{{ route('family') }}">Daftar</a>
     <span class="text-gray-400 text-sm"> / </span>
     <span class="text-gray-400 text-sm"> {{ @$page }} </span>
    </div>
   </div>
  </div>
  <!-- End of Container -->
</div>
{{-- End of head content --}}
{{-- Body content --}}
<div class="container-fixed">
    <form action="{{ @$page == 'Ubah' ? url('family/'.@$data->id.'/update') : route('family-store') }}" method="POST" enctype="multipart/form-data">
      @if(@$page == 'Ubah')
        @method('PUT')
      @endif
      @csrf
      <div class="card mb-5">
        <div class="card-header">
         <h3 class="card-title">
          Form {{ @$page }}
         </h3>
        </div>
        <div class="card-body">
          <div class="grid lg:grid-cols-2 gap-5 pb-5">

            <div class="">
              <label for="name" class="text-sm">Zona<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input rounded-none rounded-l-lg border-r-0">
                <i class="fa-solid fa-font"></i>
                </span>
                <div class="w-full">
                 <select class="select rounded-none rounded-r-lg" name="zone">
                  <option value="" selected>Pilih Zona</option>
                  @for($i = 1; $i <= 4; $i++)
                  <option value="{{ $i }}" {{ @$data->zone == $i ? 'selected':'' }}>Zona {{ $i }}</option>
                  @endfor
                 </select>
                </div>
              </div>
              @error('zone')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="name" class="text-sm">Baris Rumah<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input rounded-none rounded-l-lg border-r-0">
                <i class="fa-solid fa-font"></i>
                </span>
                <div class="w-full">
                 <select class="select rounded-none rounded-r-lg" name="column">
                  <option value="0" selected>Pilih Baris Rumah</option>
                  @for($i = 1; $i <= 6; $i++)
                  <option value="{{ $i }}" {{ @$data->column == $i ? 'selected':'' }}>Baris {{ $i }}</option>
                  @endfor
                 </select>
                </div>
              </div>
              @error('column')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="name" class="text-sm">Nama Keluarga / Kepala Keluarga<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input">
                <i class="fa-solid fa-envelope">
                </i>
                </span>
                <input class="input @error('name') ? border-danger : '' @enderror" placeholder="Masukan Nama Keluarga" type="text" name="name" value="{{ old('name', $data->name ?? '') }}" />
              </div>
              @error('name')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="name" class="text-sm">Jumlah Anggota Keluarga<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input">
                <i class="fa-solid fa-lock">
                </i>
                </span>
                <input class="input pass-input @error('members_amount') ? border-danger : '' @enderror" placeholder="Masukan Jumlah Anggota Keluarga. Contoh: 4" type="number" name="members_amount" value="{{ old('members_amount', $data->members_amount ?? '') }}" required/>
              </div>
              @error('members_amount')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="name" class="text-sm">Alamat<span class="text-danger">*</span></label>
              <textarea class="textarea my-2 input @error('address') ? border-danger : '' @enderror" rows="6" placeholder="Masukan alamat" type="text" name="address">{{ old('address', $data->address ?? '') }}</textarea>
              @error('address')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="since" class="text-sm">Tanggal Menjadi Warga<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input">
                <i class="fa-solid fa-calendar">
                </i>
                </span>
                <input class="input @error('joinDate') border-danger @enderror"
                  placeholder="YYYY-MM-DD"
                  type="date"
                  name="joinDate"
                  value="{{ old('joinDate', isset($data->joinDate) ? \Carbon\Carbon::parse($data->joinDate)->format('Y-m-d') : '') }}" />
              </div>
              @error('joinDate')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="name" class="text-sm">Foto Keluarga</label>
              <input class="file-input my-2" type="file" name="image"/>
              @error('image')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

          </div>
        </div>
      </div>
      <div class="flex justify-center lg:justify-start mt-2 mb-4 gap-3">
        <button class="btn btn-light" type="submit">Simpan</button>
        <a href="{{ route('family') }}" class="btn btn-danger btn-outline">Batal</a>
      </div>
    </form>
</div>
{{-- End of body content --}}
@endsection

@push('scripts')
<script>
  const eyeIcon = $('.eye-icon');
  const passInput = $('.pass-input');

  $('.btn-eye').on('click', function(){
    if(eyeIcon.hasClass('fa-eye')){
      passInput.attr('type', 'text')
      eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash')
    }else{
      passInput.attr('type', 'password')
      eyeIcon.addClass('fa-eye').removeClass('fa-eye-slash')
    }
  });
</script>
@endpush