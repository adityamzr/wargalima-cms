@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
{{-- Head Content --}}
<div class="my-5 lg:my-7.5">
  <!-- Container -->
  <div class="container-fixed flex items-center justify-between flex-wrap gap-5">
   <div class="flex flex-col justify-center items-start flex-wrap gap-1 lg:gap-2">
    <h1 class="font-medium text-lg text-gray-900">
     {{ @$page }} FAQ
    </h1>
    <div class="flex items-center gap-1 text-sm font-normal">
     <span class="text-gray-700">FAQ</span>
     <span class="text-gray-400 text-sm"> / </span>
     <a class="text-gray-700 hover:text-primary" href="{{ route('faq') }}">Daftar</a>
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
    <form action="{{ @$page == 'Ubah' ? url('faq/'.@$data->id.'/update') : route('faq-store') }}" method="POST" enctype="multipart/form-data">
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
              <label for="question" class="text-sm">Pertanyaan<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <span class="btn btn-icon btn-icon-lg btn-input">
                <i class="fa-solid fa-question">
                </i>
                </span>
                <input class="input @error('question') ? border-danger : '' @enderror" placeholder="Masukan Pertanyaan" type="text" name="question" value="{{ old('question', $data->question ?? '') }}" />
              </div>
              @error('question')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div class="">
              <label for="answer" class="text-sm">Jawaban<span class="text-danger">*</span></label>
              <div class="input-group mt-2">
                <textarea class="textarea @error('answer') ? border-danger : '' @enderror" placeholder="Masukan Jawaban" type="text" name="answer" value="{{ old('answer', $data->answer ?? '') }}">{{ old('answer', $data->answer ?? '') }}</textarea>
              </div>
              @error('answer')
                <span class="text-danger text-sm">{{ $message }}</span>
              @enderror
            </div>

          </div>
        </div>
      </div>
      <div class="flex justify-center lg:justify-start mt-2 mb-4 gap-3">
        <button class="btn btn-light" type="submit">Simpan</button>
        <a href="{{ route('faq') }}" class="btn btn-danger btn-outline">Batal</a>
      </div>
    </form>
</div>
{{-- End of body content --}}
@endsection