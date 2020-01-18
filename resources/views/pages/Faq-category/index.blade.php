@extends('layouts.app')
@section('custom-styles')
    <script
            src="http://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/jqtree.css') }}">

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cop-h-f-weight">
                        FAQ Category Setup
                        <a href="{!! route('home') !!}"> <i class="fa fa-times-circle fl-r crs-pntr cop-cross-sign"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row mar-b-10">
                            <div class="col-md-4">
                                <div id="tree1"></div>
                            </div>

                            <div class="col-md-6">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home">Add new</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#list">List</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active"><br>
                                        <form action="{{ route('faq.category.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Parent Category</label>
                                                <input type="text" name="parent" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <input type="file" name="parent_icon" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" name="category" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <input type="file" name="category_icon" class="form-control">
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="submit" class="btn btn-primary" value="Save">
                                            </div>
                                        </form>
                                    </div>
                                    <div id="list" class="container tab-pane fade"><br>
                                        <table class="table table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Parent</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($faqs))
                                                    @foreach($faqs as $faq)
                                                        <tr>
                                                            <td>{{ $faq->name }} <img src="{{ Storage::url('/faq-category/'. $faq->icon) }}" style="width: 25px; height: 25px; display: {{ ($faq->icon) ? 'block' : 'none' }}"></td>
                                                            <td>{{ $faq->parent->name }} <img src="{{ Storage::url('/faq-category/'. $faq->parent->icon) }}" style="width: 25px; height: 25px; display: {{ ($faq->icon) ? 'block' : 'none' }}"></td>
                                                            <td>
                                                                <a href="{{ route('faq.category.edit', $faq->id) }}">Edit</a>
                                                                <form method="post" action="{{ route('faq.category.destroy', $faq->id) }}" id="delete_{{$faq->id}}">
                                                                    {!! csrf_field() !!}
                                                                    {!! method_field('DELETE') !!}
                                                                    <a href="javascript:void(0);" onclick="if(confirmDelete()){ document.getElementById('delete_<?=$faq->id;?>').submit(); }">
                                                                            Delete </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-JS')
    <script src="{{ asset('js/tree.jquery.js') }}"></script>
    <script>
        function confirmDelete()
        {
            var r = confirm("Are you sure you want to perform this action?");
            if (r === true)
            {
                return true;

            }
            else{
                return false;
            }
        }
        var data = {!! json_encode($parent_arr) !!};
        $(function() {
            $('#tree1').tree({
                data: data,
                autoOpen: true,
                dragAndDrop: true,
                saveState: 'my-tree',
                closedIcon: '+',
                openedIcon: '-'
            });
        });
    </script>
@endsection