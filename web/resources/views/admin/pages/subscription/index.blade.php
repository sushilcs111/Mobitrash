@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        User Subscriptions
        <small>Add/Edit/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  User Subscriptions</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="filter-box">
                        <?php
                        $show_f1 = 'display:none;';
                        $show_f2 = 'display:none;';
                        $show_f3 = 'display:none;';
                        $show_f4 = 'display:none;';
                        $show_f5 = 'display:none;';
                        $dis_f1 = 'disabled';
                        $dis_f2 = 'disabled';
                        $dis_f3 = 'disabled';
                        $dis_f4 = 'disabled';
                        $dis_f5 = 'disabled';
                        if ($field1) {
                            $show_f1 = '';
                            $dis_f1 = '';
                        }
                        if ($field2) {
                            $show_f2 = '';
                            $dis_f2 = '';
                        }
                        if ($field3) {
                            $show_f3 = '';
                            $dis_f3 = '';
                        }
                        if ($field4) {
                            $show_f4 = '';
                            $dis_f4 = '';
                        }
                        if ($field5) {
                            $show_f5 = '';
                            $dis_f5 = '';
                        }
                        ?>
                        {!! Form::open(['method'=>'GET','route' => 'admin.subscription.view' , 'class' => 'form-horizontal' ]) !!}
                        <label>Filter </label>
                        <span>{!! Form::select('filter_type',$filter,$filter_type, ["class"=>'form-control filter_type']) !!}</span>
                        <span>{!! Form::select('filter_value',$frequency,$field2, ["class"=>'form-control f2', "style"=>$show_f2, $dis_f2]) !!}</span>
                        <span>{!! Form::text('filter_value', $field3, ["class"=>'form-control f3', "style"=>$show_f3, $dis_f3]) !!}<span>
                        <span>{!! Form::text('filter_value',$field4, ["class"=>'form-control f4 datepicker', "style"=>$show_f4, $dis_f4]) !!}</span>
                        <span>{!! Form::text('filter_value',$field5, ["class"=>'form-control f5 datepicker', "style"=>$show_f5, $dis_f5]) !!}</span>
                        {!! Form::submit('Go',["class" => "btn btn-primary filter-button"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <h3 class="box-title">  <a href="{!! route('admin.pipedrive.all') !!}" class="btn btn-default pull-right" style="margin-left: 10px;" type="button">Import from Pipedrive</a>      
                        <a href="{!! route('admin.subscription.add') !!}" class="btn btn-default pull-right" type="button">Add New Subscription</a>      
                        
                    </h3>

                    <div>
                        <p style="color:green;text-align: center">{{ Session::pull('message') }}</p>
                        <p style="color:red;text-align: center">{{ Session::pull('messageError') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Preferred Timeslot</th>
                                <th>Frequency</th>
                                <th>Amount Paid</th>
                                <th>Start Date</th>
                                <th>End Date</th>    
                                <th>Max Waste Quantity</th>    
                                <th>Waste Type</th>    
                                <th>Subscribed On</th>
                                <th>Last Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscription as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ @$asset->user()->first()->name }}</td>
                                <td>{{ @$asset->prefered_timeslot }}</td>
                                <td>{{ @$asset->frequency()->first()->name }}</td>
                                <td>{{ $asset->amt_paid }}</td>
                                <td>{{ date('d M Y', strtotime($asset->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($asset->end_date)) }}</td>
                                <td>{{ $asset->max_waste }}</td>
                                <td>{{ @$asset->wastetypes()->first()->name }}</td>
                                <td>{{ date('d M Y', strtotime($asset->created_at)) }}</td>
                                <td>{{ @$asset->addedBy()->first()->name }}</td>

                                <td>
                                    <a href="{{ route('admin.subscription.edit',['id' => $asset->id ])  }}" target="_" class="label label-success active" ui-toggle-class="">Edit</a>                                
                                    <a href="{{ route('admin.subscription.delete',['id' => $asset->id ])  }}" target="_" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $subscription->appends(['filter_type' => $filter_type, 'filter_value' => $filter_value])->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>

@stop

@section('myscripts')

<script>
    $(".filter_type").change(function () {
        if ($(this).val() == 'timeslot_id') {
            $(".f1").show().prop('disabled', false);
            $(".f2, .f3, .f4, .f5").hide().prop('disabled', true);
        } else if ($(this).val() == 'frequency_id') {
            $(".f2").show().prop('disabled', false);
            $(".f1, .f3, .f4, .f5").hide().prop('disabled', true);

        } else if ($(this).val() == 'amt_paid') {
            $(".f3").show().prop('disabled', false);
            $(".f1, .f2, .f4, .f5").hide().prop('disabled', true);
        } else if ($(this).val() == 'start_date') {
            $(".f4").show().prop('disabled', false);
            $(".f1, .f2, .f3, .f5").hide().prop('disabled', true);
        } else if ($(this).val() == 'end_date') {
            $(".f5").show().prop('disabled', false);
            $(".f1, .f2, .f3, .f4").hide().prop('disabled', true);
        } else {
            $(".f1, .f2, .f3, .f4, .f5").hide().prop('disabled', true);
        }
    });
</script>

@stop