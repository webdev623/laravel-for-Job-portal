@extends('front.layout.front-app')
@push('style')

@endpush
@section('content')

    <div class="single-page-header">
        <div class="container">
            <div class="">
                <h2>Technical Support <i class="icon-feather-life-buoy"></i></h2>
            </div>
        </div>
    </div>

    <!-- Page Content
    ================================================== -->
    <div class="container">
        <div class="row">
            <div class="col-xl-7">

                <section id="contact" class="margin-bottom-60">
                    <h3 class="headline margin-top-15 margin-bottom-10">Ask Anything. We're here to help!</h3>
                    <div class="margin-bottom-35">Your concerns are our top priority. Leave us a message below and we'll get back to you within 48 hours.</div>
                    <p id="alert"></p>
                    <form name="contactform" id="contactform" autocomplete="on">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-with-icon-left">
                                    <input class="with-border" name="name"  type="text" id="name" @if(!is_null($user)) readonly value="{{ $user->first_name }} {{ $user->last_name }}" @endif placeholder="Your Name" required="required" />
                                    <i class="icon-material-outline-account-circle"></i>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-with-icon-left">
                                    <input class="with-border" name="email" type="email" id="email"  @if(!is_null($user)) readonly value="{{ $user->email }}" @endif  placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
                                    <i class="icon-material-outline-email"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-with-icon-left">
                            <input class="with-border" name="subject" type="text" id="subject" placeholder="Subject" required="required" />
                            <i class="icon-material-outline-assignment"></i>
                        </div>

                        <div>
                            <textarea class="with-border" name="message" cols="40" rows="5" id="messages" placeholder="Message" spellcheck="true" required="required"></textarea>
                        </div>

                        <input type="button" class="submit button margin-top-15" onclick="contact()" id="submit" value="Submit Message" />

                    </form>
                </section>
            </div>

            <div class="col-xl-5">

                <div class="row">
                    <div class="col-12"></div>
                </div>

            </div>
        </div>
    </div>


    <!-- Spacer -->
    <div class="margin-top-70"></div>
    <!-- Spacer / End-->
@endsection

@section('footerjs')
<script>
    function contact(){
        $.easyAjax({
            url: "{!! route('front.contact.store') !!}",
            type: "POST",
            data: $("#contactform").serialize(),
            container: "#contact",
            messagePosition: 'inline',
            success: function (response) {
                if(response.status == 'success') {
                    $(window).scrollTop( $("#contact").offset().top );
                   $('#contactform').remove();
                }
            }
        });
    }
</script>
@endsection
