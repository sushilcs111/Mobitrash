@extends('admin.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Occupancy
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Occupancy</li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  
                        @permission('admin.occupancy.add')
                        <a href="{!! route('admin.occupancy.add') !!}" class="btn btn-default" type="button">Add New Occupancy</a>      
                        @endpermission
                    </h3>

                    <div>
                        <p style="color:red;text-align: center">{{ Session::get('message') }}</p>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Occupancy</th>

                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($occupancy as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->is_active == 1 ? 'Yes' : 'No' }}</td>
                                <td>
                                    @permission('admin.occupancy.edit')
                                    <a href="{{ route('admin.occupancy.edit',['id' => $city->id ])  }}" class="label label-success active" ui-toggle-class="">Edit</a>
                                    @endpermission
                                    @permission('admin.occupancy.delete')
                                    <a href="{{ route('admin.occupancy.delete',['id' => $city->id ])  }}" class="label label-danger active" onclick="return confirm('Are you really want to continue?')" ui-toggle-class="">Delete</a>
                                    @endpermission
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= $occupancy->render() ?> 

                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div> 
</section>






@stop 