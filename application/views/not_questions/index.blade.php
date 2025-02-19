@extends('include_backend/template_backend')

@php
$ci = get_instance();
@endphp

@section('style')

@endsection

@section('content')

<div class="container-fluid">
    @include("include_backend/partials_no_aside/_inc_menu_repository")

    <div class="row justify-content-md-center mt-5" data-aos="fade-down">
        @php
        $group = 'client_induk';
        @endphp
        @if ($ci->ion_auth->in_group($group))
            @php
            $col_md = 'col-md-12';
            @endphp
            @else
            @php
            $col_md = 'col-md-9';
            @endphp
        <div class="col-md-3">
            @include('manage_survey/menu_data_survey')
        </div>
        @endif
        <div class="{{ $col_md }}">
            <div class="card mb-5">
                <div class="card-body">


                    <div class="alert alert-custom alert-notice alert-light-primary fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text"><?php echo $pesan ?></div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection