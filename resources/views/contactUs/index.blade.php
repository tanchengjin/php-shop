@extends('main')
@section('breadcrumb_title','Contact Us')
@section('content')
    <!--contact map start-->
    <div class="contact_map mt-70">
        <div class="map-area">
            <div id="googleMap"></div>
        </div>
    </div>
    <!--contact map end-->

    <!--contact area start-->
    <div class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact_message content">
                        <h3>contact us</h3>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                            est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                            formas human. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Address : {{config('base.address')}}</li>
                            <li><i class="fa fa-phone"></i> <a
                                    href="tel:{{config('base.telephone')}}">{{config('base.telephone')}}</a></li>
                            <li><i class="fa fa-envelope-o"></i><a
                                    href="mailto:{{config('base.email')}}">{{config('base.email')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    @if(count($errors) >= 1)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>警告:</strong>{{$error}}
                            </div>
                        @endforeach
                    @endif

                    @if(old('status'))
                        <div class="alert alert-success">
                            <span>{{trans('contactUs.message_success')}}</span>
                        </div>
                    @endif
                    <div class="contact_message form">
                        <h3>{{trans('contactUs.tell_us_your_project')}}</h3>
                        {{--                        <form id="contact-form" method="POST" action="assets/mail.php">--}}
                        <form id="contact-form" method="POST" action="{{route('contactUs.store')}}">
                            {{csrf_field()}}
                            <p>
                                <label> {{trans('contactUs.your_name')}} ({{trans('contactUs.required')}})</label>
                                <input name="name" placeholder="{{trans('contactUs.name')}} *" type="text" required
                                       minlength="1">
                            </p>
                            <p>
                                <label> {{trans('contactUs.your_email')}} ({{trans('contactUs.required')}})</label>
                                <input name="email" placeholder="{{trans('contactUs.email')}} *" type="email" required>
                            </p>
                            <p>
                                <label> {{trans('contactUs.subject')}} ({{trans('contactUs.required')}})</label>
                                <input name="subject" placeholder="{{trans('contactUs.subject')}} *" type="text"
                                       required minlength="5">
                            </p>
                            <div class="contact_textarea">
                                <label> {{trans('contactUs.your_message')}} ({{trans('contactUs.required')}})</label>
                                <textarea placeholder="{{trans('contactUs.message')}} *" name="message"
                                          class="form-control2" required minlength="9"></textarea>
                            </div>
                            <button type="submit"> {{trans('contactUs.send')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact area end-->
@endsection
