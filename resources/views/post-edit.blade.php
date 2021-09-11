@extends('app')
@section('content')
    <h1>{{$title}}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="" enctype="multipart/form-data">
        @csrf {{--laravel form protection feature--}}
        <div class="mb-3">
            <label for="title" class="form-label">Post Name</label>
            <input type="text"  value="{{old('title',$post['title'])}}" name="title" class="form-control" id="title" aria-describedby="nameHelp">
        </div>
        <div class="mb-3">
            <label for="featured" class="form-label">Featured Text</label>
            <textarea  name="featured" class="form-control" id="featured" aria-describedby="featuredHelp">{{old('featured',$post['featured'])}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleDataList" class="form-label">Select Category</label>
            <input name="category_name" value="{{old('category_name',$post->category->name)}}" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
            <datalist id="datalistOptions">
                @foreach($categories as $category)
                <option value="{{$category['name']}}">
                @endforeach
            </datalist>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Text</label>
            <textarea  name="message" class="form-control" id="message" aria-describedby="nameHelp">{{old('message',$post['message'])}}</textarea>
        </div>
        <div class="mb-3">
            <label for="upload" class="form-label">Upload Image(only if you want to change it)</label>
            <input name="upload" class="form-control" type="file" id="upload">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        ClassicEditor
            .create( document.querySelector( '#message' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
