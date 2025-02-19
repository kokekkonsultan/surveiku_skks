@extends('include_backend/template_backend')

@php
$ci = get_instance();
@endphp

@section('style')
<link href="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class=" container-fluid">

    <div class="card card-custom bgi-no-repeat gutter-b aos-init aos-animate" style="height: 150px; background-color: #1c2840; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url(/assets/img/banner/rhone-2.svg)" data-aos="fade-down">
        <div class="card-body d-flex align-items-center">
            <div>
                <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                NILAI INDEKS BAGIAN
                </h3>
            </div>
        </div>
    </div>



    <div class="card shadow aos-init aos-animate" data-aos="fade-up">
        <div class="card-body">
            <table id="table" class="table mt-5" cellspacing="0" width="100%">
                <thead class="bg-gray-300" style="display: none;">
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('javascript')
<script src="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.js"></script>
<script>
    var table;
    $(document).ready(function() {
        table = $("#table").DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [5, 10, -1],
                [5, 10, "Semua data"]
            ],
            "pageLength": 5,
            "ordering": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url() . 'nilai-index-bagian/ajax-list' ?>",
                "type": "POST",
                "dataType": "json",
                "dataSrc": function(jsonData) {
                    return jsonData.data;
                },
                "data": function(data) {},

            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });
    });
</script>

<script type="text/javascript">
    function outputhide(val){
        if(document.getElementById('q'+val).style.display=='none'){
            document.getElementById('q'+val).
            style.display=''
            //console.log('q'+val);

            /*$("#detail"+val).DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [
                    [5, 10, -1],
                    [5, 10, "Semua data"]
                ],
                "pageLength": 5,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url() . 'nilai-index-bagian/ajax-list-sektor' ?>",
                    "type": "POST",
                    "dataType": "json",
                    "dataSrc": function(jsonData) {
                        return jsonData.data;
                    },
                    "data": function(data) {},

                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });*/

        }else{
            document.getElementById('q'+val).style.display='none'
        }
    }
 
    /*function hideNonVisibleDivs() {
        var divsToHide = document.getElementsByClassName("q"); 
        for(var i = 0; i < divsToHide.length; i++){
            if(document.getElementById('q'+i).style.display!='none'){
                document.getElementById('q'+i).style.display='none'
            }
        }
    }*/
</script>
@endsection