<x-admin-master>
    @section('content')
        <h1>Create</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(["method" => "post", "route" => "post.store", "enctype" => "multipart/formdata", "files" => "true"]) !!}
        @csrf
            <div class="form-group">
                {!! Form::label("title", "Title") !!}
                {!! Form::text("title", "", ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title here']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File') !!}
                {!! Form::file("post_image", ['class' => 'form-control-file', 'id' => 'post_image']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("body", "Content") !!}
                {!! Form::textarea('body', '', ['id' => 'body', 'class' => 'form-control', 'cols' => 30, 'rows' => 10]) !!}
            </div>
            {!! Form::submit("Submit", ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @endsection
</x-admin-master>