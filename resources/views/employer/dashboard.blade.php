@section('style')
<style type="text/css">

.admin-panel {
  width: 100%;
  margin: 50px auto;
  overflow: hidden;
  background-color:#fff;
  position:relative;

}

.slidebar {
  background-color: #111;
    height:100%;
    width: 100px;
    position: fixed;
    z-index: 1;
    top: 65px;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
}
.slidebar ul {
  position:relative;
  height:100%;
}

.slidebar a{
  color: #bbb;
  text-decoration:none;
}
.slidebar li{
  text-align:center;
  padding: 0x 0px;
}

.slidebar ul {
  padding: 0;
  margin:0;
}
.slidebar li {
  list-style-type: none;
  margin: 0;
  position: relative;
  text-align:center;
  color:#B3B3B3
}
.slidebar i {
  display:block;
  text-align:center;
  color:#B3B3B3;
  font-size: 40px;
  margin-bottom: 8px;
}

.slidebar ul a {
  color:#B3B3B3;
  text-decoration: none;
  box-sizing:border-box;
  display: block;
  text-transform: capitalize;
  padding: 20px;
}
.slidebar li:hover a, li#active{
  background-color: #313131;
}
.slidebar li:hover i, li#active i{
  color: #17BCE8;
}
.slidebar li:focus i {
  color: #17BCE8;
}

.main1 {
  width: 85%;
  background-color: rgb(255,255,255);
  position: relative;
  padding-left: 160px;

}

.main1 h2 {
  margin:1em 30px;
  color:#17BCE8;
  font-size: 20px;
  font-weight:600;
  border-bottom: 1px solid #bbb;
  padding: 0px 0px 10px 0px;
}

table{
  width: 100%;
}

.message-me{
  width: 100%;
  border-color: green;
  margin-bottom: 5px;
}

.message-end{
  width: 100%;
  border-color: blue;
  margin-bottom: 5px;

}

.discussion-history .modal-content{
  width: auto;
}

.discussion-history .modal-body{
  justify-content: center;
}

.discussion-history .modal-dialog{
    overflow-y: initial !important;
    top: 20%;
}
.discussion-history .modal-body{
    height: 250px;
    overflow-y: auto;
}

.stars i{
  color: #FFFFAA;
  margin-right: 3px;
  font-size: 16px;
}

.paid{
  font-size: 24px;
  color: green;
}

#tab2, #tab3{
  display: none;
}

.main1 .btn{
  margin-bottom: 3px;
}


</style>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible mt-5">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible mt-5">
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
  </div>

<div class="container admin-panel">
    <div class="slidebar">
        <ul>
          <li><a href="" name="tab1"><i class="fa fa fa-list"></i>My Projects</a></li>
            <li><a href="" name="tab2"><i class="fa fa fa-tasks"></i>On Going Projects</a></li>
            <li><a href="" name="tab3"><i class="fa fa-check"></i>Finished Projects</a></li>
            <!-- <li><a href="" name="tab4"><i class="fa fa-picture-o"></i>Portfolio</a></li>
            <li><a href="" name="tab6"><i class="fa fa-wrench"></i>Advanced</a></li> -->
        </ul>
    </div>

    <div class="main1">
      <div id="tab1"><h2 class="header">My Projects</h2>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Project name</th>
              <th scope="col">Deadline</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>



          </tbody>
        </table>

      </div>
         <div id="tab2"><h2 class="header">On Going Projects</h2>
           <table class="table table-hover">
             @if (!count($projects)>0)
               <h3>No ongoing projects</h3>
             @else
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Project name</th>
                   <th scope="col">Deadline</th>
                   <th scope="col">Action</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($projects as $project)
                   <tr>
                     <th scope="row">1</th>
                     <td><a href="/projects/{{$project->slug}}">{{$project->name}}</a></td>
                     <td>{{date_format(date_create($project->deadline), "d-m-Y")}}</td>
                     <td><button class="btn btn-info mr-3 update-progress" job-id="{{$project->job_id}}">Update Progress</button><button job-id="{{$project->job_id}}" class="btn btn-warning view-history mr-3">View History</button><button class="btn btn-primary pay-freelancer" bid-id="{{$project->bid_id}}">Pay freelancer</button></td>
                   </tr>
                 @endforeach

               </tbody>
             @endif
           </table>
           @php
             $no=1;
           @endphp
         </div>
         <div id="tab3"><h2 class="header">Finished Projects</h2>
           <table class="table table-hover">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">Project name</th>
                 <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($finished_projects as $project)
                 <tr>
                   <th scope="row">{{$no++}}</th>
                   <td><a href="/projects/{{$project->slug}}">{{$project->name}}</a></td>

                   @if ($project->has_review == 1 || $project->has_review == 3)
                     <td><button job-id="{{$project->job_id}}" class="btn btn-nectarine view-history mr-3">View History</button><button class="btn btn-june mr-3"><i class="fa fa-check-square-o paid" aria-hidden="true"> Paid</i></button><button class="btn btn-june mr-3"><i class="fa fa-check-square-o paid" aria-hidden="true"> Rated </i></button></td>
                   @else
                     <td><button job-id="{{$project->job_id}}" class="btn btn-nectarine view-history mr-3">View History</button><button job-id="{{$project->job_id}}" freelancer-id="{{$project->freelancer_id}}" class="btn btn-primary rate-freelancer mr-3">Rate freelancer</button></td>

                   @endif
                 </tr>
               @endforeach
             </tbody>
           </table>
         </div>
         <!-- <div id="tab4"><h2 class="header">Portfolio</h2></div>
         <div id="tab5"><h2 class="header">Blog /news</h2></div>
         <div id="tab6"><h2 class="header">Advanced</h2></div>    -->
    </div>
</div>

<div class="container">
  <div class="modal progress2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="" action="{{route('send.progress.employer')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}

            <div class="col-md-12">
              Comments for freelancer

              <div class="form-group">
                <textarea required name="msg_text" rows="5" cols="65">              </textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                Attachments
                <input type="file" name="progress_file" id="fileToUpload">

              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">Send to freelancer</button>

          </div>
          <input type="hidden" id="job_id" name="job_id" value="">
          <input type="hidden" id="from_id" name="from_id" value="{{Auth::user()->id}}">
        </form>

        </div>
      </div>
    </div>
  </div>
</div>



<div class="container">
  <div class="modal discussion-history animated fadeIn" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Discussion History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>

      </div>
    </div>
  </div>
  <div class="modal payment animated fadeIn" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>All payment is done through paypal.</h4>
        <p>PayPal lets you quickly and securely send and receive money for goods, services and more. At PayPal, your financial security is our highest priority. We use the latest anti-fraud technology to help make sure your transactions are safer and you’re 100% protected against unauthorized payments sent from your account.</p>
        <div class="warning">

        </div>
        <div class="details">

        </div>
      </div>
      <div class="modal-footer">
        Click on the checkout button to reward your freelancer for their hardwork.
        <div id="paypal-button-container"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal rate animated fadeIn" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Rate freelancer</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="form-rating" action="{{route('rate.freelancer')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="stars">How many stars?</label>
          <input type="hidden" id="stars" name="stars" value="">
          <input type="hidden" id="rate_to_id" name="rate_to_id" value="">
          <input type="hidden" id="rate_job_id" name="rate_job_id" value="">
          <div class="stars">
            <i class="fa fa-star s1" star-id='1' aria-hidden="true"></i><i class="fa fa-star s2" star-id='2' aria-hidden="true"></i><i class="fa fa-star s3" star-id='3' aria-hidden="true"></i><i star-id='4' class="fa fa-star s4" aria-hidden="true"></i>
            <i class="fa fa-star s5" star-id='5' aria-hidden="true"></i>
          </div><small>If you are pleased with the freelancer's work, give them 4-5 stars.</small>
        </div>
        <div class="form-group">
          <textarea name="comment" required id="comment" class="form-control" rows="8" cols="80"></textarea>
        </div>
        <button type="submit" name="button">Submit</button>
      </form>
    </div>
    <div class="modal-footer">

    </div>
  </div>
</div>
</div>
</div>


@endsection

@section('script')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script type="text/javascript">

  var bid_id;

  $(document).ready(function() {
  $(".main1 div").hide();

  $(".slidebar li:first").attr("id","active");

  $(".main1 div:first").fadeIn();


  $('.slidebar a').click(function(e) {
      e.preventDefault();
     if ($(this).closest("li").attr("id") == "active"){
       return
     }else{
       $(".main1 div").hide();
        $(".slidebar li").attr("id","");
        $(this).parent().attr("id","active");
        $('#' + $(this).attr('name')).fadeIn();
        }
  });

  /*$(document).on('mousemove', function(e){
    if(e.pageX<=250)
      document.getElementByClas("slidebar").style.width = "250px";
      else{
        document.getElementById("mySidenav").style.width = "0px";

      }
  })*/

  $(".update-progress").click(function(){
    $(".modal.progress2").modal('show')
  })
  $(".view-history").click(function(){
  })

  $(document).on('click','.update-progress', function(){
    var job_id = $(this).attr('job-id')

    $.ajax({
      url: '{{route('get.job.details.employer')}}',
      data: {job_id: job_id},
      success: function(data){
        $("#job_id").val(data.job_id)
        console.log(data)
      },
      error: function(data){
        console.log(data)
        console.log("Ajax Error - get job details")
      }
    })
  });

  $(document).on('click', '.view-history', function(){
    var job_id = $(this).attr('job-id');
    var content ="";
    $.ajax({
      url: '{{route('get.messages.employer')}}',
      data: {job_id: job_id},
      success: function(data){
        if (data == "No message")
          content  += "<div class='card message-me'><div class=card-body>"+data+"</div></div>";
          else{
            for(var i=0; i<data[0].length; i++){
              if (data[0][i].from_id == data[1].freelancer_id){
                if (data[0][i].file_type!=null) {
                  content  += "<div class='card message-me'><div class=card-body>"+data[0][i].msg_text+"<br><a href=/project/messages/download-file/"+data[0][i].msg_id+">Download attachment</a><br><small>Progress: "+data[0][i].progress+"%</small><br><small>"+data[1].freelancer_name+"</small>"+"</div></div>";
                }
                else content  += "<div class='card message-me'><div class=card-body>"+data[0][i].msg_text+"<br><small>Progress: "+data[0][i].progress+"%</small><br><small>"+data[1].freelancer_name+"</small>"+"</div></div>";
              }else if (data[0][i].from_id == data[1].employer_id){
                if (data[0][i].file_type!=null) {
                  content  += "<div class='card message-end'><div class=card-body>"+data[0][i].msg_text+"<br><a href=/project/messages/download-file/"+data[0][i].msg_id+">Download attachment</a><br><small>"+data[1].employer_name+"</small></div></div>";
                }
                else {
                  content  += "<div class='card message-end'><div class=card-body>"+data[0][i].msg_text+"<br><small>"+data[1].employer_name+"</small></div></div>";

                }
              }
            }
          }
        $(".discussion-history .modal-body").html(content)
        $(".modal.discussion-history").modal('show')
        console.log(data)
      },
      error: function(data){
        console.log(data)
        console.log("Ajax Error - get message details")
      }
    })
  })

  $(document).on('click','.pay-freelancer', function(){

    bid_id = $(this).attr('bid-id');

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $.ajax({
      url: '{{route('get.payment.details')}}',
      method: "POST",
      data: {id: bid_id},
      success: function(data){
        $(".payment .warning").html("");
        if(!data[1])
          $(".payment .warning").html("<div class='alert alert-danger'>This user hasn't set up their paypal account.</div>");
        $(".payment .details").html("<p><strong>You have $"+ data[0] + " due to pay.</strong></p>")
      }
    })
    $('.payment').modal('show')
  })

  $(document).on('click', '.rate-freelancer', function(){
    $("#rate_to_id").val($(this).attr('freelancer-id'))
    $("#rate_job_id").val($(this).attr('job-id'))
    $(".rate").modal('show')
  })



  $(".stars i").click(function(){
    if ($(this).attr('star-id')==1){
      $('.s1').css('color', '#FFAA2A');
      $('.s2').css('color', '#FFFFAA');
      $('.s3').css('color', '#FFFFAA');
      $('.s4').css('color', '#FFFFAA');
      $('.s5').css('color', '#FFFFAA');
      $("#stars").val("1")
    }

    else if ($(this).attr('star-id')==2){
      $('.s1').css('color', '#FFAA2A');
      $('.s2').css('color', '#FFAA2A');
      $('.s3').css('color', '#FFFFAA');
      $('.s4').css('color', '#FFFFAA');
      $('.s5').css('color', '#FFFFAA');
      $("#stars").val("2")
    }
    else if ($(this).attr('star-id')==3){
      $('.s1').css('color', '#FFAA2A');
      $('.s2').css('color', '#FFAA2A');
      $('.s3').css('color', '#FFAA2A');
      $('.s4').css('color', '#FFFFAA');
      $('.s5').css('color', '#FFFFAA');
      $("#stars").val("3")
    }
    else if ($(this).attr('star-id')==4){
      $('.s1').css('color', '#FFAA2A');
      $('.s2').css('color', '#FFAA2A');
      $('.s3').css('color', '#FFAA2A');
      $('.s4').css('color', '#FFAA2A');
      $('.s5').css('color', '#FFFFAA');
      $("#stars").val("4")
    }
    else if ($(this).attr('star-id')==5){
      $('.s1').css('color', '#FFAA2A');
      $('.s2').css('color', '#FFAA2A');
      $('.s3').css('color', '#FFAA2A');
      $('.s4').css('color', '#FFAA2A');
      $('.s5').css('color', '#FFAA2A');
      $("#stars").val("5")
    }
  })

  $(".form-rating").submit(function(){
    if ($("#stars").val()=="" || $("#comment").val()=="" ){
      alert("Please give a star rating and comment.");
      return false;
    }

  })

});
</script>

<script>
  paypal.Button.render({
        env: 'sandbox',
        client: {
            sandbox:    'AXQng1S57K1sm5SMXOdmlnKC_Yy72kVz4Ot4jvZK64wGIOWoxO-YwJMjBX5bNaEA6qFZE9McM0sB6iXz'
        },
        commit: true,

        payment: function(data, actions) {
          var CREATE_PAYMENT_URL = '{{route('create')}}';
          return paypal.request({
              method: 'post',
              url: CREATE_PAYMENT_URL,
              headers: {
                  'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
              },
              data: {bid_id: bid_id}
          }).then(function(data) {
              return data.id;
          });

        },
        onAuthorize: function(data) {
        var EXECUTE_PAYMENT_URL ='{{route('execute')}}';


        paypal.request.post(EXECUTE_PAYMENT_URL,
          { paymentID: data.paymentID, payerID: data.payerID, bid_id: bid_id },
          {headers:
            {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')}
          })
          .then(function(data) {
            alertify.success('Payment successful!');
            console.log(data)
        })
        .catch(function(err) {

      });
    },

    onCancel: function(data, actions) {
      alert("CANCEL")
    }

    }, '#paypal-button-container');
  </script>

@endsection
