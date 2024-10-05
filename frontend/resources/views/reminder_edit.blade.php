@extends('blank')


@section('content')




<div>
<h1>Edit A Reminders</h1>

    <div class="panel col-md-8">
        
    {{ html()->form('PUT', "/reminders/$reminder[id]")->open() }}
    <div class="col-sm-6">
          <div class="panel">
            <div class="panel-body lead">
              <div class="form-group">
                <input type="text" placeholder="Title" name="title" class="form-control" value="{{$reminder['title']}}" required />
              </div>

              <div class="form-group">
                <textarea id="autosize" class="form-control" name="description" required rows="3" placeholder="Description" data-autosize-on="true" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 73px;">{{$reminder['description']}}</textarea>
              </div>


              <div class="form-group">
                <input type="number" class="form-control" name="remind_at" value="{{$reminder['remind_at']}}"  required placeholder="Remind time: Epoch number">
                
              </div>

              <div class="form-group">
                <input type="number" class="form-control " name="event_at" value="{{$reminder['event_at']}}"  required placeholder="Event time: Epoch number" >

              </div>

              <div class="form-group">
                    <button type="submit" id="setTimeButton" class="btn btn-primary ml5">Update</button>
                </div>
              
        </div>

        </form>

    </div>

</div>




@stop