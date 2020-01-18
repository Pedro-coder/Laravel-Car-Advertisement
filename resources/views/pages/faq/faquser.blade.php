@extends('layouts.app')


@section('custom-styles')

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
                <div class="card" style="background-color: #f0f0f0 !important;">
                    <div class="card-header cop-h-f-weight">
                        FAQ
                    </div>
                    <div class="card-body faq-full-body faq-body-color">



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
                                            <div class="accordion-item {{$temp_category[$item->category_id]}}">
                                                <i class="arrow"></i>
                                                <div class="accordion-toggle">{{$item->question}}</div>
                                                <div class="accordion-panel">

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
                            </div>

                            {!! $faqs->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-JS')

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
                        // Nodes with children cannot be selected
                        $('.accordion-item').hide();
                        node.children.forEach(function(currentValue, index, array) {
                            $('.' + currentValue.name).show();
                        })
                        return true;
                    }
                }
            });
        });
    </script>
@endsection
