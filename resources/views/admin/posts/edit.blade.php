<x-admin-master>
    @section('content')
        <h1>Edit - {{$post->title}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(["method" => "post", "route" => ["post.update", $post->id], "enctype" => "multipart/formdata", "files" => "true"]) !!}
            @csrf
            @method('PATCH')
            <div class="form-group">
                {!! Form::label("title", "Title") !!}
                {!! Form::text("title", $post->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title here']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File') !!}
                {!! Form::file("post_image", ['class' => 'form-control-file', 'id' => 'post_image']) !!}
                <br />
                @if ($post->post_image)
                    <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label("body", "Content") !!}
                {!! Form::textarea('body', $post->body, ['id' => 'body', 'class' => 'form-control', 'cols' => 30, 'rows' => 10]) !!}
            </div>
            {!! Form::submit("Submit", ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @endsection
</x-admin-master>