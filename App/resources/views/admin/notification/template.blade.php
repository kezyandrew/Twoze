@extends('layouts.app')
@section('content')

@include('layouts.breadcrumb', [
        'title' => __('Notification Template'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <span class="h3">{{__('Notification Template')}}</span>
            </div>
            <div class="row mt-3">
                <div class="col-3 text-center">
                    @foreach ($templates as $key => $temp)
                        @if ($key == 0)
                            @php
                                $first = array();
                                $first = $temp;
                            @endphp
                        @endif
                        
                        <button class="btn btn-primary w-90 mb-4" onclick="template_edit({{$temp->id}})">{{$temp->title}}</button>
                    @endforeach
                </div>
                <div class="col-7">
                    <form class="form-horizontal form" id="template_form" action="{{url('/admin/notification/template/update/'.$first->id)}}" method="post">
                    @csrf
                        <h4 class="card-title" id="temp_title">{{$first->title}}</h4>
                        <div class="form-group">
                            <label class="form-control-label" for="subject">{{__('Subject')}}</label>
                            <input type="text" value="{{$first->subject}}" name="subject" id="subject" class="form-control" placeholder="Subject" autofocus>
                        </div>

                        <label class="form-control-label" for="mail_content">{{__('Mail Content')}}</label>
                        <textarea class="textarea_editor form-control"  rows="10" name="mail_content">{{$first->mail_content}}</textarea>

                        <div class="form-group mt-3">
                            <label class="form-control-label" for="msg_content">{{__('Message Content')}}</label>
                            <input type="text" value="{{$first->msg_content}}" name="msg_content" id="msg_content" class="form-control" placeholder="{{__('Message Content')}}" >
                        </div>

                        {{-- submit --}}
                        <div class="border-top">
                            <div class="card-body text-center">
                                <input type="submit" id="edit_btn" class="btn btn-primary" value="{{__('Submit')}}">
                            </div>
                        </div>
                    </form>            
                </div>
                <div class="col-2">
                    <h4 class="card-title rtl-align-center">{{__('Available placeholder')}}</h4>
                    <div class="text-center">
                        @php
                            $loop = array(
                                'UserName',
                                'OTP',
                                'AdminName',
                                'CreatedDate',
                                'Payment',
                                'DeliveryDate',
                                'OrderId',
                                'OrderStatus',
                            );
                        @endphp
                        @foreach ($loop as $item)
                            <p id="mytext{{$item}}" class="d-none">&#123;&#123;{{$item}}&#125;&#125;</p>
                            <button class="btn-sm btn btn-primary mt-2 rtl-float-none"  id="TextToCopy" onclick="copy_function('mytext{{$item}}')"  data-toggle="tooltip" data-original-title="{{__('Click to Copy')}}">&#123;&#123;{{$item}}&#125;&#125;</button><br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection