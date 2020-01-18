@extends('layouts.app')
@section('custom-styles')
    <style>
        input[type="text"] {

            background-color: #FFFFFF;

        }

        textarea {

            background-color: #FFFFFF;

        }
    </style>

    <style>

        .result {
            max-width: 800px;
            margin-top: 60px;
            margin-left: auto;
            margin-bottom: 60px;
            margin-right: auto;
        }

        .accordion {
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.15);
        }

        .accordion-item {
            position: relative;
        }

        .accordion-toggle {
            display: block;
            width: 100%;
            cursor: pointer;
            padding: 20px;
            margin: 0;
            border: 0;
            border-bottom: 1px solid #cdcdcd;
            background-color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            line-height: inherit;
            text-align: left;
        }

        .accordion-toggle:hover {
            background-color: #f5f5f5;
        }

        .is-open > .accordion-toggle {
            background-color: #3b5998;
            color: #ffffff;
        }

        .accordion-panel {
            background-color: #ffffff;
            border-bottom: 1px solid #cdcdcd;
        }

        .accordion-panel > *:last-child {
            margin-bottom: 0;
        }

        .accordion-panel p {
            padding: 20px;
            font-size: 14px;
        }

        .arrow {
            position: absolute;
            -webkit-transform: translate(-6px, 0);
            transform: translate(-6px, 0);
            margin-top: 26px;
            right: 0;
            padding-right: 20px;
            cursor: pointer;
        }

        .arrow:before, .arrow:after {
            content: "";
            transition: all 0.25s ease-in-out;
            position: absolute;
            background-color: black;
            width: 3px;
            height: 9px;
        }

        .is-open > .arrow:before, .is-open > .arrow:after {
            background-color: white;
        }

        .is-open > .arrow:before {
            -webkit-transform: translate(-2px, 0) rotate(45deg);
            transform: translate(-2px, 0) rotate(45deg);
        }

        .arrow:before {
            -webkit-transform: translate(2px, 0) rotate(45deg);
            transform: translate(2px, 0) rotate(45deg);
        }

        .is-open > .arrow:after {
            -webkit-transform: translate(2px, 0) rotate(-45deg);
            transform: translate(2px, 0) rotate(-45deg);
        }

        .arrow:after {
            -webkit-transform: translate(-2px, 0) rotate(-45deg);
            transform: translate(-2px, 0) rotate(-45deg);
        }

        img.center {
            display: block;
            margin: 0 auto;
        }

        iframe.center {
            display: block;
            margin: 0 auto;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/jqtree.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cop-h-f-weight">
                        FAQ Setup
                    </div>
                    <div class="card-body">
                        <!-- <div class="row mar-b-10">
                             <div class="col-md-12">
                                 <table class="table">
                                     <thead>
                                     <tr>
                                         <th>Question</th>
                                         <th>Answer Text</th>
                                         <th>Image</th>
                                         <th>Youtube link</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach ($faqs as $key => $item)
                                         <tr>
                                             <td><a href="{!! route("faq.edit", $item->id) !!}">{!! $item->question!!}</a></td>
                                             <td>{!! $item->answer !!}</td>
                                             <td>{!! $item->image !!}</td>
                                             <td class="ic">{!! $item->youtube_link !!}
                                                 <a onclick="return confirm('Are you sure you want to delete?');"
                                                    href="{!! route('faq.delete', @$item->id) !!}"><i
                                                             class="fa fa-times-circle icona fl-r crs-pntr cop-cross-sign"></i></a>

                                             </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                             <div class="col-md-12">
                                 {!! $faqs->render() !!}
                             </div>
                         </div> -->

                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="result col-md-12">
                                        <div id="tree1" class="card" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">

                                <div class="result">
                                    <div class="accordion js-accordion">

                                        @foreach($faqs as $key => $item)
                                            <div class="accordion-item {{$temp_category[$item->category_id]}}"
                                              data-id="{{$item->id}}"
                                              data-category="{{$temp_category[$item->category_id]}}"
                                              data-question="{{$item->question}}"
                                              data-answer="{{$item->answer}}"
                                              data-youtube_link="{{$item->youtube_link}}">
                                                <i class="arrow"></i>
                                                <div class="accordion-toggle">{{$item->question}}</div>
                                                <div class="accordion-panel">
                                                  <a href="{!! route("faq.edit", $item->id) !!}"><i class="fas fa-pencil-alt"
                                                                                                    style="margin: 1em"></i> Edit</a>
                                                  <a onclick="return confirm('Are you sure you want to delete?');"
                                                     href="{!! route('faq.delete', @$item->id) !!}" style="margin: 1em; color: red">
                                                      <i class="fa fa-trash-o "> Delete</i>
                                                  </a>
                                                    <p>{{$item->answer}}</p>

                                                    <div class="row">

                                                        @if($item->image != '')
                                                            @if($item->youtube_link == '')
                                                                <div class="col-md-12 col-12 col-sm-12">
                                                            @else
                                                                <div class="col-md-6 col-12 col-sm-12">
                                                            @endif
                                                                    <br>
                                                                    <img src="{{asset('uploads/faq').'/'.$item->image}}" class="w-75 center">
                                                                    <br>
                                                                </div>
                                                        @endif

                                                        @if($item->youtube_link != '')

                                                             @if($item->image == '')
                                                                   <div class="col-md-12 col-12 col-sm-12">
                                                             @else
                                                                   <div class="col-md-6 col-12 col-sm-12">
                                                             @endif

                                                                        <br>
                                                                        <iframe id="iframe_link" {{--height="300" width="300"--}} frameborder="0"
                                                                                            style="margin-top: 5px; height: 250px" allowfullscreen
                                                                                            src="https://www.youtube.com/embed/{{$item->youtube_link}}"
                                                                                            class="w-75 center">
                                                                        </iframe>
                                                                        <br>
                                                        @endif
                                                                    </div>



                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                    </div>
                                </div>

                                {!! $faqs->render() !!}
                            </div>
                            <hr/>


                            <div class="row mar-b-10">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="result col-md-12">
                                            <div id="tree2" class="card" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                           <div class="row">
                                              <div class="col-md-12">
                                                  {!! Form::text('category', @$faq->category, ['class' => 'form-control', 'id' => 'category_name_tree', 'required']) !!}
                                              </div>

                                           </div>
                                           <div class="container">
                                             <div class="row">
                                                <div class="btn-group">
                                                    <button type="close" id="add-tree-item" class="btn btn-success  mx-2 my-2">Add</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" id="delete-tree-item" class="btn btn-danger my-2">Delete</button>
                                                </div>
                                             </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">

                                    <div class="result">


                                        {!! Form::open(['url' => $formUrl, 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form', 'files' => true]) !!}

                                        <div class="form-group">
                                            <label for="question">Category name</label>
                                            {!! Form::text('category', @$temp_category[$faq->category_id], ['class' => 'form-control', 'id' => 'category_name', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Question</label>
                                            {!! Form::text('question', @$faq->question, ['class' => 'form-control', 'id'=> 'question', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="answer">Answer</label>
                                            {!! Form::textarea('answer', @$faq->answer, ['class' => 'form-control', 'id'=> 'answer', 'rows' => '3', 'required']) !!}
                                        </div>
                                        <div class="row mar-b-10">
                                            <div class="col-md-6">
                                                <img width="250" height="250" id="ImagePreview" src="{!! $faqImg !!}" alt="Image"
                                                     class="img-responsive"/>
                                                <span class="hide">
							            {!! Form::file('image', ['id'=>'faqImage']) !!}
							            </span>
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::text('youtube_link', @$faq->youtube_link, ['class' => 'form-control','id'=> 'you_link','placeholder'=>'Enter youtube link']) !!}
                                                <iframe id="iframe_link" {{--width="250"--}} {{--height="255"--}} frameborder="0"
                                                        style="margin-top: 5px"
                                                        allowfullscreen></iframe>
                                            </div>
                                        </div>

                                        @if (!empty(@$faq))
                                            <a class="btn btn-md btn-primary mar-l-15 pull-right" href="{!! route('faqs') !!}">
                                                Cancel
                                            </a>
                                            <a class="btn btn-md btn-danger mar-l-15 pull-right"
                                               onclick="return confirm('Are you sure you want to delete?');"
                                               href="{!! route('faq.delete', @$faq->id) !!}">
                                                Delete
                                            </a>
                                        @endif

                                        <div id="editButtonsGroup"  style="display:none">
                                          <a id="deleteButton" class="btn btn-md btn-danger mar-l-15 pull-right mx-2"
                                             onclick="return confirm('Are you sure you want to delete?');"
                                             href="">
                                              Delete
                                          </a>
                                          <button type="submit" id="editButton" class="btn btn-md btn-warning pull-right mx-2">
                                              Edit
                                          </button>
                                        </div>

                                        <button type="submit" class="btn btn-md btn-success pull-right mx-2">
                                            {!! empty($faq) ? 'Save' : 'Update' !!}
                                        </button>
                                        {!! Form::close() !!}

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
            <script type="text/javascript">
                $(document).ready(function () {
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#ImagePreview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#faqImage").css('display', 'none');
                    var url = $("#you_link").val();
                    url = url.split('v=')[1];
                    $("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
                    $("#iframe_link").show();

                    $('#ImagePreview').click(function () {
                        $('#faqImage').trigger('click');
                    });
                    $('#faqImage').on('change', function () {
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#ImagePreview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                    $("#you_link").blur(function () {
                        var url = $("#you_link").val();
                        url = url.split('v=')[1];
                        $("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
                        $("#iframe_link").show();
                    });
                });
            </script>

            <script>
                // On DOM ready,
                $(document).ready(function () {
                    // Cache selectors
                    var $accordion = $(".js-accordion");
                    var $allPanels = $(" .accordion-panel").hide();
                    var $allItems = $(".accordion-item");

                    // Event listeners
                    $accordion.on("click", ".accordion-toggle", function () {
                        // Toggle the current accordion panel and close others
                        $allPanels.slideUp();
                        $allItems.removeClass("is-open");
                        if (
                            $(this).next().is(":visible")) {
                            $(".accordion-panel").slideUp();
                        } else {
                            $(this).next().slideDown().closest(".accordion-item").addClass("is-open");
                        }
                        return false;
                    });
                });
            </script>
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
                var $tree_2, $tree_1;
                var faqId;
                $(function() {
                    $('.accordion-item').on('click', function(){
                        var id = $(this).data("id");
                        var category = $(this).data("category");
                        var question = $(this).data("question");
                        var answer = $(this).data("answer");
                        var youtube_link = $(this).data("youtube_link");
                        $('#category_name').val(category);
                        $('#question').val(question);
                        $('#answer').val(answer);
                        $('#you_link').val(youtube_link);
                        $('#editButtonsGroup').show();
                        faqId = id;
                    });

                    $('#editButton').on('click', function () {
                        $('#form').attr('action', '/faqsetup/'+ faqId +'/update');
                    });

                    $('#deleteButton').on('click', function () {
                        $(this).attr('href', '/faqsetup/'+ faqId +'/delete')
                    });

                    $tree_1 = $('#tree1').tree({
                        data: data,
                        autoOpen: true,
                        dragAndDrop: false,
                        saveState: 'my-tree',
                        // closedIcon: '+',
                        // openedIcon: '-'
                        onCanSelectNode: function(node) {
                            if (node.children.length == 0) {
                                // Nodes without children can be selected
                                $('.accordion-item').hide();
                                $('.' + node.name).show();
                                return true;
                            }
                            else {
                                $('.accordion-item').hide();
                                node.children.forEach(function(currentValue, index, array) {
                                    $('.' + currentValue.name).show();
                                })
                                return true;
                            }
                        }
                    });

                    $tree_2 = $('#tree2').tree({
                        data: data,
                        autoOpen: true,
                        dragAndDrop: true,
                        saveState: 'my-tree',
                        // closedIcon: '+',
                        // openedIcon: '-'
                        onCanSelectNode: function(node) {
                            if (node.children.length == 0) {
                                // Nodes without children can be selected
                                $('#category_name_tree').val(node.name);
                                $('#category_name').val(node.name);
                                return true;
                            }
                            else {
                                // Nodes with children cannot be selected
                                return false;
                            }
                        },
                        onCanMoveTo: function(moved_node, target_node, position) {
                            if (target_node.parent.name === "") {

                                return true;
                            }

                            return false;
                        },
                        onDragStop: function(node, event) {
                            console.log('node: ', node);
                            console.log('event: ', event);
                            $.ajax({
                                url: "faq/category/move",
                                type: 'PUT',
                                dataType: "JSON",
                                data: {
                                    "_token": '{{ csrf_token() }}',
                                    "moved": node.name,
                                    "parent": node.parent.name
                                },
                                success: function (data)
                                {
                                    console.log(data);
                                }
                            });
                        }
                    });



                    $('#delete-tree-item').on('click', function (event) {
                        var node = $tree_2.tree('getSelectedNode');
                        if (node === false) {
                            alert('Select category.')
                        }
                        if (node.children.lenght !== 0 || node.parent.lenght !== 0) {
                          $.ajax({
                              url: "faq/category/destroy/name/" + node.name,
                              type: 'DELETE',
                              dataType: "JSON",
                              data: {
                                  "_method": 'DELETE',
                                  "_token": '{{ csrf_token() }}',
                              },
                              success: function ()
                              {
                                  console.log("it Work");
                              }
                          });

                        } else {
                          $.ajax(
                          {
                              url: "faq/category/destroy/parent/" + node.name,
                              type: 'DELETE',
                              dataType: "JSON",
                              data: {
                                  "_method": 'DELETE',
                                  "_token": '{{ csrf_token() }}',
                              },
                              success: function ()
                              {
                                  console.log("it Work");
                              }
                          });
                        }
                        // $tree_1.tree('removeNode', node);
                        $tree_2.tree('removeNode', node);
                        $('#category_name_tree').val('');
                        $('#category_name').val('');
                        console.log(node);
                    });

                    $('#add-tree-item').on('click', function (event) {
                        var catName = $('#category_name_tree').val();
                        $.post( "faq/category/parent", {
                            _token: '{{ csrf_token() }}',
                            parent: catName
                          }, function( data ) {
                            console.log(data);
                        });
                        $tree_2.tree(
                            'appendNode',
                            {
                                name: catName,
                                id: data.lenght + 1
                            }
                        );
                        $tree_1.tree(
                            'appendNode',
                            {
                                name: catName,
                                id: data.lenght + 1
                            }
                        );
                    });
                });
            </script>
@endsection
