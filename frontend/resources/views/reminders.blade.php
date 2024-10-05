@extends('blank')


@section('content')




<div>
<h1>List Of Reminders</h1>

@if(Session::has('success'))

<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><span class="fa fa-check-circle"></span></strong>

    <strong> {{ Session::get('success') }}</strong>
</div>
@endif

@foreach ($reminders as $reminder)

    <div class="panel col-md-8">
        <div class="panel-heading">
        
        </div>
        
        <div class="panel-body people-info">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="info-group">
                      <h3><a href="/reminders/{{$reminder['id']}}">{{$reminder['title']}}</a></h3>
                    </div>
                  </div>
                  <div class="col-md-1 lead">
                  <a href="/reminders/edit/{{$reminder['id']}}" class=" btn btn-warning ml5">edit</a>
                  </div>
                  <div class="col-md-1 lead">
                  {{ html()->form('DELETE', "/reminders/$reminder[id]")->open() }}
                  <button type="submit" class=" btn btn-danger ml5">delete</button>
                  </form>
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-md-8">
                    <div class="info-group">
                      <p class="lead">{{$reminder['description']}}</p>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="info-group">
                      <p class="lead">Remind time: {{Carbon\Carbon::createFromTimestamp($reminder['remind_at'])}}</p> 
                      <p class="lead">Event time: {{Carbon\Carbon::createFromTimestamp($reminder['event_at'])}}</p> 
                    </div>
                  </div>
                </div><!-- row -->
              </div>
    </div>
@endforeach

</div>




@stop