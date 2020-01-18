<div class="modal fade bd-example-modal-lg" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1100px !important">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Plan & Price</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(array('id'=>'eventM_form' , 'route' => 'eventM.store', 'files' => true)) !!}
              @csrf

              <div class="img-upload " style="border-radius: 0px !important;text-align:center;padding-left:30px" >
                      <img width="1000" height="300" id="modal_image_preview" src="/uploads/avatars/picture-01-512.png" alt="Image"  class="img-responsive"/>
                      <span class="hide">
                      {{-- {!! Form::file('event_modal_image', ['id'=>'event_modal']) !!} --}}
                      <input class="form-control" type="file" id="event_modal" name="event_modal_image" >

                      </span>
                  </div>
                  <div class="input-group">
                    <div class="container">
                      <div class="row">
                          <div class="col-sm-2 m-0 p-0 ml-1">
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker5" data-target-input="nearest">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                      <input type="text" id="datetimepicker5" class="form-control form-control-sm datetimepicker-input" placeholder="Date" name="event_date" data-toggle="datetimepicker" data-target="#datetimepicker5"/>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-3 m-0 p-0 ml-3">
                            <div class="form-group row">
                              <div class="col-sm-6 m-0 p-0 input-group date" id="datetimepicker3" data-target-input="nearest">
                                  <input type="text" placeholder="Start" name="event_start_time" class="form-control form-control-sm datetimepicker-input" data-target="#datetimepicker3" data-toggle="datetimepicker"/>
                              </div>
                              <div class="col-sm-6 m-0 p-0 input-group date" id="datetimepicker4" data-target-input="nearest">
                                  <input type="text" placeholder="End" name="event_end_time" class="form-control form-control-sm datetimepicker-input" data-target="#datetimepicker4" data-toggle="datetimepicker"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2 m-0 p-0 ml-1">
                              <div class="form-group">
                                  <div class="input-group date">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-ticket-alt"></i></div>
                                    </div>
                                      <input type="text" class="form-control form-control-sm" name="event_ticket_price"  placeholder="Price" id="event_ticket_price">
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-3 m-0 p-0 ml-1">
                              <div class="form-group">
                                  <div class="input-group date">
                                      <input type="text" class="form-control form-control-sm" name="event_details"  placeholder="Details" id="event_detail">
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-1 m-0 p-0 ml-1">
                              <div class="form-group">
                                <button type="submit" name="button" class="btn btn-primary btn-sm" id="add_event_options">
                                  <i class="fas fa-plus"></i> Add
                                </button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
          {{-- <div class="event-img-upload">
            <div id="inner-img-upload">
                <i class="fas fa-camera fa-2x" id="event_modal_image"></i>
                <span class="event_modal"></span>
                {{ Form::file('event_modal_image', ['id' => 'event_modal']) }}
                <p>Click to upload</p>
                <img id="modal_image_preview" src="" id="my_modal" width="200px"/>
           </div>
            @if ($errors->has('event_featured_image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('event_featured_image') }}</strong>
                </span>
            @endif
          </div> --}}
          {!! Form::close() !!}
          <div class="col-md-12">
            @if(!empty($eventOptions))
            @foreach ($eventOptions as $eventM)

            <div class="row mt-2">
              <div class="col-sm-1 ">
                  <div class="form-group">
                      {{-- <div class="input-group date"> --}}
                        {{-- <div class="input-group-append">
                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                        </div> --}}
                        <?php if(!empty($eventM)){ ?>
                          <label   id="event_date" class="" style="border:none !imprtant"
                           name="event_date">{{ substr(strip_tags($eventM->event_date), 0, 11) }}
                          {{ strlen(strip_tags($eventM->event_date)) > 11 ? " " : ""}}</label>
                        <?php }else{

                            	echo "hi";

                        } ?>
                      {{-- </div> --}}
                  </div>
              </div>
              <div class="col-sm-2 ">
                  <div class="form-group">
                      <div class="input-group date">
                        {{-- <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div> --}}
                        <?php if(!empty($eventM)){ ?>
                        <label class="" placeholder="" name="event_start_time"> {{ $eventM->event_start_time }} - {{ $eventM->event_end_time }}</label>
                        <?php }else{ echo "hi"; } ?>
                        {{-- <label disabled type="text" class="col-sm-6 form-control form-control-sm" placeholder="" name="event_end_time"></label> --}}
                      </div>
                  </div>
              </div>
              <div class="col-sm-1 m-0 p-0 ml-1">
                  <div class="form-group">
                      <div class="input-group date">
                          <label  class="" name="event_ticket_price"  placeholder="" id="event_ticket_price"><i class="fas fa-ticket-alt"></i>{{ $eventM->event_ticket_price }}</label>
                      </div>
                  </div>
              </div>
              <div class="col-sm-3 m-0 p-0 ml-1">
                      <div class="form-group">
                          <div class="input-group date">
                              <label  class="" name="event_ticket_price"  placeholder="" id="event_ticket_price">{{ $eventM->event_details }}</label>
                          </div>
                      </div>
                  </div>
              <div class="col-sm-1 m-0 p-0 ml-1 mr-2 mt-1">
                  <div class="form-group">
                      <div class="input-group date">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="event_going">
                        <label class="" for="event_going">{{$goingCount}} Going <small class="text-danger">({{$pendingCount}} waiting)</small></label>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-3 ">
                  <div class="">
                          <button class="btn btn-default" type="" name="event_not_going" style="">
                                  <i class="far fa-times-circle fa-1x"></i> going
                                </button>
                    <button  name="btn" class="btn btn-default btn-sm" style="margin-right:-35px;float:right" onclick="openForm()">
                      <i class="fas fa-list-ul"></i> Approve List <span class="badge badge-secondary">{{$pendingCount + $goingCount}}</span> &nbsp;  <i class="fas fa-times"></i>
                    </button>


                  </div>
              </div>


            </div>

            @endforeach
           @endif
            <div class="chat-popup" id="myForm" style="background:white;margin-bottom: 34px;">

                     <a onclick="closeForm()"> <i class="fas fa-times" style="float:right"></i></a>
                    {{-- <h1>Chat</h1> --}}

                    @foreach ($eventVisitors as $eventVisitor)



                      <div class="row" style="margin-top:30px">

                          @foreach ($users as $user)

                            @if($eventVisitor->user_id == $user->id)

                              <div class="col-md-2 ">
                                  <img id="user_avatar_img" src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                                  style="width:50px; height:50px; border-radius:50%;margin-left:2px">

                              </div>
                              <div class="col-md-3" style="margin-top:10px;margin-left:15px">
                                  {{$user->name}}
                              </div>

                              @if($eventVisitor->going_status == 'approved')

                                 <div class="col-md-2" style="margin-top:10px;float:right;margin-left:85px">

                                    {{-- <a href="/going-status/approved/{{$user->id}}/{{$eventVisitor->event_id}}/{{ $eventM->event_ticket_price }}" > <i class="fa fa-check-circle " aria-hidden="true"></i> </a> --}}
                                 </div>

                                @else
                                <?php if(!empty($eventM)){ ?>
                                    <div class="col-md-2" style="margin-top:10px;float:right;margin-left:85px">
                                <?php if($event->need_approval == 'on'){ ?>
                                        <a href="/going-status/approved/{{$user->id}}/{{$eventVisitor->event_id}}/{{ $eventM->event_ticket_price }}"> <i class="fa fa-check-circle " aria-hidden="true"></i> </a>
                                    </div>
                                <?php } ?>
                                <?php }else{  } ?>
                               @endif
                               <?php if(!empty($eventM)){ ?>
                                <div class="col-md-2" style="margin-top:10px;float:right;margin-left:-32px">

                                    <a href="/going-status/rejected/{{$user->id}}/{{$eventVisitor->event_id}}/{{ $eventM->event_ticket_price }}">    <i class="fa fa-times-circle" aria-hidden="true"></i> </a>

                                </div>
                            <?php }else {  } ?>

                              @endif

                           @endforeach


                      </div>



                    @endforeach


                    {{-- <button type="button" class="btn cancel" onclick="closeForm()">Close</button> --}}

                </div>
          </div>
          </div>
          {{-- <div class="form-group mt-3">
            {!! Form::open(array('id'=>'eventM_form' , 'route' => 'eventM.store', 'files' => true)) !!}
                @csrf --}}
              {{-- <div class="input-group">
                <div class="container">
                  <div class="row">
                      <div class="col-sm-2 m-0 p-0 ml-1">
                          <div class="form-group">
                              <div class="input-group date" id="datetimepicker5" data-target-input="nearest">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                </div>
                                  <input type="text" id="datetimepicker5" class="form-control form-control-sm datetimepicker-input" placeholder="Date" name="event_date" data-toggle="datetimepicker" data-target="#datetimepicker5"/>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-3 m-0 p-0 ml-3">
                        <div class="form-group row">
                          <div class="col-sm-6 m-0 p-0 input-group date" id="datetimepicker3" data-target-input="nearest">
                              <input type="text" placeholder="Start" name="event_start_time" class="form-control form-control-sm datetimepicker-input" data-target="#datetimepicker3" data-toggle="datetimepicker"/>
                          </div>
                          <div class="col-sm-6 m-0 p-0 input-group date" id="datetimepicker4" data-target-input="nearest">
                              <input type="text" placeholder="End" name="event_end_time" class="form-control form-control-sm datetimepicker-input" data-target="#datetimepicker4" data-toggle="datetimepicker"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 m-0 p-0 ml-1">
                          <div class="form-group">
                              <div class="input-group date">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-ticket-alt"></i></div>
                                </div>
                                  <input type="text" class="form-control form-control-sm" name="event_ticket_price"  placeholder="Price" id="event_ticket_price">
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-3 m-0 p-0 ml-1">
                          <div class="form-group">
                              <div class="input-group date">
                                  <input type="text" class="form-control form-control-sm" name="event_details"  placeholder="Details" id="event_detail">
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-1 m-0 p-0 ml-1">
                          <div class="form-group">
                            <button type="submit" name="button" class="btn btn-primary btn-sm" id="add_event_options">
                              <i class="fas fa-plus"></i> Add
                            </button>
                          </div>
                      </div>
                  </div>
              </div>
            </div> --}}
          {{-- {!! Form::close() !!}
          </div> --}}
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
  