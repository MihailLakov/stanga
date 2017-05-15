@extends('common.app')
@section('content')
@if (Auth::check())
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="admin"> Admin Page </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8">            
            <div class="table-responsive">
                <table class="table table-striped">                    
                    <tr>
                        <th>ID</th>
                        <th>Word in EN</th>
                        <th>Word in BG</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($words as $word)
                    <tr>
                    <form action="{{ URL::to('admin/word/update',['id'=>$word->id]) }}" method="POST" >
                        {{ csrf_field() }}
                        <td>{{ $word->id }}</td>
                        <td><input type="text" name="word" class="form-control" value="{{ $word->word }}"></td>
                        <td><strong>{{ $word->translation }}</strong></td>
                        <td>{{ $word->created_at }}</td>
                        <td>{{ $word->updated_at }}</td>
                        <td>
                            <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Update Word #{{ $word->id }}">
                                <i class="glyphicon glyphicon-refresh"></i> 
                            </button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ URL::to('admin/word/delete',['id'=>$word->id]) }}" method="POST" >
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Word #{{ $word->id }}">
                                <i class="glyphicon glyphicon-trash"></i> 
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $words->links()  }}
        </div>
        <div class="col-xs-12 col-md-4"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 >Add a word</h2>
                </div>
                <div class="panel-body">
                    <form action="{{ URL::to('admin/word/add') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="word"  class="form-control" placeholder='example: Dog'>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-plus"></i> Add Word
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"> 
                    <h2 >Add words from a file</h2>  
                </div>
                {!! Form::open(
                array(
                'route' => 'translate-from-file',      
                'files' => true))
                !!}               
                <div class="form-group">
                    {!! Form::file('csv',['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Upload file', array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endif
@endsection