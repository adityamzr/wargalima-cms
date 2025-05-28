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
     <a class="text-gray-700">Keluarga</a>
     <span class="text-gray-400 text-sm"> / </span>
     <a class="text-gray-700 hover:text-primary" href="#">{{ @$page }}</a>
    </div>
   </div>
   <div class="flex items-center flex-wrap gap-1.5 lg:gap-3.5">
    <a class="btn btn-light" href="{{ route('family-create') }}">
     <i class="fa-solid fa-plus">
     </i>
     Tambah Keluarga
    </a>
   </div>
  </div>
  <!-- End of Container -->
</div>
{{-- End of head content --}}
{{-- Body Content --}}
<div class="container-fixed">
  <div class="grid">
    <div class="card card-grid min-w-full">
      <div class="card-header py-5 flex-wrap">
      <h3 class="card-title">
        {{ @$title }} {{ @$page }}
      </h3>
      </div>
      <div class="card-body">
      <div id="family_datatable">
        <div class="scrollable-x-auto">
        <table class="table table-auto table-border" data-datatable-table="true">
          <thead>
          <tr>
            <th class="w-auto text-center" data-datatable-column="number">
              <span class="sort">
                <span class="sort-label">
                No
                </span>
                <span class="sort-icon">
                </span>
              </span>
            </th>
            <th class="w-auto text-center" data-datatable-column="image">
            <span class="sort">
              <span class="sort-label">
              Foto
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="w-auto" data-datatable-column="zone">
            <span class="sort">
              <span class="sort-label">
              Zona
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="min-w-40" data-datatable-column="name">
            <span class="sort">
              <span class="sort-label">
              Nama Keluarga
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="min-w-20" data-datatable-column="members_amount">
            <span class="sort">
              <span class="sort-label">
              Anggota
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="min-w-40" data-datatable-column="address">
            <span class="sort">
              <span class="sort-label">
              Alamat
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="min-w-40" data-datatable-column="joinDate">
            <span class="sort">
              <span class="sort-label">
              Tanggal Menjadi Warga
              </span>
              <span class="sort-icon">
              </span>
            </span>
            </th>
            <th class="w-auto text-center" data-datatable-column="action">
              <span class="sort">
                <span class="sort-label">
                Action
                </span>
                <span class="sort-icon">
                </span>
              </span>
            </th>
          </tr>
          </thead>
        </table>
        </div>
        <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-3 text-gray-600 text-2sm font-medium">
        <div class="flex items-center gap-2">
          Show
          <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
          </select>
          per page
        </div>
        <div class="flex items-center gap-4">
          <span data-datatable-info="true">
          </span>
          <div class="pagination" data-datatable-pagination="true">
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
{{-- End of body content --}}
@endsection

@push('scripts')
  <script>
    const apiUrl = "{{ route('family-datatable') }}";
    const element = document.querySelector('#family_datatable');

    const dataTableOptions = {
      apiEndpoint: apiUrl,
      pageSizes: [10, 20, 30, 50],
      columns: {
        number: {
          title: 'No',
          render: (item, data) => {
            let no = data.no
            return `
              <div class="flex justify-center">
                <span class="text-center">${no}</span>
              </div>
            `
          },
        },
        image: {
          title: 'Foto',
          render: (item) => {
            const defaultAvatarUrl = "{{ url('assets/media/avatars/blank.png') }}";
            const avatarUrl = item ? `{{ Storage::url('${item}') }}` : defaultAvatarUrl;

            return `
              <img alt="" class="size-9 rounded-full border-2 border-light object-cover" src="${avatarUrl}">
            `;
          },
          createdCell(cell) {
            cell.classList.add('flex', 'justify-center');
          },
        },
        zone: {
          title: 'Zona',
        },
        name: {
          title: 'Nama Keluarga / Kepala Keluarga',
        },
        members_amount: {
          title: 'Anggota',
        },
        address: {
          title: 'Alamat',
        },
        joinDate: {
          title: 'Since',
          render: (item) => {
            if (!item) return '-';
            const date = new Date(item);
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          },
        },
        action: {
          render: (item, data, context) => {
            return `
            <div class="flex justify-center gap-2">
                
                <a href="family/${data.id}/edit" class="btn btn-icon btn-outline btn-warning btn-sm btn-edit">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                
                <button class="btn btn-icon btn-outline btn-danger btn-sm btn-delete" data-id="${data.id}">
                  <i class="fa-solid fa-trash"></i>
                </button>
                
              </div>
            `;
          },
        },
      },
    };
    const dataTable = new KTDataTable(element, dataTableOptions);

    // Delete record
    $('#family_datatable').on('click', '.btn-delete', function() {
      const id = $(this).data('id');
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        customClass:{
          confirmButton: 'btn btn-light',
          cancelButton: 'btn btn-danger',
        },
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          console.log(id)
          $.ajax({
            url: "family/"+id,
            method: 'DELETE',
            data: {
              '_token': '{{ csrf_token() }}'
            },
            success: function(res){
              Toast.fire({
                icon: "success",
                title: res.message
              });
              dataTable.reload()
              if(dataTable._data.length == 1) dataTable.goPage(1)
            },
            error:function(err){
              console.log(err)
              Toast.fire({
                icon: "error",
                title: err.message
              });
            }
          });
        }
      });
    });
    // End of delete record
  </script>
@endpush

