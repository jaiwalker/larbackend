
@extends('BackendViews::mainTemplate')
@section('page-wrapper')

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">{{ \Lang::get('panel::fields.dashboard') }}</h1>
            <div class="icon-bg ic-layers"></div>
        </div>

    </div>
    <!-- /.row -->
    <div class="row box-holder">

        @if(is_array(\Jai\Backend\Link::returnUrls()))

        @endif

    </div>
    <script>
        $(function(){
            var color = ['primary','green','orange','red','purple','green2','blue2','yellow'];
            var pointer = 0;
            $('.panel').each(function(){
                if(pointer > color.length) pointer = 0;
                $(this).addClass('panel-'+color[pointer]);
                $(this).find('.pull-right .add').addClass('panel-'+color[pointer]);
                pointer++;
            })
        })
    </script>
@stop            